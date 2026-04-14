<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.categories.index', [
            'categories' => Category::withCount('books')->orderBy('nama')->get(),
            'panel' => $request->is('kepala-perpustakaan/*') ? 'kepala' : 'petugas',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Category::create($request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama',
            'deskripsi' => 'nullable|string',
        ]));

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($request->validate([
            'nama' => 'required|string|max:255|unique:categories,nama,'.$category->id,
            'deskripsi' => 'nullable|string',
        ]));

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->books()->exists()) {
            return back()->withErrors(['kategori' => 'Kategori tidak bisa dihapus karena masih dipakai buku.']);
        }

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
