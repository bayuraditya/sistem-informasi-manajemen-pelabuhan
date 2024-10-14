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
            'departure_route' => 'denpasar - nusa penida',
            'departure_time' => '08:30:00',
            'arrival_route' => 'nusa penida - denpasar',
            'arrival_time' => '16:30:00',
            'type' => 'regular',
            'operator_id' => '1',
        ]);

        Ship::create([
            'name' => 'ship2',
            'departure_route' => 'denpasar - lombok',
            'departure_time' => '09:30:00',
            'arrival_route' => 'lombok - denpasar',
            'arrival_time' => '17:30:00',
            'type' => 'charter',
            'operator_id' => '2',
        ]);
    }
}
