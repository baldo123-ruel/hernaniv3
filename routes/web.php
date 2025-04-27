<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\RegistrationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\IncidentReportController;
Route::post('/register', [RegistrationController::class, 'store'])->name('register');


// Redirect '/' to user dashboard
Route::get('/', function () {
    return redirect('/user/dashboard');
});
Route::get('/login', [DashboardController::class, 'showLoginForm'])->name('login');

// Show register page
Route::get('/register', [DashboardController::class, 'showRegisterForm'])->name('register');


// User Dashboard Route without authentication
Route::get('/user/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth')->name('dashboard');


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');



Route::post('/submit-incident', [IncidentReportController::class, 'store'])->middleware('auth')->name('incident.store');
Route::get('/my-reports', [IncidentReportController::class, 'myReports'])
    ->middleware('auth')
    ->name('incident.myReports');



