<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
         $peminjaman = Peminjaman::all();
        return view('anggota.peminjaman', compact('peminjaman'));
    }
    public function store(Request $request)
    {
        Peminjaman::create([
            'judul' => $request->judul,
            'gambar' => $request->gambar
        ]);

        return redirect('/peminjaman');
    }
    public function destroy($id)
    {
        Peminjaman::findOrFail($id)->delete();
        return redirect('/peminjaman');
    }
}
