<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $pinjaman = Auth::user()->peminjaman()
            ->with('book')
            ->whereIn('status', [
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_MENUNGGU_ACC,
                Peminjaman::STATUS_DISETUJUI,
                Peminjaman::STATUS_SELESAI,
            ])
            ->latest()
            ->get();

        return view('anggota.pengembalian', compact('pinjaman'));
    }

    public function store(Request $request, Peminjaman $peminjaman): RedirectResponse
    {
        abort_if($peminjaman->user_id !== Auth::id(), 403);

        if ($peminjaman->status !== Peminjaman::STATUS_DIPINJAM) {
            return back()->withErrors(['pengembalian' => 'Buku ini belum bisa diajukan untuk dikembalikan.']);
        }

        $request->validate([
            'tanggal_dikembalikan' => ['required', 'date'],
        ]);

        $tanggalDikembalikan = \Carbon\Carbon::createFromFormat('Y-m-d', $request->tanggal_dikembalikan)->startOfDay();
        $tanggalPinjam = $peminjaman->tanggal_pinjam?->copy()->startOfDay() ?? now()->startOfDay();

        if ($tanggalDikembalikan->lt($tanggalPinjam)) {
            return back()->withErrors(['tanggal_dikembalikan' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.']);
        }

        $peminjaman->update([
            'status' => Peminjaman::STATUS_MENUNGGU_ACC,
            'tanggal_pengajuan_kembali' => now(),
            'tanggal_dikembalikan' => $tanggalDikembalikan,
        ]);

        return back()->with('success', 'Pengembalian diajukan. Tunggu ACC petugas.');
    }
}
