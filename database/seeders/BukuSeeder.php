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
            'penulis' => 'John Doe',
            'penerbit' => 'Gramedia',
            'deskripsi' => 'Buku panduan lengkap belajar algoritma dengan Python untuk pemula.',
            'tahun_terbit' => 2023,
            'stok' => 15,
            'gambar' => 'AlgoritmaPython.jpg',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Angkasa',
            'penulis' => 'Tere Liye',
            'penerbit' => 'Gramedia Pustaka Utama',
            'deskripsi' => 'Petualangan luar angkasa yang penuh misteri dan keajaiban.',
            'tahun_terbit' => 2022,
            'stok' => 12,
            'gambar' => 'Angkasa.jpg',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Dilan 1990',
            'penulis' => 'Pidi Baiq',
            'penerbit' => 'Pastel Books',
            'deskripsi' => 'Kisah cinta remaja di era 90an yang mengharukan.',
            'tahun_terbit' => 2014,
            'stok' => 20,
            'gambar' => 'Dilan.jpg',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'deskripsi' => 'Inspirasi perjuangan anak-anak Belitung untuk meraih pendidikan.',
            'tahun_terbit' => 2005,
            'stok' => 18,
            'gambar' => 'LaskarPelangi.jpg',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Matematika',
            'penulis' => 'Prof. Ahmad',
            'penerbit' => 'Erlangga',
            'deskripsi' => 'Buku matematika SMA kelas X lengkap dengan contoh soal.',
            'tahun_terbit' => 2023,
            'stok' => 25,
            'gambar' => 'Matematika.jpg',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'PAI',
            'penulis' => 'Dr. Hasan',
            'penerbit' => 'Kemenag',
            'deskripsi' => 'Pendidikan Agama Islam untuk siswa SMA.',
            'tahun_terbit' => 2022,
            'stok' => 30,
            'gambar' => 'PAI.jpg',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Pendidikan Agama Islam',
            'penulis' => 'Ust. Abdullah',
            'penerbit' => 'Pustaka Islam',
            'deskripsi' => 'Panduan lengkap ajaran Islam untuk generasi muda.',
            'tahun_terbit' => 2021,
            'stok' => 22,
            'gambar' => 'PendidikanAgama.jpg',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Pulang Pergi',
            'penulis' => 'Tere Liye',
            'penerbit' => 'Gramedia Pustaka Utama',
            'deskripsi' => 'Kisah perjalanan hidup yang penuh pelajaran.',
            'tahun_terbit' => 2018,
            'stok' => 16,
            'gambar' => 'PulangPergi.jpg',
            'category_id' => 1
        ]);

        // Tambahan 10 buku lagi untuk pagination
        Book::create([
            'judul' => 'Bumi Manusia',
            'penulis' => 'Pramoedya Ananta Toer',
            'penerbit' => 'Hasta Mitra',
            'deskripsi' => 'Kisah perjuangan bangsa Indonesia melawan penjajahan.',
            'tahun_terbit' => 1980,
            'stok' => 14,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Ayat-Ayat Cinta',
            'penulis' => 'Habiburrahman El Shirazy',
            'penerbit' => 'Republika',
            'deskripsi' => 'Kisah cinta mahasiswa Indonesia di Mesir.',
            'tahun_terbit' => 2004,
            'stok' => 19,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Negeri 5 Menara',
            'penulis' => 'Ahmad Fuadi',
            'penerbit' => 'Gramedia Pustaka Utama',
            'deskripsi' => 'Petualangan spiritual di pesantren.',
            'tahun_terbit' => 2009,
            'stok' => 17,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Perahu Kertas',
            'penulis' => 'Dee Lestari',
            'penerbit' => 'Bentang Pustaka',
            'deskripsi' => 'Kumpulan cerita pendek yang menginspirasi.',
            'tahun_terbit' => 2009,
            'stok' => 13,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Sang Pemimpi',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'deskripsi' => 'Lanjutan kisah Laskar Pelangi.',
            'tahun_terbit' => 2006,
            'stok' => 21,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Edensor',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'deskripsi' => 'Kisah petualangan di dunia mimpi.',
            'tahun_terbit' => 2010,
            'stok' => 15,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Filosofi Kopi',
            'penulis' => 'Dee Lestari',
            'penerbit' => 'Truedee Books',
            'deskripsi' => 'Kumpulan cerita tentang kehidupan dan cinta.',
            'tahun_terbit' => 2006,
            'stok' => 18,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Supernova',
            'penulis' => 'Dee Lestari',
            'penerbit' => 'Truedee Books',
            'deskripsi' => 'Kisah cinta yang luar biasa.',
            'tahun_terbit' => 2001,
            'stok' => 16,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Rectoverso',
            'penulis' => 'Dee Lestari',
            'penerbit' => 'Truedee Books',
            'deskripsi' => 'Kumpulan puisi dan cerita pendek.',
            'tahun_terbit' => 2008,
            'stok' => 12,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);

        Book::create([
            'judul' => 'Madre',
            'penulis' => 'Dee Lestari',
            'penerbit' => 'Truedee Books',
            'deskripsi' => 'Kisah tentang ibu dan anak.',
            'tahun_terbit' => 2010,
            'stok' => 14,
            'gambar' => 'downloadremove.png',
            'category_id' => 1
        ]);
    }
}
