<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store');

        // Spatie middleware here
        $this->middleware(['role:Superadmin|Admin'])->only('update','destroy','getUserRoles','assignRole');
        $this->middleware(['role:Superadmin|Admin|Distributor|Retailer'])->only('show');
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        if ($user->id == $id) {
            $userData = User::with( 'profile','address','documents.address_proof','bank','profession','business','social_links')->find($user->id);
            return view('dashboard.dashboard.profile', ['userData' => $userData]);
        } else if (Auth::user()->hasRole('Superadmin') || Auth::user()->hasRole('Admin')) {
            $userData = User::with( 'profile','address','documents.address_proof','bank','profession','business','social_links')->find($id);
            return view('dashboard.dashboard.user-profile', ['userData' => $userData]);
        } else {
            return response(['message' => 'Unauthorized'], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(Auth::check()){
            $formMethod = $request->method();
            if($formMethod == "PATCH"){
                $validator=Validator::make($request->all(),[
                    'isLoginAllowed'=>'required|boolean',
                ]);
                if($validator->fails()){
                    return Response(['message' => $validator->errors()],401);
                }   

                $user = User::where('user_id', $id);
                if($user){
                    $isUpdated=$user->update($request->all());
                    if($isUpdated){
                        return Response(['message' => "User updated successfully"],200);
                    }
                    return Response(['message' => "Something went wrong"],500);
                }                    
                return Response(['message'=>"User not found"],404);
            }
            return Response(['message'=>"Invalid form method "],405);
        }
        return Response(['message'=>'Unauthorized'],401);
    }   

    /**
     * Soft delete user
     */
    public function destroy(string $id)
    {
        if (Auth::user()->hasRole('Superadmin') || Auth::user()->hasRole('Admin')) {
            $user = User::find($id);

            if (!$user) {
                return Response(['status' => false, 'message' => "User not found"], 404);
            }

            $isDeleted = $user->delete();

            if ($isDeleted) {
                return Response(['status' => true, 'message' => "User deleted successfully"], 200);
            }

            return Response(['status' => false, 'message' => "Something went wrong"], 500);
        }

        return Response(['status' => false, 'message' => 'Unauthorized'], 401);
    }

     /**
     * Get user role
     */
    public function getUserRoles($userId)
    {
        $user = User::find($userId);
    
        if($user) {
            $current_role = $user->getRoleNames();
            // $all_roles = Role::pluck('name');
            $all_roles = Role::whereNotIn('name', ['Superadmin', 'Admin','Client'])->pluck('name');

            // dd($all_roles);
            return response()->json(['user_id'=>$userId,'current_role' => $current_role,'all_roles' => $all_roles]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

     /**
     * Update user role
     */
    public function assignRole(Request $request,$user_id) 
    {
        $validator=Validator::make($request->all(),['newRole'=>'required']);

        if($validator->fails()){
            return Response(['status'=>false,'message' => $validator->errors()],422);
        }

        $new_role=$request->newRole;

        $user=User::find($user_id);
       
        if($user){
            $role = $user->hasRole($new_role); /** check user has this role */ 
            // dd($role);
            if(!$role){
                $roles = $user->getRoleNames(); /** get all roles of user */

                $user->syncRoles([]); /** remove all previous roles */

                /** assign new role to user */
                $user->assignRole($new_role); 

                $user->category = $new_role;
                $user->save();

                return Response(['user'=>$user,'message'=>"Role assigned"],200);
            }
            
            return Response(['status'=>true,'user'=>$user,'role'=>$role,'message'=>"Role assigned"],200);

        }
        else{
            return Response(['status'=>false,'message'=>"User not found"],404);
        }
    }
}
