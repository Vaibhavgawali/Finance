<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\EmailVerified;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use PDF;
use Yajra\DataTables\DataTables;
use \App\Helpers\RegisterHelper;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserAddress;
use App\Models\UserExperience;

class DistributorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store');
        $this->middleware(['role_or_permission:Superadmin|Admin|view_distributor_list'])->only('index','getDistributorTableData');
        $this->middleware(['role_or_permission:Superadmin|Admin|add_distributor'])->only('create','store');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::check()) {
            $users = User::where('category', 'Distributor')
                    ->orderBy('id', 'desc')
                    ->get();
           
            if ($users) {
                return view('dashboard.distributor.index');
            }
        }
        return Response(['data' => 'Unauthorized'], 401);
    }
    
    /**
     * Display a listing using datatable.
     */
    public function getDistributorTableData()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $data = User::where('category','Distributor')
                    ->when(request()->has('search'), function ($query) {
                        $search = request('search');
                        $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                            $q->orWhere('referral_id', 'like', '%' . $search . '%');
                            $q->orWhere('user_id', 'like', '%' . $search . '%');

                            if (Auth::check() && Auth::user()->hasRole('Admin')) {
                                $q->orWhere('referred_by', Auth::user()->referral_id);
                            }
                        });
                    })
                    ->orderBy('id', 'desc')
                    ->get();

            if ($data) {
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function ($row) {
                        $actions = '<form class="delete-user-form" data-user-id="' . $row->id . '">
                            <button type="button" class="btn btn-sm btn-gradient-danger btn-rounded delete-user-button">Delete</button>
                        </form>';
                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }
        }
    }
    
    public function create()
    {
        return view('dashboard.distributor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/'
        ]);

        if ($validator->fails()) {
            return Response(['status' => false, 'errors' => $validator->errors()], 422);
        }

        // $uniqueReferralId = RegisterHelper::generateReferralId(5,5);
        // $uniqueUserId = RegisterHelper::generateUserId("DT",5);

        $user_type=$request->user_type;
        switch ($user_type) {
            case 'admin':
                $uniqueReferralId = RegisterHelper::generateReferralId(5, 5);
                $uniqueUserId = RegisterHelper::generateUserId("AD", 5);
                $role = "Admin";
                break;
            case 'distributor':
                $uniqueReferralId = RegisterHelper::generateReferralId(5, 5);
                $uniqueUserId = RegisterHelper::generateUserId("DT", 5);
                $role = "Distributor";
                break;
            case 'retailer':
                $uniqueReferralId = RegisterHelper::generateReferralId(5, 5);
                $uniqueUserId = RegisterHelper::generateUserId("RT", 5);
                $role = "Retailor";
                break;
            case 'client':
                $uniqueReferralId = RegisterHelper::generateReferralId(5, 5);
                $uniqueUserId = RegisterHelper::generateUserId("CL",5);
                $role = "Client";
                break;
        }
        // dd($uniqueReferralId);

        $referredById = auth()->user()->referral_id;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => "Password",
            'category' => "Distributor",
            'user_id' => $uniqueUserId,
            'referral_id' => $uniqueReferralId,
            'referred_by' => $referredById,
        ]);

        if ($user) {     
            /** assign role to user **/
            $user->assignRole($role);
            return Response(['status' => true, 'message' => "User added successfully !"], 200);
        }
        return Response(['status' => false, 'message' => "Something went wrong"], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();

        // Check if the authenticated user has permission to view the profile
        if ($user->id == $id) {
            $userData = User::with('address', 'profile','documents')->find($user->id);
            return view('dashboard.admin.profile', ['userData' => $userData]);
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
        //
    }

    /**
     * Soft delete user
     */
    public function destroy(string $id)
    {
      //
    }

}
