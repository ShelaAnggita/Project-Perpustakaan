<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            if (! Schema::hasColumn('peminjamen', 'kondisi')) {
                $table->enum('kondisi', ['baik', 'rusak', 'hilang'])->nullable()->after('catatan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            if (Schema::hasColumn('peminjamen', 'kondisi')) {
                $table->dropColumn('kondisi');
            }
        });
    }
};
