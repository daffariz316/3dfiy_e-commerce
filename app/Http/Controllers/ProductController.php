<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.products.show', compact('product'));
    }
    public function loadProductAdmin(){
        $products = Product::all(); // Mengambil semua data produk
        // dd($products);
        return view('admin.product', ['products'=> $products]);
    }
    public function addProductAdmin(){
        return view('admin.tambah');
    }
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'blender_file' => 'nullable|mimes:zip,rar,blend|max:500000', // Validasi untuk file Blender
        ]);


        // Proses upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Membuat nama unik untuk file
            $request->image->move(public_path('images'), $imageName); // Menyimpan gambar ke folder public/images
            $imagePath = $imageName; // Menyimpan nama file
        }
        // Proses upload file Blender jika ada
        $blenderFilePath = null;
        if ($request->hasFile('blender')) {
            $blenderFileName = time() . '.' . $request->blender->getClientOriginalExtension();
            $request->blender->move(public_path('folder_blender'), $blenderFileName);
            $blenderFilePath = $blenderFileName;
        }

        // Simpan data ke database
        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imagePath,
            'blender_file' => $blenderFilePath, // Simpan path file Blender
        ]);

        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }
}
