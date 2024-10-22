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
            'name' => 'Bali Lines 01',
            'departure_route_id' => '1',
            'departure_time' => '08:30:00',
            'arrival_route_id' => '2',
            'arrival_time' => '17:30:00',
            'type' => 'regular',
            'image' => '1729589890.jpg',
            'operator_id' => '1',
        ]);

        Ship::create([
            'name' => 'Blue Star 02',
            'departure_route_id' => '3',
            'departure_time' => '08:30:00',
            'arrival_route_id' => '4',
            'arrival_time' => '17:30:00',
            'type' => 'regular',
            'image' => '1729532148.jpg',
            'operator_id' => '2',
        ]);

        Ship::create([
            'name' => 'Oscar 09',
            'departure_route_id' => '3',
            'departure_time' => '08:30:00',
            'arrival_route_id' => '4',
            'arrival_time' => '17:30:00',
            'type' => 'charter',
            'image' => '1729532148.jpg',
            'operator_id' => '2',
        ]);

        Ship::create([
            'name' => 'ship4',
            'departure_route_id' => '3',
            'departure_time' => '09:30:00',
            'arrival_route_id' => '4',
            'arrival_time' => '17:30:00',
            'type' => 'charter',
            'image' => '1729531931.jpg',
            'operator_id' => '2',
        ]);
    }
}
