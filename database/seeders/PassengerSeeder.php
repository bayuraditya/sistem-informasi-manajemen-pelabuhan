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
            // id	date	ship_id	departing_passenger	arrival_passanger	created_at	updated_at	

            'date' => '2024-10-14',
            'ship_id' => '1',
            'departure_passenger' => '10',
            'arrival_passenger' => '12',
        ]);
        Passenger::create([
            // id	date	ship_id	departing_passenger	arrival_passanger	created_at	updated_at	

            'date' => '2024-10-14',
            'ship_id' => '2',
            'departure_passenger' => '9',
            'arrival_passenger' => '4',
        ]);
        
        Passenger::create([
            // id	date	ship_id	departing_passenger	arrival_passanger	created_at	updated_at	

            'date' => '2024-10-15',
            'ship_id' => '1',
            'departure_passenger' => '9',
            'arrival_passenger' => '4',
        ]);
        Passenger::create([
            // id	date	ship_id	departing_passenger	arrival_passanger	created_at	updated_at	

            'date' => '2024-10-15',
            'ship_id' => '2',
            'departure_passenger' => '9',
            'arrival_passenger' => '4',
        ]);
        Passenger::create([
            // id	date	ship_id	departing_passenger	arrival_passanger	created_at	updated_at	

            'date' => '2024-10-16',
            'ship_id' => '2',
            'departure_passenger' => '9',
            'arrival_passenger' => '4',
        ]);
    }
}
