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
            'departure_place' => 'denpasar',
            'departure_time' => '08:30:00',
            'arrival_place' => 'nusa penida',
            'arrival_time' => '16:30:00',
            'type' => 'regular',
            'operator_id' => '1',
        ]);
    }
}
