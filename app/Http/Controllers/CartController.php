<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        // Retrieve the product
        $product = Product::findOrFail($id);

        // Validate the request data
        $request->validate([
            'amount' => 'required|integer|min:1|max:' . $product->quantity,
        ]);

        // Here you would typically add the product to the cart
        // For demonstration purposes, let's assume we are storing the cart in the session
        $cart = $request->session()->get('cart', []);

        // Add the product to the cart
        $cart[$id] = [
            'product' => $product,
            'amount' => $request->amount,
        ];

        // Store the updated cart in the session
        $request->session()->put('cart', $cart);

        // Redirect to the cart page
        return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
    }

    public function showCart(Request $request)
{
    // Retrieve the cart items from the session
    $cart = $request->session()->get('cart', []);

    // Initialize an array to hold the cart items with their details
    $cartItems = [];

    // Calculate the total price of all items in the cart
    $totalPrice = 0;

    // Loop through the cart items
    foreach ($cart as $id => $item) {
        // Calculate the total price for the current item
        $itemTotalPrice = $item['product']->price * $item['amount'];

        // Add the product ID to the item details
        $item['id'] = $id;

        // Add the current item to the cartItems array
        $cartItems[] = [
            'id' => $id,
            'name' => $item['product']->name,
            'amount' => $item['amount'],
            'price' => $item['product']->price,
            'totalPrice' => $itemTotalPrice,
        ];

        // Increment the total price
        $totalPrice += $itemTotalPrice;
    }

    // Pass the cart items and total price to the cart view
    return view('cart', compact('cartItems', 'totalPrice'));
}

    public function removeFromCart(Request $request, $id)
    {
        // Retrieve the cart from the session
        $cart = $request->session()->get('cart', []);

        // Check if the item exists in the cart
        if (isset($cart[$id])) {
            // Remove the item from the cart
            unset($cart[$id]);

            // Update the cart in the session
            $request->session()->put('cart', $cart);

            // Redirect back to the cart page with a success message
            return redirect()->route('cart')->with('success', 'Product removed from cart successfully!');
        }

        // If the item does not exist in the cart, redirect back to the cart page with an error message
        return redirect()->route('cart')->with('error', 'Product not found in cart!');
    }

    public function buy(Request $request)
{

    // Retrieve the cart from the session
    $cart = $request->session()->get('cart', []);

    foreach ($cart as $id => $item) {
        // Create a new Purchase record
        $purchase = new Purchase();
        $purchase->user_id = Auth::id(); // Assuming you're using authentication
        $purchase->product_id = $id;
        $purchase->amount = $item['amount'];
        $purchase->total_cost = $item['amount'] * $item['product']->price;
        $purchase->save();
    }

    // Remove purchased items from the product table and update the cart
    foreach ($cart as $id => $item) {
        // Retrieve the product and decrement its quantity
        $product = Product::findOrFail($id);
        $newQuantity = $product->quantity - $item['amount'];

        // If the new quantity is zero or less, remove the product from the database
        // if ($newQuantity <= 0) {
        //     $product->delete(); // This will remove the product from the database
        // } else {
            // Update the product quantity in the database
            $product->quantity = $newQuantity;
            $product->save();
        // }
        
        // Remove the item from the cart
        unset($cart[$id]);
    }


    // Update the cart in the session
    $request->session()->put('cart', $cart);

    // Redirect back to the cart page with a success message
    return redirect()->route('browse')->with('success', 'Items purchased successfully!');
}
}
