<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::truncate();

        // Buat 1 Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'adminutama@hogwart.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Buat 1 Guru
        User::create([
            'name' => 'Budi Santoso, S.Pd.',
            'email' => 'guru@siakad.com',
            'password' => Hash::make('12345678'),
            'role' => 'guru'
        ]);
    }
}
