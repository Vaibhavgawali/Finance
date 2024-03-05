<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Helpers\RegisterHelper;

use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware(['role_or_permission:Superadmin|Admin|add_distributor|add_retailor'])->only('store');
    }

    public function register(Request $request): Response
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

        $user_type=$request->user_type;
        switch ($user_type) {
            case 'admin':
                $uniqueReferralId = RegisterHelper::generateReferralId(5, 5);
                $uniqueUserId = RegisterHelper::generateUserId("AD", 5);
                $category = "Distributor";
                $role = "Admin";
                break;
            case 'distributor':
                $uniqueReferralId = RegisterHelper::generateReferralId(5, 5);
                $uniqueUserId = RegisterHelper::generateUserId("DT", 5);
                $category = "Distributor";
                $role = "Distributor";
                break;
            case 'retailer':
                $uniqueReferralId = RegisterHelper::generateReferralId(5, 5);
                $uniqueUserId = RegisterHelper::generateUserId("RT", 5);
                $category = "Retailer";
                $role = "Retailer";
                break;
            case 'client':
                $uniqueReferralId = RegisterHelper::generateReferralId(5, 5);
                $uniqueUserId = RegisterHelper::generateUserId("CL",5);
                $category = "Client";
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
            'category' => $category,
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
}
