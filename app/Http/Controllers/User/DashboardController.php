<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.login'); 
    }

    public function showLoginForm()
    {
        return view('user.login'); 
    }

    // Display the registration page
    public function showRegisterForm()
    {
        return view('user.register'); 
    }
}
