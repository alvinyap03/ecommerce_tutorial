<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BrowseController extends Controller
{

    public function index()
    {
        $username = Auth::user()->username;
        // Retrieve products with quantity greater than 0
        $products = Product::with('user')->where('quantity', '>', 0)->get();
        return view('browse', ['username' => $username, 'products' => $products]);
    }

    // Remove this method if not needed
    public function goToAdmin()
    {
        // Redirect to the main page (you should replace 'main' with the actual route name for your main page)
        return redirect()->route('main');
    }
}
