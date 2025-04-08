<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::all(); // Ambil semua kategori dari database
    return view('admin.tambah', compact('categories'));
    }
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'price' => 'required|numeric',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'blender_file' => 'nullable|mimes:zip,rar|max:500000', // Validasi untuk file Blender
    //         'category_id' => 'required|exists:categories,id', // Validasi kategori
    //     ]);


    //     // Proses upload gambar jika ada
    //     $imagePath = null;
    //     if ($request->hasFile('image')) {
    //         $imageName = time() . '.' . $request->image->extension(); // Membuat nama unik untuk file
    //         $request->image->move(public_path('images'), $imageName); // Menyimpan gambar ke folder public/images
    //         $imagePath = $imageName; // Menyimpan nama file
    //     }
    //     // Proses upload file Blender jika ada
    //     $blenderFilePath = null;
    //     if ($request->hasFile('blender')) {
    //         $blenderFileName = time() . '.' . $request->blender->getClientOriginalExtension();
    //         $request->blender->move(public_path('folder_blender'), $blenderFileName);
    //         $blenderFilePath = $blenderFileName;
    //     }

    //     // Simpan data ke database
    //     Product::create([
    //         'name' => $validated['name'],
    //         'description' => $validated['description'],
    //         'price' => $validated['price'],
    //         'image' => $imagePath,
    //         'blender_file' => $blenderFilePath, // Simpan path file Blender
    //         'category_id' => $validated['category_id'], // Menyimpan kategori
    //     ]);

    //     // Redirect ke halaman produk dengan pesan sukses
    //     return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    // }
    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'blender_file' => 'nullable|mimes:zip,rar|max:500000', // Validasi untuk file Blender
        'category_id' => 'required|exists:categories,id', // Validasi kategori
    ]);


    // Proses upload gambar jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension(); // Membuat nama unik untuk file
        $request->image->move(public_path('images'), $imageName); // Menyimpan gambar ke folder public/images
        $imagePath = $imageName; // Menyimpan nama file
    }

    // Simpan data produk ke database terlebih dahulu
    $product = Product::create([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'price' => $validated['price'],
        'image' => $imagePath,
        'category_id' => $validated['category_id'], // Menyimpan kategori
    ]);

    // Proses upload file Blender jika ada setelah produk disimpan dan ID tersedia
    if ($request->hasFile('blender')) {
        $blenderFileName = $product->id . '.zip'; // Gunakan ID produk untuk nama file
        $request->blender->move(public_path('folder_blender'), $blenderFileName); // Error ada di sini
        $blenderFilePath = $blenderFileName;

        // Update path file Blender pada produk
        $product->update([
            'blender_file' => $blenderFilePath,
        ]);
    }


    // Redirect ke halaman produk dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
}

        public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Ambil semua kategori dari database
        return view('admin.edit-product', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'blender_file' => 'nullable|mimes:zip,rar|max:500000', // Validasi untuk file Blender
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id; // Menyimpan kategori baru

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        // Proses upload file Blender jika ada
        if ($request->hasFile('blender')) {
            $blenderFileName = $product->id . '.zip'; // Gunakan ID produk untuk nama file
            $request->blender->move(public_path('folder_blender'), $blenderFileName); // Error ada di sini
            $blenderFilePath = $blenderFileName;

            // Update path file Blender pada produk
            $product->update([
                'blender_file' => $blenderFilePath,
            ]);
        }

        // Simpan perubahan data ke database
        $product->save();

        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }
    public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Hapus file gambar jika ada
    if ($product->image) {
        $imagePath = public_path('images/' . $product->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Hapus file Blender jika ada
    if ($product->blender_file) {
        $blenderFilePath = public_path('folder_blender/' . $product->blender_file);
        if (file_exists($blenderFilePath)) {
            unlink($blenderFilePath);
        }
    }

    // Hapus produk dari database
    $product->delete();

    // Redirect ke halaman produk dengan pesan sukses
    return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
}


}
