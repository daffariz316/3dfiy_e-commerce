<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Notification;

class TransactionsController extends Controller
{
    public function purchase(Product $product)
     {
         $transaction = Transactions::create([
             'product_id' => $product->id,
             'user_id' => auth()->id(),
             'status' => 'pending',
         ]);
         // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-u4vEkrtZG59K9tQyIqwYI2gr';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $product->price,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                // 'email' => auth()->user()->email,
            ),
            );
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $transaction ->snap_token = $snapToken;
            $transaction -> save();
            return response()->json($snapToken);
         // Format pesan otomatis WhatsApp
        //  $whatsappUrl = "https://wa.me/62895372499072?text=" . urlencode(
        //      "Halo, saya ingin membeli produk *{$product->name}*. Mohon informasi lebih lanjut terkait pembayaran. Terima kasih!"
        //  );

        //  return redirect($whatsappUrl);
     }

     // 2. Admin menyetujui pembayaran (mengubah status ke 'paid')
    //  public function approve(Transactions $transaction)
    //  {
    //      $transaction->update(['status' => 'paid']);

    //      return redirect()->back()->with('success', 'Pembayaran telah dikonfirmasi.');
    //  }
//     public function approve(Request $request)
// {
//     $transaction = Transactions::where('user_id', auth()->id())
//                                ->where('product_id', $request->product_id)
//                                ->first();

//     if ($transaction) {
//         $transaction->status = "paid";
//         $transaction->save();
//         return response()->json(['message' => 'Transaction updated successfully']);
//     }

//     return response()->json(['message' => 'Transaction not found'], 404);
// }
// Midtrans Notification Handler
public function callback(Request $request)
{
    // Konfigurasi Midtrans
    Config::$serverKey = 'SB-Mid-server-u4vEkrtZG59K9tQyIqwYI2gr';
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    // Tangkap notifikasi dari Midtrans
    $notification = new Notification();

    $transactionStatus = $notification->transaction_status;
    $fraudStatus = $notification->fraud_status;
    $paymentType = $notification->payment_type;
    $orderId = $notification->order_id;

    // Log untuk debugging (opsional, bisa dihapus nanti)
    \Log::info("Midtrans Callback", [
        'order_id' => $orderId,
        'status' => $transactionStatus,
        'fraud' => $fraudStatus,
        'payment_type' => $paymentType
    ]);

    // Cari transaksi
    $transaction = Transactions::where('order_id', $orderId)->first();

    if ($transaction) {
        if ($transactionStatus === 'capture') {
            if ($paymentType === 'credit_card') {
                if ($fraudStatus === 'challenge') {
                    $transaction->status = 'challenge'; // Tunggu verifikasi manual
                } else {
                    $transaction->status = 'paid';
                }
            } else {
                $transaction->status = 'paid';
            }
        } elseif ($transactionStatus === 'settlement') {
            $transaction->status = 'paid';
        } elseif ($transactionStatus === 'pending') {
            $transaction->status = 'waiting';
        } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {
            $transaction->status = 'failed';
        }

        $transaction->save();
        return response()->json(['message' => 'Transaction status updated successfully']);
    }

    return response()->json(['message' => 'Transaction not found'], 404);
}
public function approve(Request $request)
{
    $transaction = Transactions::where('user_id', auth()->id())
                               ->where('product_id', $request->product_id)
                               ->first();

    if ($transaction) {
        $transaction->status = "paid";
        $transaction->save();
        return response()->json(['message' => 'Transaction updated successfully']);
    }

    return response()->json(['message' => 'Transaction not found'], 404);
}


     // 3. Pengguna dapat mendownload produk setelah pembayaran disetujui
    // Download File Blender
    public function download(Product $product)
    {
        // Cek apakah user memiliki transaksi dengan status "paid"
        $transaction = Transactions::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->where('status', 'paid')
            ->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Pembayaran belum dikonfirmasi.');
        }

        // Cek apakah file ada dalam database
        if (!$product->blender_file) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return $this->fileDownload($product->blender_file);
    }

    // Fungsi untuk mengunduh file
    private function fileDownload($path)
    {
        $filePath = public_path("folder_blender/$path");

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
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
