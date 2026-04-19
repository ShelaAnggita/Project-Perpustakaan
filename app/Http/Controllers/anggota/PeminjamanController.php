<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Auth::user()->peminjaman()
            ->with('book')
            ->latest()
            ->get();

        return view('anggota.peminjaman', compact('peminjaman'));
    }

    public function store(Book $book): RedirectResponse
    {
        $user = Auth::user();

        $punyaBukuSama = $user->peminjaman()
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

        if ($punyaBukuSama) {
            return back()->withErrors(['pinjam' => 'Buku yang sama masih ada dalam proses pinjam atau pengembalian.']);
        }

        $jumlahAktif = $user->peminjaman()
            ->whereIn('status', [
                Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_MENUNGGU_ACC,
                Peminjaman::STATUS_DISETUJUI,
                // For backward compatibility
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
            ])
            ->count();

        if ($jumlahAktif >= 3) {
            return back()->withErrors(['pinjam' => 'Maksimal 3 buku aktif dalam satu waktu.']);
        }

        if ($book->stok_tersedia < 1) {
            return back()->withErrors(['pinjam' => 'Stok buku sedang tidak tersedia.']);
        }

        Peminjaman::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'judul' => $book->judul,
            'gambar' => $book->gambar,
            'status' => Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
        ]);

        return back()->with('success', 'Permintaan pinjam buku berhasil dikirim dan menunggu konfirmasi petugas.');
    }
}
