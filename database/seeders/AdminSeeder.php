<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@telkom.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin', // Pastikan kolom ini sesuai dengan database Anda
        ]);
    }
}