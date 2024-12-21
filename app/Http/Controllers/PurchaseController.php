<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchaseRecords = Purchase::with('user', 'product')->latest()->get(); 
        return view('purchase', compact('purchaseRecords'));
    }
}
