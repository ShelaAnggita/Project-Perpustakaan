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
        $query = Book::with('category');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->q . '%')
                  ->orWhere('penulis', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->paginate(6)->withQueryString();

        $loanedBookIds = $user ? $user->peminjaman()
            ->whereIn('status', [
                Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_MENUNGGU_ACC,
                Peminjaman::STATUS_DISETUJUI,
                // For backward compatibility
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
            ])
            ->pluck('book_id')
            ->all() : [];

        return view('anggota.koleksibuku', [
            'books' => $books,
            'categories' => Category::orderBy('nama')->get(),
            'loanedBookIds' => $loanedBookIds,
            'activeLoanCount' => $user ? $user->peminjaman()
                ->whereIn('status', [
                    Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
                    Peminjaman::STATUS_DIPINJAM,
                    Peminjaman::STATUS_MENUNGGU_ACC,
                    Peminjaman::STATUS_DISETUJUI,
                    // For backward compatibility
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
                Peminjaman::STATUS_MENUNGGU_ACC,
                Peminjaman::STATUS_DISETUJUI,
                // For backward compatibility
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
                    Peminjaman::STATUS_MENUNGGU_ACC,
                    Peminjaman::STATUS_DISETUJUI,
                    // For backward compatibility
                    Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
                ])
                ->count() >= 3,
        ]);
    }
}
