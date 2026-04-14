<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;

class SeedBooks extends Command
{
    protected $signature = 'seed:books';
    protected $description = 'Seed additional books for pagination testing';

    public function handle(): int
    {
        $books = [
            [
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra',
                'deskripsi' => 'Kisah perjuangan bangsa Indonesia melawan penjajahan.',
                'tahun_terbit' => 1980,
                'stok' => 14,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ],
            [
                'judul' => 'Ayat-Ayat Cinta',
                'penulis' => 'Habiburrahman El Shirazy',
                'penerbit' => 'Republika',
                'deskripsi' => 'Kisah cinta mahasiswa Indonesia di Mesir.',
                'tahun_terbit' => 2004,
                'stok' => 19,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ],
            [
                'judul' => 'Negeri 5 Menara',
                'penulis' => 'Ahmad Fuadi',
                'penerbit' => 'Gramedia Pustaka Utama',
                'deskripsi' => 'Petualangan spiritual di pesantren.',
                'tahun_terbit' => 2009,
                'stok' => 17,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ],
            [
                'judul' => 'Perahu Kertas',
                'penulis' => 'Dee Lestari',
                'penerbit' => 'Bentang Pustaka',
                'deskripsi' => 'Kumpulan cerita pendek yang menginspirasi.',
                'tahun_terbit' => 2009,
                'stok' => 13,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ],
            [
                'judul' => 'Sang Pemimpi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'deskripsi' => 'Lanjutan kisah Laskar Pelangi.',
                'tahun_terbit' => 2006,
                'stok' => 21,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ],
            [
                'judul' => 'Edensor',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'deskripsi' => 'Kisah petualangan di dunia mimpi.',
                'tahun_terbit' => 2010,
                'stok' => 15,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ],
            [
                'judul' => 'Filosofi Kopi',
                'penulis' => 'Dee Lestari',
                'penerbit' => 'Truedee Books',
                'deskripsi' => 'Kumpulan cerita tentang kehidupan dan cinta.',
                'tahun_terbit' => 2006,
                'stok' => 18,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ],
            [
                'judul' => 'Supernova',
                'penulis' => 'Dee Lestari',
                'penerbit' => 'Truedee Books',
                'deskripsi' => 'Kisah cinta yang luar biasa.',
                'tahun_terbit' => 2001,
                'stok' => 16,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ],
            [
                'judul' => 'Rectoverso',
                'penulis' => 'Dee Lestari',
                'penerbit' => 'Truedee Books',
                'deskripsi' => 'Kumpulan puisi dan cerita pendek.',
                'tahun_terbit' => 2008,
                'stok' => 12,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ],
            [
                'judul' => 'Madre',
                'penulis' => 'Dee Lestari',
                'penerbit' => 'Truedee Books',
                'deskripsi' => 'Kisah tentang ibu dan anak.',
                'tahun_terbit' => 2010,
                'stok' => 14,
                'gambar' => 'downloadremove.png',
                'category_id' => 1
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        $this->info('✅ Berhasil menambahkan ' . count($books) . ' buku baru');
        $this->info('Total buku sekarang: ' . Book::count());

        return self::SUCCESS;
    }
}