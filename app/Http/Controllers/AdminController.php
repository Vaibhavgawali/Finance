<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    
    function dashboard()
    {
        return view('dashboard.admin.dashboard');
    }
   
}

