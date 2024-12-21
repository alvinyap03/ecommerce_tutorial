<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Load the login form view
    }

    public function login(Request $request)
{
    // Validate the request data
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    // Attempt to authenticate the user using Laravel's Auth facade
    if (Auth::attempt($credentials)) {
        // Authentication successful, redirect to the main page
        return redirect()->route('browse')->with('success', 'Login successful');
    } else {
        // Authentication failed, redirect back to login with an error message
        return redirect()->route('login')->with('error', 'Invalid username or password');
    }
}
}

