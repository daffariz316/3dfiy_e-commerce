<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    // Menyimpan kategori baru
    public function store(Request $request)
{
    $request->validate([
        'nama_category' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    // Simpan gambar jika ada
    $imageName = null;
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images1'), $imageName);
    }

    Category::create([
        'nama_category' => $request->nama_category,
        'image' => $imageName, // Simpan nama file saja
    ]);

    return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
}

    // Menghapus kategori
    public function destroy($id)
{
    $category = Category::findOrFail($id);

    // Hapus gambar jika ada
    if ($category->image && file_exists(public_path('images1/'.$category->image))) {
        unlink(public_path('images1/'.$category->image));
    }

    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
}
    public function edit(Request $request, $id){
        $category = Category::findOrFail($id);
        return view('admin.edit-category', compact('category'));
    }
    public function addCategoryAdmin(){
        return view('admin.tambah-category');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_category' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $category = Category::findOrFail($id);
    $category->nama_category = $request->nama_category;

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($category->image && file_exists(public_path('images1/'.$category->image))) {
            unlink(public_path('images1/'.$category->image));
        }

        // Simpan gambar baru
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images1'), $imageName);
        $category->image = $imageName;
    }

    $category->save();

    return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
}
// Di dalam CategoryController atau controller yang sesuai


}
