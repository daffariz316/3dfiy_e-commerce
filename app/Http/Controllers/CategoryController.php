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
        ]);

        Category::create([
            'nama_category' => $request->nama_category,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
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
        ]);

        $category = Category::findOrFail($id);
        $category->nama_category = $request->nama_category;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }
    

}
