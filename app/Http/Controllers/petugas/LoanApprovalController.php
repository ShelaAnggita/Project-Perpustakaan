<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanApprovalController extends Controller
{
    public function borrowIndex(Request $request): View
    {
        return view('admin.loans.borrow', [
            'pendingBorrows' => Peminjaman::with(['user', 'book'])
                ->where('status', Peminjaman::STATUS_MENUNGGU_PERSETUJUAN)
                ->whereNotNull('user_id')
                ->whereNotNull('book_id')
                ->latest()
                ->get(),
            'activeLoans' => Peminjaman::with(['user', 'book'])
                ->whereIn('status', [
                    Peminjaman::STATUS_DIPINJAM,
                    Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
                ])
                ->whereNotNull('user_id')
                ->whereNotNull('book_id')
                ->latest('tanggal_pinjam')
                ->get()
                ->each(fn (Peminjaman $item) => $item->denda = $item->denda_terhitung),
            'panel' => $request->is('kepala-perpustakaan/*') ? 'kepala' : 'petugas',
        ]);
    }

    public function approveBorrow(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== Peminjaman::STATUS_MENUNGGU_PERSETUJUAN) {
            return back()->withErrors(['pinjam' => 'Permintaan ini sudah diproses.']);
        }

        if (! $peminjaman->book || $peminjaman->book->stok_tersedia < 1) {
            return back()->withErrors(['pinjam' => 'Stok buku sudah habis saat konfirmasi dilakukan.']);
        }

        $user = $peminjaman->user;

        if (! $user) {
            return back()->withErrors(['pinjam' => 'Anggota untuk peminjaman ini tidak ditemukan.']);
        }

        $jumlahAktif = $user->peminjaman()
            ->where('id', '!=', $peminjaman->id)
            ->whereIn('status', [
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
            ])
            ->count();

        if ($jumlahAktif >= 3) {
            return back()->withErrors(['pinjam' => 'Anggota ini sudah mencapai batas maksimal 3 buku aktif.']);
        }

        $punyaBukuSama = $user->peminjaman()
            ->where('id', '!=', $peminjaman->id)
            ->where('book_id', $peminjaman->book_id)
            ->whereIn('status', [
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
            ])
            ->exists();

        if ($punyaBukuSama) {
            return back()->withErrors(['pinjam' => 'Anggota ini masih memegang buku yang sama pada transaksi lain.']);
        }

        $peminjaman->update([
            'status' => Peminjaman::STATUS_DIPINJAM,
            'tanggal_pinjam' => now(),
            'batas_kembali' => now()->addDays(3),
            'catatan' => 'Peminjaman disetujui petugas.',
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function rejectBorrow(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== Peminjaman::STATUS_MENUNGGU_PERSETUJUAN) {
            return back()->withErrors(['pinjam' => 'Permintaan ini sudah diproses.']);
        }

        $peminjaman->update([
            'status' => Peminjaman::STATUS_DITOLAK,
            'catatan' => 'Peminjaman ditolak petugas.',
        ]);

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }

    public function returnIndex(Request $request): View
    {
        $pendingReturns = Peminjaman::with(['user', 'book'])
            ->where('status', Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN)
            ->whereNotNull('user_id')
            ->whereNotNull('book_id')
            ->latest()
            ->get()
            ->each(fn (Peminjaman $item) => $item->denda = $item->denda_terhitung);

        $returnHistory = Peminjaman::with(['user', 'book'])
            ->whereIn('status', [
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_DIKEMBALIKAN,
            ])
            ->whereNotNull('user_id')
            ->whereNotNull('book_id')
            ->latest('tanggal_dikembalikan')
            ->get()
            ->each(fn (Peminjaman $item) => $item->denda = $item->denda_terhitung);

        return view('admin.loans.return', [
            'pendingReturns' => $pendingReturns,
            'returnHistory' => $returnHistory,
            'panel' => $request->is('kepala-perpustakaan/*') ? 'kepala' : 'petugas',
        ]);
    }

    public function approveReturn(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN) {
            return back()->withErrors(['pengembalian' => 'Pengembalian ini sudah diproses.']);
        }

        $tanggalDikembalikan = $peminjaman->tanggal_dikembalikan ?? now();
        $denda = $peminjaman->denda ?? $peminjaman->denda_terhitung;

        $peminjaman->update([
            'status' => Peminjaman::STATUS_DIKEMBALIKAN,
            'tanggal_dikembalikan' => $tanggalDikembalikan,
            'denda' => $denda,
            'catatan' => trim(($peminjaman->catatan ? $peminjaman->catatan.' ' : '').'Pengembalian disetujui petugas.'),
        ]);

        return back()->with('success', 'Pengembalian berhasil dikonfirmasi.');
    }

    public function rejectReturn(Peminjaman $peminjaman): RedirectResponse
    {
        if ($peminjaman->status !== Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN) {
            return back()->withErrors(['pengembalian' => 'Pengembalian ini tidak dapat ditolak.']);
        }

        $peminjaman->update([
            'status' => Peminjaman::STATUS_DITOLAK,
            'catatan' => trim(($peminjaman->catatan ? $peminjaman->catatan.' ' : '').'Pengembalian ditolak petugas.'),
        ]);

        return back()->with('success', 'Pengembalian telah ditolak.');
    }
}

