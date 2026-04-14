<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pinjamanAktif = $user->peminjaman()
            ->whereIn('status', [
                Peminjaman::STATUS_MENUNGGU_PERSETUJUAN,
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
            ])
            ->with('book')
            ->latest()
            ->get();

        $totalDenda = $user->peminjaman()
            ->whereIn('status', [
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
                Peminjaman::STATUS_DIKEMBALIKAN,
            ])
            ->get()
            ->sum(fn (Peminjaman $peminjaman) => $peminjaman->denda_terhitung);

        return view('anggota.dashboard', [
            'pinjamanAktif' => $pinjamanAktif,
            'totalDipinjam' => $pinjamanAktif->where('status', Peminjaman::STATUS_DIPINJAM)->count(),
            'totalMenunggu' => $pinjamanAktif->where('status', Peminjaman::STATUS_MENUNGGU_PERSETUJUAN)->count(),
            'totalMenungguPengembalian' => $pinjamanAktif->where('status', Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN)->count(),
            'totalDenda' => $totalDenda,
        ]);
    }
}
