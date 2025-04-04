<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;

// Redirect '/' to user dashboard
Route::get('/', function () {
    return redirect('/user/dashboard');
});

// User Dashboard Route without authentication
Route::get('/user/dashboard', [DashboardController::class, 'index']);
