<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@safamarwa.com'],
            [
                'name' => 'Safa Marwa Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '08123456789',
                'address' => 'HQ Safa Marwa, Jakarta',
            ]
        );

        // Create Regular User
        User::updateOrCreate(
            ['email' => 'user@safamarwa.com'],
            [
                'name' => 'Joko Safa',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'phone' => '08987654321',
                'address' => 'Jl. Kebahagiaan No. 1, Bandung',
            ]
        );

        // Dummy Users
        User::factory(5)->create();
    }
}
