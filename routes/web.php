<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;

// Redirect '/' to user dashboard
Route::get('/', function () {
    return redirect('/user/dashboard');
});
Route::get('/login', [DashboardController::class, 'showLoginForm'])->name('login');

// Show register page
Route::get('/register', [DashboardController::class, 'showRegisterForm'])->name('register');


// User Dashboard Route without authentication
Route::get('/user/dashboard', [DashboardController::class, 'index']);
