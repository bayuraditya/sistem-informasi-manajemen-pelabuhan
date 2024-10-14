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

            'date' => '2024-10-15',
            'ship_id' => '1',
            'departing_passenger' => '10',
            'arrival_passenger' => '12',
        ]);
    }
}
