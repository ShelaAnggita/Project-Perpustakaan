<?php

namespace App\Http\Controllers;
use App\Models\Book; 

class BukuController extends Controller
{
    public function index()
    {
        $books = Book::all(); 
        return view('anggota.koleksibuku', compact('books'));
    }

    public function show($id)
{
    $books = [
        1 => [
            'judul' => 'Dilan 1990',
            'gambar' => 'Dilan.jpg',
            'penulis' => 'Pidi Baiq',
            'tahun' => '2014',
            'stok' => '5'
        ],
        2 => [
            'judul' => 'Angkasa & 65 Hari',
            'gambar' => 'Angkasa.jpg',
            'penulis' => 'M. Iqbal',
            'tahun' => '2020',
            'stok' => '2'
        ],
        3 => [
            'judul' => 'Pendidikan Agama',
            'gambar' => 'PendidikanAgama.jpg',
            'penulis' => 'Siti Aisyah',
            'tahun' => '2008',
            'stok' => '0',
        ],
        4 => [
            'judul' => 'Angkasa & 56 Hari',
            'gambar' => 'Angkasa.jpg',
            'penulis' => 'Tere Liye',
            'tahun' => '2021',
            'stok' => '0',

        ]
    ];

    if (!isset($books[$id])) {
        abort(404);
    }

    $book = $books[$id];

    return view('anggota.detailbuku', compact('book'));
}
}