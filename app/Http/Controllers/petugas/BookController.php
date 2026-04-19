<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Peminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $query = Book::with('category');

        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%')
                  ->orWhere('penulis', 'like', '%' . $request->q . '%');
        }

        $books = $query->paginate(12);
        $panel = $this->panel($request);

        return view($panel === 'kepala' ? 'kepala.koleksi_buku' : 'petugas.koleksi_buku', [
            'books' => $books,
        ]);
    }

    public function create(Request $request): View
    {
        return view('petugas.tambah_buku', [
            'book' => new Book(),
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['gambar'] = $this->storeImage($request);
        Book::create($data);

        return redirect()->route($this->panelRoute($request, 'books.index'))->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Request $request, Book $book): View
    {
        $panel = $this->panel($request);
        
        return view($panel === 'kepala' ? 'kepala.detail_buku' : 'petugas.detail_buku', [
            'book' => $book,
        ]);
    }

    public function edit(Request $request, Book $book): View
    {
        return view('petugas.edit_buku', [
            'book' => $book,
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->storeImage($request);
        } else {
            unset($data['gambar']);
        }

        $book->update($data);

        return redirect()->route($this->panelRoute($request, 'books.index'))->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Request $request, Book $book): RedirectResponse
    {
        $aktif = $book->peminjaman()->whereIn('status', [
            Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
            Peminjaman::STATUS_DIPINJAM,
            Peminjaman::STATUS_MENUNGGU_ACC,
            Peminjaman::STATUS_DISETUJUI,
            // For backward compatibility
            Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
        ])->exists();

        if ($aktif) {
            return back()->withErrors(['hapus' => 'Buku tidak bisa dihapus karena masih dipinjam atau menunggu konfirmasi.']);
        }

        $book->delete();

        return redirect()->route($this->panelRoute($request, 'books.index'))->with('success', 'Buku berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'pengarang' => 'nullable|string|max:255',
            'penerbit' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tahun_terbit' => 'required|integer|min:1900|max:2100',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    }

    private function storeImage(Request $request): ?string
    {
        if (! $request->hasFile('gambar')) {
            return null;
        }

        $name = time().'_'.$request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move(public_path('image'), $name);

        return $name;
    }

    private function panel(Request $request): string
    {
        return $request->is('kepala-perpustakaan/*') ? 'kepala' : 'petugas';
    }

    private function panelRoute(Request $request, string $suffix): string
    {
        return $this->panel($request).'.'.$suffix;
    }
}
