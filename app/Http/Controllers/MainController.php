<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert(Request $request)
{
    // Validate the request data
    $data = $request->validate([
        'username' => 'required|string',
        'fullname' => 'required|string',
        'gmail' => 'required|string',
        'password' => 'required|string',
    ]);
    
    // Hash the password
    $data['password'] = Hash::make($data['password']);

    // Insert the user data into the database
    $newdata = Login::create($data);

    // Redirect back to the main page or any other page you prefer
    return redirect()->back()->with('success', 'User inserted successfully');
}
    
public function index(Request $request)
{
    // Get the username of the currently authenticated user
    $username = Auth::user()->username;

    // Fetch all users from the database
    $users = Login::all();

    // Pass the username and users data to the view
    // return view('main', ['users' => $users]);
    return view('main', ['username' => $username, 'users' => $users]);
}


public function delete(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|exists:Login,id',
        ]);
        
        // Extract the user ID from the request
        $userId = $request->input('user_id');
        
        // Delete the user
        Login::destroy($userId);
        
        // Redirect back to the main page with a success message
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function gotoupdate($user_id)
{
    // Fetch the user based on the provided user ID
    $user = Login::find($user_id);

    // Pass the user data to the update view
    return view('update', ['user' => $user]);
}

public function logout(Request $request)
{
    Auth::logout(); // Logout the user

    // Flush the session data
    $request->session()->invalidate();

    return redirect()->route('login'); // Redirect to the login page after logout
}
}