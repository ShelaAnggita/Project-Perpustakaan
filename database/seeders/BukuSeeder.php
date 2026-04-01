<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'judul' => 'Algoritma Python',
            'gambar' => 'AlgoritmaPython.jpg'
        ]);

        Book::create([
            'judul' => 'Angkasa',
            'gambar' => 'Angkasa.jpg'
        ]);
        Book::create([
            'judul' => 'Dilan 1990',
            'gambar' => 'Dilan.jpg'
        ]);
        Book::create([
            'judul' => 'Laskar Pelangi',
            'gambar' => 'LaskarPelangi.jpg'
        ]);
        Book::create([
            'judul' => 'Matematika',
            'gambar' => 'Matematika.jpg'
        ]);
        Book::create([
            'judul' => 'PAI',
            'gambar' => 'PAI.jpg'
        ]);
        Book::create([
            'judul' => 'Pendidikan Agama Islam',
            'gambar' => 'PendidikanAgama.jpg'
        ]);
        Book::create([
            'judul' => 'Pulang Pergi',
            'gambar' => 'PulangPergi.jpg'
        ]);
    }
}
