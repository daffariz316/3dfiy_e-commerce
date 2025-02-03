<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function purchase(Product $product)
     {
         $transaction = Transactions::create([
             'product_id' => $product->id,
             'user_id' => auth()->id(),
             'status' => 'pending',
         ]);

         // Format pesan otomatis WhatsApp
         $whatsappUrl = "https://wa.me/62895372499072?text=" . urlencode(
             "Halo, saya ingin membeli produk *{$product->name}*. Mohon informasi lebih lanjut terkait pembayaran. Terima kasih!"
         );

         return redirect($whatsappUrl);
     }

     // 2. Admin menyetujui pembayaran (mengubah status ke 'paid')
     public function approve(Transactions $transaction)
     {
         $transaction->update(['status' => 'paid']);

         return redirect()->back()->with('success', 'Pembayaran telah dikonfirmasi.');
     }

     // 3. Pengguna dapat mendownload produk setelah pembayaran disetujui
     public function download(Product $product)
{

    // Cek apakah user memiliki transaksi dengan status "paid"
    $transaction = Transactions::where('product_id', $product->id)
        ->where('user_id', auth()->id())
        ->where('status', 'paid')
        ->first();

    // Jika tidak ada transaksi dengan status "paid", tampilkan pesan error
    if (!$transaction) {
        return redirect()->back()->with('error', 'Pembayaran belum dikonfirmasi.');
    }

    // Tentukan nama file berdasarkan ID produk
    $fileName = "produk_{$product->id}.zip"; // Sesuaikan dengan format nama file yang ada

    // Panggil fungsi fileDownload untuk mengunduh file
    return $this->fileDownload($fileName);
}

public function fileDownload($path)
{
    $filePath = public_path("folder_blender/$path");

    // Cek apakah file ada sebelum diunduh
    if (!file_exists($filePath)) {
        abort(404);
    }

    return response()->download($filePath);
}



        public function edit($id)
    {
        // Ambil data transaksi berdasarkan ID
        $transaction = Transactions::findOrFail($id);
        $products = Product::all(); // Jika ingin menampilkan daftar produk untuk dropdown

        return view('admin.edit-transaction', compact('transaction', 'products'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang diupdate
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'status' => 'required|in:pending,paid,failed',
        ]);

        // Update transaksi
        $transaction = Transactions::findOrFail($id);
        $transaction->update($validated);

         // Redirect ke halaman riwayat transaksi setelah berhasil update
         return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diupdate.');
    }
    public function loadTransaction()
    {
        $transactions = Transactions::with(['product', 'user'])->get();
        return view('admin.transaction', compact('transactions'));
    }
}
