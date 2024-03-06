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
use App\Models\UserProfile;
use App\Models\UserAddress;
use App\Models\UserExperience;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store');

        // Spatie middleware here
        $this->middleware(['role:Superadmin'])->only('index','update','destroy');
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
            $userData = User::with( 'profile','address','documents','bank','profession','business','social_links')->find($user->id);
            return view('dashboard.dashboard.profile', ['userData' => $userData]);
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
        if (Auth::check()) {
            $userId = User::find($id);
            if ($userId) {
                $isTrashed = $userId->delete();
                if ($isTrashed) {

                    if($userId->hasRole('Candidate')){
                        return redirect()->route('candidate.index')->with('success','User Deleted Successfully');
                    }

                    if($userId->hasRole('Insurer')){
                        return redirect()->route('insurer.index')->with('success','User Deleted Successfully');
                    }

                    if($userId->hasRole('Institute')){
                        return redirect()->route('institute.index')->with('success','User Deleted Successfully');
                    }
                    
                }
                return Response(['message' => "Something went wrong"], 500);
            }
            return Response(['message' => "User not found "], 404);
        }
        return Response(['data' => 'Unauthorized'], 401);
    }

}
