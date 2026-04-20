<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Route::insert([
            ['origin' => 'Jambi', 'destination' => 'Padang', 'price' => 150000, 'estimated_duration' => '12 hours', 'created_at' => now(), 'updated_at' => now()],
            ['origin' => 'Padang', 'destination' => 'Jambi', 'price' => 150000, 'estimated_duration' => '12 hours', 'created_at' => now(), 'updated_at' => now()],
            ['origin' => 'Jambi', 'destination' => 'Sungai Penuh', 'price' => 120000, 'estimated_duration' => '8 hours', 'created_at' => now(), 'updated_at' => now()],
            ['origin' => 'Sungai Penuh', 'destination' => 'Jambi', 'price' => 120000, 'estimated_duration' => '8 hours', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
