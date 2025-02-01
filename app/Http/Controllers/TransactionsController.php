<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function purchase($productId)
{
    $product = Product::findOrFail($productId);

    // Pastikan user sudah login
    if (!Auth::check()) {
        return redirect()->back()->with('error', 'Anda harus login untuk membeli produk.');
    }

    // Buat transaksi dengan status 'pending'
    $transaction = Transactions::create([
        'product_id' => $product->id,
        'user_id' => Auth::id(),
        'email' => Auth::user()->email, // Ubah dari 'username' ke 'email'
        'status' => 'pending'
    ]);

    // Simulasi pembayaran sukses (nanti bisa pakai Payment Gateway)
    $transaction->update(['status' => 'paid']);

    return redirect()->back()->with('success', 'Pembayaran berhasil!');
}
public function download($productId)
{
    $transaction = Transactions::where('product_id', $productId)
        ->where('user_id', Auth::id())
        ->where('status', 'paid')
        ->first();

    if (!$transaction) {
        return redirect()->back()->with('error', 'Anda belum melakukan pembayaran!');
    }

    $product = Product::findOrFail($productId);

    // Pastikan file_name tidak kosong
    if (empty($product->file_name)) {
        return redirect()->back()->with('error', 'File tidak tersedia!');
    }

    $filePath = public_path('folder_blender/' . $product->file_name);

    // Cek apakah file ada
    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'File tidak ditemukan!');
    }

    return response()->download($filePath);
}
public function editTransactions(){

}


}
