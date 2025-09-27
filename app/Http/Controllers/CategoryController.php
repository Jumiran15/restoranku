<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        // Ambil semua kategori dari database
        $categories = Category::all();

        // Tampilkan view dengan data kategori
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        // Tampilkan view untuk membuat kategori baru
        return view('admin.category.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Buat kategori baru
        Category::create($request->all());

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Menampilkan detail kategori tertentu.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan form untuk mengedit kategori tertentu.
     */
    public function edit(string $id)
    {
        // Ambil kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Tampilkan view untuk mengedit kategori
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Memperbarui kategori di database.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Cari kategori berdasarkan ID dan update
        $category = Category::findOrFail($id);
        $category->update($request->all());

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(string $id)
    {
        // Cari kategori berdasarkan ID dan hapus
        $category = Category::findOrFail($id);
        $category->delete();

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

