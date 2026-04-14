<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('nama')->unique();
                $table->text('deskripsi')->nullable();
                $table->timestamps();
            });
        }

        Schema::table('books', function (Blueprint $table) {
            if (! Schema::hasColumn('books', 'category_id')) {
                $table->foreignId('category_id')->nullable()->after('id')->constrained('categories')->nullOnDelete();
            }

            if (! Schema::hasColumn('books', 'penerbit')) {
                $table->string('penerbit')->nullable()->after('pengarang');
            }

            if (! Schema::hasColumn('books', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('penerbit');
            }
        });

        Schema::table('peminjamen', function (Blueprint $table) {
            if (! Schema::hasColumn('peminjamen', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->cascadeOnDelete();
            }

            if (! Schema::hasColumn('peminjamen', 'book_id')) {
                $table->foreignId('book_id')->nullable()->after('user_id')->constrained('books')->cascadeOnDelete();
            }

            if (! Schema::hasColumn('peminjamen', 'status')) {
                $table->string('status')->default('menunggu_persetujuan')->after('gambar');
            }

            if (! Schema::hasColumn('peminjamen', 'tanggal_pinjam')) {
                $table->dateTime('tanggal_pinjam')->nullable()->after('status');
            }

            if (! Schema::hasColumn('peminjamen', 'batas_kembali')) {
                $table->dateTime('batas_kembali')->nullable()->after('tanggal_pinjam');
            }

            if (! Schema::hasColumn('peminjamen', 'tanggal_pengajuan_kembali')) {
                $table->dateTime('tanggal_pengajuan_kembali')->nullable()->after('batas_kembali');
            }

            if (! Schema::hasColumn('peminjamen', 'tanggal_dikembalikan')) {
                $table->dateTime('tanggal_dikembalikan')->nullable()->after('tanggal_pengajuan_kembali');
            }

            if (! Schema::hasColumn('peminjamen', 'denda')) {
                $table->unsignedInteger('denda')->default(0)->after('tanggal_dikembalikan');
            }

            if (! Schema::hasColumn('peminjamen', 'catatan')) {
                $table->text('catatan')->nullable()->after('denda');
            }
        });

        DB::table('categories')->updateOrInsert(
            ['nama' => 'Umum'],
            ['deskripsi' => 'Kategori default perpustakaan', 'created_at' => now(), 'updated_at' => now()]
        );

        $defaultCategoryId = DB::table('categories')->where('nama', 'Umum')->value('id');

        DB::table('books')->whereNull('category_id')->update(['category_id' => $defaultCategoryId]);

        DB::table('users')->updateOrInsert(
            ['email' => 'kepala@perpustakaan.test'],
            [
                'nama_lengkap' => 'Kepala Perpustakaan',
                'password' => Hash::make('password123'),
                'role' => 'kepala_perpustakaan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            foreach (['user_id', 'book_id'] as $foreign) {
                if (Schema::hasColumn('peminjamen', $foreign)) {
                    $table->dropForeign([$foreign]);
                }
            }

            foreach ([
                'user_id',
                'book_id',
                'status',
                'tanggal_pinjam',
                'batas_kembali',
                'tanggal_pengajuan_kembali',
                'tanggal_dikembalikan',
                'denda',
                'catatan',
            ] as $column) {
                if (Schema::hasColumn('peminjamen', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }

            foreach (['penerbit', 'deskripsi'] as $column) {
                if (Schema::hasColumn('books', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::dropIfExists('categories');
    }
};
