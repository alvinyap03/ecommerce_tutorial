<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, Login $user)
{
    // Validate the form input
    $validatedData = $request->validate([
        'new_username' => 'required',
        'new_fullname' => 'required',
        'new_gmail' => 'required',
    ]);    

    // Fetch the user based on the provided user ID
    $user = Login::find($user->id);

    // Update the user's information
    $user->username = $validatedData['new_username'];
    $user->fullname = $validatedData['new_fullname'];
    $user->gmail = $validatedData['new_gmail'];

    // Check if a new password is provided and hash it
    if ($request->filled('new_password')) {
        $user->password = Hash::make($request->input('new_password')); // Hash the new password
    }
    
    $user->save();

    // Redirect back to the main page or any other page you prefer
    return redirect()->route('main')->with('success', 'User updated successfully');
}

}
