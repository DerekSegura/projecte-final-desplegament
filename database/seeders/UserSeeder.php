<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'David',
            'email' => 'david.martinez@gmail.com',
            'email_verified_at' => null,
            'password' => Hash::make('123'),
            'remember_token' => Str::random(20),
        ]);

        User::create([
            'name' => 'Roma',
            'email' => 'roma.bejar@gmail.com',
            'email_verified_at' => null,
            'password' => Hash::make('123'),
            'remember_token' => Str::random(20),
        ]);

        User::create([
            'name' => 'oriol',
            'email' => 'oriol.rodriguez@gmail.com',
            'email_verified_at' => null,
            'password' => Hash::make('usuari'),
            'remember_token' => Str::random(20),
        ]);
    }
}
