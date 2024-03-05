<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('frontend.login');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        // Customize the response here
        if ($request->wantsJson()) {
            // If the request wants JSON response
            return response()->json(['redirect' => url('/dashboard')]);
        } else {
            // Default behavior for non-JSON response
            return $this->authenticated($request, Auth::user())
                ?: redirect()->intended($this->redirectPath());
        }
    }

}
