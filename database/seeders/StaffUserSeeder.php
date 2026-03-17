<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffUserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gunja.com',
                'password' => Hash::make('gunja@admin123'),
                'role_id' => 1, // Admin
            ],
            [
                'name' => 'Receptionist User',
                'email' => 'reception@gunja.com',
                'password' => Hash::make('gunja@reception123'),
                'role_id' => 2, // Receptionist
            ],
            [
                'name' => 'Cashier User',
                'email' => 'cashier@gunja.com',
                'password' => Hash::make('gunja@cashier123'),
                'role_id' => 3, // Cashier
            ],
        ]);
    }
}