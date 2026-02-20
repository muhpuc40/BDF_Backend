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
            'name' => 'Admin User',
            'email' => 'admin@bdfbd.org',
            'password' => Hash::make('asdf1234##'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Minhaj Uddin Hassan',
            'email' => 'mdhassan49.muh@gmail.com',
            'password' => Hash::make('11111111'),
            'email_verified_at' => now(),
        ]);
    }
}