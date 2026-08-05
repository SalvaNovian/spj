<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'nama'     => 'Administrator',
            'nip'      => '123456',
            'jabatan'  => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'status'   => true,
        ]);

        // Buat akun pimpinan
        User::create([
            'nama'     => 'Pimpinan',
            'nip'      => '654321',
            'jabatan'  => 'Kepala',
            'username' => 'pimpinan',
            'password' => Hash::make('password'),
            'role'     => 'pimpinan',
            'status'   => true,
        ]);

        // Buat akun user biasa
        User::create([
            'nama'     => 'User Biasa',
            'nip'      => '111111',
            'jabatan'  => 'Staf',
            'username' => 'user',
            'password' => Hash::make('password'),
            'role'     => 'user',
            'status'   => true,
        ]);
    }
}
