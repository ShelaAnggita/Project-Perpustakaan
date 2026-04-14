<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateHeadAccount extends Command
{
    protected $signature = 'app:create-head-account';
    protected $description = 'Create or update kepala_perpustakaan account';

    public function handle(): int
    {
        User::updateOrCreate(
            ['email' => 'kepala@perpustakaan.test'],
            [
                'nama_lengkap' => 'Kepala Perpustakaan',
                'password' => Hash::make('password123'),
                'role' => 'kepala_perpustakaan',
            ]
        );

        $this->info('Akun kepala berhasil dibuat/diperbarui');
        $this->line('Email: kepala@perpustakaan.test');
        $this->line('Password: password123');
        $this->line('Role: kepala_perpustakaan');

        return self::SUCCESS;
    }
}
