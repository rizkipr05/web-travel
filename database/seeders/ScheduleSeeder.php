<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Route;
use App\Models\Vehicle;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $routes = Route::all();
        $vehicles = Vehicle::all();

        if ($routes->isEmpty() || $vehicles->isEmpty()) {
            return;
        }

        foreach ($routes as $route) {
            foreach ($vehicles as $vehicle) {
                Schedule::create([
                    'route_id' => $route->id,
                    'vehicle_id' => $vehicle->id,
                    'departure_time' => now()->addDays(rand(1, 30))->setHour(rand(8, 20))->setMinute(0)->setSecond(0),
                ]);
            }
        }
    }
}
