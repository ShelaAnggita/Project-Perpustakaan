<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Dummy data untuk testing pagination
        $dummyBooks = collect([
            (object)['id' => 1, 'judul' => 'Algoritma Python', 'penulis' => 'John Doe', 'stok_tersedia' => 15, 'stok' => 15, 'gambar' => 'AlgoritmaPython.jpg', 'category' => (object)['nama' => 'Teknologi']],
            (object)['id' => 2, 'judul' => 'Angkasa', 'penulis' => 'Tere Liye', 'stok_tersedia' => 12, 'stok' => 12, 'gambar' => 'Angkasa.jpg', 'category' => (object)['nama' => 'Fiksi']],
            (object)['id' => 3, 'judul' => 'Dilan 1990', 'penulis' => 'Pidi Baiq', 'stok_tersedia' => 20, 'stok' => 20, 'gambar' => 'Dilan.jpg', 'category' => (object)['nama' => 'Romansa']],
            (object)['id' => 4, 'judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'stok_tersedia' => 18, 'stok' => 18, 'gambar' => 'LaskarPelangi.jpg', 'category' => (object)['nama' => 'Inspirasi']],
            (object)['id' => 5, 'judul' => 'Matematika', 'penulis' => 'Prof. Ahmad', 'stok_tersedia' => 25, 'stok' => 25, 'gambar' => 'Matematika.jpg', 'category' => (object)['nama' => 'Pendidikan']],
            (object)['id' => 6, 'judul' => 'PAI', 'penulis' => 'Dr. Hasan', 'stok_tersedia' => 30, 'stok' => 30, 'gambar' => 'PAI.jpg', 'category' => (object)['nama' => 'Agama']],
            (object)['id' => 7, 'judul' => 'Pendidikan Agama Islam', 'penulis' => 'Ust. Abdullah', 'stok_tersedia' => 22, 'stok' => 22, 'gambar' => 'PendidikanAgama.jpg', 'category' => (object)['nama' => 'Agama']],
            (object)['id' => 8, 'judul' => 'Pulang Pergi', 'penulis' => 'Tere Liye', 'stok_tersedia' => 16, 'stok' => 16, 'gambar' => 'PulangPergi.jpg', 'category' => (object)['nama' => 'Fiksi']],
            (object)['id' => 9, 'judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'stok_tersedia' => 14, 'stok' => 14, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Sejarah']],
            (object)['id' => 10, 'judul' => 'Ayat-Ayat Cinta', 'penulis' => 'Habiburrahman El Shirazy', 'stok_tersedia' => 19, 'stok' => 19, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Romansa']],
            (object)['id' => 11, 'judul' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi', 'stok_tersedia' => 17, 'stok' => 17, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Inspirasi']],
            (object)['id' => 12, 'judul' => 'Perahu Kertas', 'penulis' => 'Dee Lestari', 'stok_tersedia' => 13, 'stok' => 13, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Fiksi']],
            (object)['id' => 13, 'judul' => 'Sang Pemimpi', 'penulis' => 'Andrea Hirata', 'stok_tersedia' => 21, 'stok' => 21, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Inspirasi']],
            (object)['id' => 14, 'judul' => 'Edensor', 'penulis' => 'Andrea Hirata', 'stok_tersedia' => 15, 'stok' => 15, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Fiksi']],
            (object)['id' => 15, 'judul' => 'Filosofi Kopi', 'penulis' => 'Dee Lestari', 'stok_tersedia' => 18, 'stok' => 18, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Fiksi']],
            (object)['id' => 16, 'judul' => 'Supernova', 'penulis' => 'Dee Lestari', 'stok_tersedia' => 16, 'stok' => 16, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Romansa']],
            (object)['id' => 17, 'judul' => 'Rectoverso', 'penulis' => 'Dee Lestari', 'stok_tersedia' => 12, 'stok' => 12, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Sastra']],
            (object)['id' => 18, 'judul' => 'Madre', 'penulis' => 'Dee Lestari', 'stok_tersedia' => 14, 'stok' => 14, 'gambar' => 'downloadremove.png', 'category' => (object)['nama' => 'Fiksi']],
        ]);

        // Filter berdasarkan query
        if ($request->filled('q')) {
            $dummyBooks = $dummyBooks->filter(function($book) use ($request) {
                return str_contains(strtolower($book->judul), strtolower($request->q)) ||
                       str_contains(strtolower($book->penulis), strtolower($request->q));
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $dummyBooks = $dummyBooks->filter(function($book) use ($request) {
                return $book->category->nama === $request->category;
            });
        }

        $perPage = 6;
        $currentPage = max(1, (int) $request->query('page', 1));
        $paginatedBooks = $dummyBooks->forPage($currentPage, $perPage)->values();

        $books = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedBooks,
            $dummyBooks->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'pageName' => 'page']
        );
        $books->appends($request->query());

        $loanedBookIds = $user ? $user->peminjaman()
            ->whereIn('status', [
                Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
            ])
            ->pluck('book_id')
            ->all() : [];

        return view('anggota.koleksibuku', [
            'books' => $books,
            'categories' => collect([
                (object)['id' => 1, 'nama' => 'Fiksi'],
                (object)['id' => 2, 'nama' => 'Romansa'],
                (object)['id' => 3, 'nama' => 'Inspirasi'],
                (object)['id' => 4, 'nama' => 'Pendidikan'],
                (object)['id' => 5, 'nama' => 'Agama'],
                (object)['id' => 6, 'nama' => 'Sejarah'],
                (object)['id' => 7, 'nama' => 'Sastra'],
                (object)['id' => 8, 'nama' => 'Teknologi'],
            ]),
            'loanedBookIds' => $loanedBookIds,
            'activeLoanCount' => $user ? $user->peminjaman()
                ->whereIn('status', [
                    Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
                    Peminjaman::STATUS_DIPINJAM,
                    Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
                ])
                ->count() : 0,
        ]);
    }

    public function show(Book $book)
    {
        $user = Auth::user();

        $punyaPinjamanAktif = $user->peminjaman()
            ->where('book_id', $book->id)
            ->whereIn('status', [
                Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
            ])
            ->exists();

        return view('anggota.detailbuku', [
            'book' => $book->load('category'),
            'punyaPinjamanAktif' => $punyaPinjamanAktif,
            'sudahMaksimalPinjam' => $user->peminjaman()
                ->whereIn('status', [
                    Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
                    Peminjaman::STATUS_DIPINJAM,
                    Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
                ])
                ->count() >= 3,
        ]);
    }
}
