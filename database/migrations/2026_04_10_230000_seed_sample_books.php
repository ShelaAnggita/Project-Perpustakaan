<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('books')->exists()) {
            return;
        }

        $categoryId = DB::table('categories')->where('nama', 'Umum')->value('id');

        DB::table('books')->insert([
            [
                'category_id' => $categoryId,
                'judul' => 'Dilan 1990',
                'penulis' => 'Pidi Baiq',
                'pengarang' => 'Pidi Baiq',
                'penerbit' => 'Pastel Books',
                'deskripsi' => 'Novel remaja tentang kisah cinta Dilan dan Milea.',
                'tahun_terbit' => 2014,
                'stok' => 5,
                'gambar' => 'Dilan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categoryId,
                'judul' => 'Angkasa dan 56 Hari',
                'penulis' => 'Destashya Wisnu',
                'pengarang' => 'Destashya Wisnu',
                'penerbit' => 'Loveable',
                'deskripsi' => 'Novel remaja populer dengan tema persahabatan dan cinta.',
                'tahun_terbit' => 2021,
                'stok' => 3,
                'gambar' => 'Angkasa.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categoryId,
                'judul' => 'Pendidikan Agama',
                'penulis' => 'Siti Aisyah',
                'pengarang' => 'Siti Aisyah',
                'penerbit' => 'Edu Pustaka',
                'deskripsi' => 'Buku pembelajaran pendidikan agama untuk siswa.',
                'tahun_terbit' => 2008,
                'stok' => 4,
                'gambar' => 'PendidikanAgama.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categoryId,
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'pengarang' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'deskripsi' => 'Novel inspiratif tentang perjuangan pendidikan di Belitung.',
                'tahun_terbit' => 2005,
                'stok' => 2,
                'gambar' => 'LaskarPelangi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('books')->whereIn('judul', [
            'Dilan 1990',
            'Angkasa dan 56 Hari',
            'Pendidikan Agama',
            'Laskar Pelangi',
        ])->delete();
    }
};
