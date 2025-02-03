<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    Public function showAdminDashboard(){
        $pendingTransactions = Transactions::where('status', 'pending')->get(); // Ambil data jika perlu
        return view('admin.dashboard', [
        'pendingTransactions' => $pendingTransactions
    ]);
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

    public function notificationTransaction() {
        $pendingTransactions = Transactions::where('status', 'pending')->get();

        return view('admin.dashboard', [
            'pendingTransactions' => $pendingTransactions
        ]);
    }
    public function category(){
        return view('admin.category');
    }
}
