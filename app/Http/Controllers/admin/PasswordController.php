<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User; 

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function resetPasswordForm()
    {
        //
        return view('dashboard.password.reset-password');
    }

    public function resetPassword(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'password_confirmation' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            // If validation fails, return the errors
            return Response(['status'=>false,'errors' => $validator->errors()], 422);
        }

        // Retrieve the user based on the email address
        $user = User::where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return Response(['status'=>false,'errors' => ['email' => 'Inavlid Email id or Old password']], 404);
        }

        // Check if the provided old password matches the user's current password
        if (!Hash::check($request->old_password, $user->password)) {
            return Response(['status'=>false,'errors' => ['old_password' => 'Inavlid Email id or Old password']], 422);
        }

        // Update the user's password
        $user->update(['password' => Hash::make($request->new_password)]);

        return Response(['status'=>true,'message' => 'Password reset successfully']);
    }
}
