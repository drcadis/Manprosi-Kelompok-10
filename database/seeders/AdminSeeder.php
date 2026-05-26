<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@telkom.ac.id'],
            [
                'name' => 'Super Admin',
                'password' => 'admin123',
                'role' => 'admin',
            ]
        );
    }
}