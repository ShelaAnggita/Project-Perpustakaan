<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman; 
use App\Models\Book;       
use Auth;

class PeminjamanController extends Controller
{

    public function pengembalian()
    {
        // Mengambil data pinjaman milik user yang sedang login 
        // dan statusnya masih 'dipinjam'
        $pinjaman = Peminjaman::with('book')
                    ->where('user_id', Auth::user()->id)
                    ->where('status', 'dipinjam')
                    ->get();

        return view('pengembalian', compact('pinjaman'));
    }

    public function prosesKembali(Request $request, $id)
    {
        
        $pinjaman = Peminjaman::findOrFail($id);

        $pinjaman->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => now(), // Mengambil tanggal hari ini
        ]);

        return redirect()->route('riwayat')->with('success', 'Buku berhasil dikembalikan!');
    }
}