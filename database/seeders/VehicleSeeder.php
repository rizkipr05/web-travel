<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::insert([
            ['name' => 'Safa Marwa Executive 01', 'total_seats' => 32, 'type' => 'Bus Executive', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Safa Marwa Royal 02', 'total_seats' => 24, 'type' => 'Bus Sleeper', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Safa Marwa Discovery 03', 'total_seats' => 45, 'type' => 'Bus Ekonomi Premium', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
