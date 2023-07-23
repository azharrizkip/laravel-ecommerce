<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat data user dengan peran "admin"
        User::create([
            'name' => 'Admin User',
            'gender' => 'Male',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Buat data user dengan peran "staff"
        User::create([
            'name' => 'Staff User',
            'gender' => 'Male',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // Menyimpan 8 data user secara acak dengan peran "buyer"
        for ($i = 0; $i < 8; $i++) {
            User::create([
                'name' => 'Buyer ' . ($i + 1),
                'gender' => $i % 2 == 0 ? 'Male' : 'Female',
                'email' => 'buyer' . ($i + 1) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'buyer',
            ]);
        }
    }
}
