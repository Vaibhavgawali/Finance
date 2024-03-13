<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    function dashboard()
    {
        return view('dashboard.dashboard.dashboard');
    }

}
