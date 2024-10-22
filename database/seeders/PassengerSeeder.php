<?php

namespace Database\Seeders;

use App\Models\Passenger;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Passenger::create([
            'date' => '2024-10-14',
            'ship_id' => '1',
            'departure_passenger' => '10',
            'arrival_passenger' => '12',
        ]);
        Passenger::create([
            'date' => '2024-10-15',
            'ship_id' => '2',
            'departure_passenger' => '10',
            'arrival_passenger' => '11',
        ]);
        
        Passenger::create([
            'date' => '2024-10-15',
            'ship_id' => '1',
            'departure_passenger' => '21',
            'arrival_passenger' => '22',
        ]);
        Passenger::create([
            'date' => '2024-10-16',
            'ship_id' => '2',
            'departure_passenger' => '10',
            'arrival_passenger' => '0',
        ]);
        Passenger::create([

            'date' => '2024-10-17',
            'ship_id' => '2',
            'departure_passenger' => '0',
            'arrival_passenger' => '13',
        ]);
    }
}
