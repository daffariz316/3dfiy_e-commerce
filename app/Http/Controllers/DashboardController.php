<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Public function showAdminDashboard(){
    //     $pendingTransactions = Transactions::where('status', 'pending')->get(); // Ambil data jika perlu
    //     $transactions = Transactions::with(['product', 'user'])->get();
    //     $totalTransactions = $transactions->count();
    //     return view('admin.dashboard', [
    //     'pendingTransactions' => $pendingTransactions,
    //     'transactions' => $transactions,
    //     'total'=> $totalTransactions
    // ]);
    // }
    public function showAdminDashboard() {
        $pendingTransactions = Transactions::where('status', 'pending')->get(); // Ambil data jika perlu
        $transactions = Transactions::with(['product', 'user'])
                            ->where('status', '!=', 'paid') // Filter transaksi yang tidak berstatus "Paid"
                            ->latest() // Urutkan berdasarkan yang terbaru
                            ->take(5) // Ambil 5 data saja
                            ->get();

        $totalTransactions = Transactions::where('status', '!=', 'paid')->count(); // Hitung total transaksi

        return view('admin.dashboard', [
            'pendingTransactions' => $pendingTransactions,
            'transactions' => $transactions,
            'total' => $totalTransactions
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
    public function paymentTransaction() {
        return view('payment.mindtrans');
    }


}
