<?php

namespace Database\Seeders;

use App\Models\Ship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ship::create([
            'name' => 'ship1',
            'departure_route_id' => '1',
            'departure_time' => '08:30:00',
            'arrival_route_id' => '2',
            'arrival_time' => '16:30:00',
            'type' => 'regular',
            'operator_id' => '1',
        ]);

        Ship::create([
            'name' => 'ship2',
            'departure_route_id' => '3',
            'departure_time' => '09:30:00',
            'arrival_route_id' => '4',
            'arrival_time' => '17:30:00',
            'type' => 'charter',
            'operator_id' => '2',
        ]);
    }
}
