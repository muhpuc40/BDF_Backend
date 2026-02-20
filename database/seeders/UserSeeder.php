<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'full_name' => 'Admin User',
            'email' => 'admin@bdfbd.org',
            'phone' => '1234567890',
            'institution' => 'BDF Admin University',
            'password' => Hash::make('asdf1234##'),
            'status' => 'active',
            'role' => 'admin',
        ]);

        User::create([
            'full_name' => 'Minhaj Uddin Hassan',
            'email' => 'mdhassan49.muh@gmail.com',
            'phone' => '0987654321',
            'institution' => 'Tech Institute',
            'password' => Hash::make('11111111'),
            'status' => 'active',
            'role' => 'admin',
        ]);
    }
}