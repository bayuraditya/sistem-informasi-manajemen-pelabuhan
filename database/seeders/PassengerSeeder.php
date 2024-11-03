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
            'departure_passenger' => '15',
            'departure_passenger_retribution' => '10',
            'arrival_passenger' => '12',
            'retribution' => '200000',
   
            'user_passenger_id' => '2',
            'user_retribution_id' => '3',
        ]);
        Passenger::create([
            'date' => '2024-10-15',
            'ship_id' => '2',
            'departure_passenger' => '15',
            'departure_passenger_retribution' => '10',
            'arrival_passenger' => '11',
            'retribution' => '200000',
  
            'user_passenger_id' => '2',
            'user_retribution_id' => '3',
        ]);
        
        Passenger::create([
            'date' => '2024-10-15',
            'ship_id' => '1',
            'departure_passenger' => '21',
            'departure_passenger_retribution' => '15',
            'arrival_passenger' => '22',
            'retribution' => '200000',
            
            'user_passenger_id' => '2',
            'user_retribution_id' => '3',
        ]);
        Passenger::create([
            'date' => '2024-10-16',
            'ship_id' => '2',
            'departure_passenger' => '40',
            'departure_passenger_retribution' => '25',
            'arrival_passenger' => '0',
            'retribution' => '200000',
            'user_passenger_id' => '2',
            'user_retribution_id' => '3',
        ]);
        Passenger::create([
            'date' => '2024-10-17',
            'ship_id' => '2',
            'departure_passenger' => '30',
            'departure_passenger_retribution' => '23',
            'arrival_passenger' => '13',
            'retribution' => '200000',
            'user_passenger_id' => '2',
            'user_retribution_id' => '3',
        ]);
    }
}
