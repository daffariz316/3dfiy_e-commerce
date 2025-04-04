<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Public function showAdminDashboard(){
    //     $pendingTransactions = Transactions::where('status', 'pending')->get(); // Ambil data jika perlu
    //     $transactions = Transactions::with(['product', 'user'])->get();
    //     $totalTransactions = $transactions->count();
    //     $totalTransactionstable = Transactions::with(['product', 'user'])
    //                             ->where('status', '!=', 'paid') // Filter transaksi yang tidak berstatus "Paid"
    //                             ->latest() // Urutkan berdasarkan yang terbaru
    //                             ->take(5)// Ambil 5 data saja
    //                             ->get();
    //     return view('admin.dashboard', [
    //     'pendingTransactions' => $pendingTransactions,
    //     'transactions' => $transactions,
    //     'total'=> $totalTransactions,
    //     'totalTransactionstable' => $totalTransactionstable
    // ]);
    // }
    // public function showAdminDashboard(){
    //     $pendingTransactions = Transactions::where('status', 'pending')->get(); // Ambil data jika perlu
    //     $transactions = Transactions::with(['product', 'user'])->get();
    //     $totalTransactions = $transactions->count();

    //     // Ambil 5 transaksi terbaru berdasarkan updated_at
    //     $totalTransactionstable = Transactions::with(['product', 'user'])
    //                                 ->where('status', '!=', 'paid') // Filter transaksi yang tidak "paid"
    //                                 ->orderBy('updated_at', 'desc') // Urutkan berdasarkan updated_at terbaru
    //                                 ->take(5) // Ambil 5 data saja
    //                                 ->get();

    //     return view('admin.dashboard', [
    //         'pendingTransactions' => $pendingTransactions,
    //         'transactions' => $transactions,
    //         'total'=> $totalTransactions,
    //         'totalTransactionstable' => $totalTransactionstable
    //     ]);
    // }
    public function showAdminDashboard(){
        $pendingTransactions = Transactions::where('status', 'pending')->get();
        $transactions = Transactions::with(['product', 'user'])->get();
        $totalTransactions = $transactions->count();

        // Ambil 5 transaksi terbaru berdasarkan updated_at
        $totalTransactionstable = Transactions::with(['product', 'user'])
                                    ->where('status', '!=', 'paid')
                                    ->orderBy('updated_at', 'desc')
                                    ->take(5)
                                    ->get();

        // PIE CHART: Hitung jumlah transaksi per produk
        $transactionsPerProduct = Product::withCount('transactions')->get();
        $chartData = [
            'labels' => $transactionsPerProduct->pluck('name'),
            'data' => $transactionsPerProduct->pluck('transactions_count'),
        ];
        $transactionStats = Transactions::selectRaw('status, COUNT(*) as total')
                            ->groupBy('status')
                            ->pluck('total', 'status');

        return view('admin.dashboard', [
            'pendingTransactions' => $pendingTransactions,
            'transactions' => $transactions,
            'total'=> $totalTransactions,
            'totalTransactionstable' => $totalTransactionstable,
            'chartData' => $chartData,
            'transactionStats' => $transactionStats
        ]);
    }
    public function index()
    {
        $products = Product::all(); // Get all products
        $categories = Category::all();
        return view('user.products.index')
        ->with('products', $products)
        ->with('categories', $categories);
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

    public function showProfile(){
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('User.profile', compact('user'));
    }

    public function showteams(){
        return view('User.teams');
    }

    public function indexU(){
        $categories = Category::all(); // Ambil semua kategori dari database
        return view('User.category-index', compact('categories'));
    }
    public function showCategories()
    {
        // Mengambil semua data kategori
        $categories = Category::all();

        // Mengirim data kategori ke view
        return view('User.products.index', compact('categories'));
    }
    public function showProductsByCategory($category_id){
        $category = Category::findOrFail($category_id);
        $products = Product::where('category_id', $category_id)->get();

    return view('User.category.products', compact('category', 'products'));
    }

        public function showProductsByCategory1($category_id)
    {
        $category = Category::findOrFail($category_id);
        $products = Product::where('category_id', $category_id)->get();
        $categories = Category::all(); // untuk tetap menampilkan semua kategori di sidebar/menu

        return view('user.category.products', [
            'category' => $category,
            'products' => $products,
            'categories' => $categories,
        ]);
    }
    public function showproducts(){
        return view('user.product-index');
    }
}
