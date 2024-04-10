<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function register()
    {
        return view('frontend.register');
    }
    function login()
    {
        return view('frontend.login');
    }
    function index()
    {
        return view('frontend.index');
    }
    function credit()
    {
        return view('frontend.credit');
    }
    function demat()
    {
        return view('frontend.demat');
    }
    // function credit_card()
    // {
    //     return view('frontend.creditcard');
    // }
    function general_insurance()
    {
        return view('frontend.generalinsurance');
    }
    function health_insurance()
    {
        return view('frontend.healthinsurance');
    }
    function life_insurance()
    {
        return view('frontend.lifeinsurance');
    }
    function loan()
    {
        return view('frontend.loan');
    }
    function loan_service()
    {
        return view('frontend.loan');
    }
}
