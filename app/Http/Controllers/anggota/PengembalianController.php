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
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
                Peminjaman::STATUS_DIKEMBALIKAN,
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
            'kondisi' => ['required', 'in:baik,rusak,hilang'],
        ]);

        $tanggalDikembalikan = \Carbon\Carbon::createFromFormat('Y-m-d', $request->tanggal_dikembalikan)->startOfDay();
        $tanggalPinjam = $peminjaman->tanggal_pinjam?->copy()->startOfDay() ?? now()->startOfDay();
        $batasKembali = $peminjaman->batas_kembali?->copy()->startOfDay();

        if ($tanggalDikembalikan->lt($tanggalPinjam)) {
            return back()->withErrors(['tanggal_dikembalikan' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.']);
        }

        $kondisi = $request->kondisi;
        $lateDays = 0;

        if ($batasKembali && $tanggalDikembalikan->gt($batasKembali)) {
            $lateDays = $batasKembali->diffInDays($tanggalDikembalikan);
        }

        $denda = match ($kondisi) {
            'baik' => $lateDays * 2000,
            'rusak' => 30000 + ($lateDays * 2000),
            'hilang' => 100000 + ($lateDays * 2000),
        };

        $peminjaman->update([
            'status' => Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
            'tanggal_pengajuan_kembali' => now(),
            'tanggal_dikembalikan' => $tanggalDikembalikan,
            'denda' => $denda,
            'catatan' => 'Kondisi: '.ucfirst($kondisi).'.',
        ]);

        return back()->with('success', 'Pengembalian diajukan. Tunggu konfirmasi petugas.');
    }
}
