<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:confirmpassword',
            'confirmpassword' => 'required|min:6', // optional but useful for better validation
            'address' => 'required|string|max:255',
        ]);

        User::create([
            'firstName' => $request->fname,
            'lastName' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'role' => 'user',
            'status' => 'active'
        ]);

        return response()->json(['success' => true, 'message' => 'Registration successful!']);
    }
}
