<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    Public function showAdminDashboard(){
        return view('admin.home');
    }
    public function index()
    {
        $products = Product::all(); // Get all products
        return view('user.products.index')->with('products', $products); // Pass 'products' to the view
    }
    public function productAdmin(){
        return view('admin.product');
    }
    public function transaction(){
        return view('admin.transaction');
    }
    public function loadTransaction()
{
    $transactions = Transactions::with(['product', 'user'])->get();
    return view('admin.transaction', compact('transactions'));
}



}
