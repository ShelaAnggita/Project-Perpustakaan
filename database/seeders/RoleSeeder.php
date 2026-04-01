<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; 

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['petugas', 'kepala_perpustakaan'];

        foreach ($roles as $role) {
            Role::create([
                'role_name' => $role
            ]);
        }
    }
}