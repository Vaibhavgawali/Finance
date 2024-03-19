<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function candidate_register()
    {
        return view('frontend.candidate-register');
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
    function credit_card()
    {
        return view('frontend.creditcard');
    }
}
