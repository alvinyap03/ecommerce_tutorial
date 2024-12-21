<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CreateController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:1',
        'image' => 'nullable|mimes:jpeg,png,jpg,webp',
    ]);

    // Handle image upload if provided
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path = 'product/images/';
        $file->move($path, $filename);
        $imagePath = $path . $filename;
    } else {
        $imagePath = null; // Set image path to null if no image is provided
    }

    // Save the product to the database
    $product = new Product();
    $product->name = $validatedData['name'];
    $product->description = $validatedData['description'];
    $product->price = $validatedData['price'];
    $product->quantity = $validatedData['quantity'];
    $product->image = $imagePath; // Assign image path here
    $product->user_id = auth()->id(); // Assuming the logged-in user is the one posting the product

    $product->save();

    // Redirect to a success page or do something else
    return redirect()->route('browse')->with('success', 'Product posted successfully!');
}

}
