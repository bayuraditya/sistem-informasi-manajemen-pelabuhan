<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Operator::create([
            'name' => 'ESA G',
            'address' => 'Jl. Tukad Punggawa, Serangan, Denpasar Selatan, Kota Denpasar, Bali',
            'website' => 'www.operator1.com',
            'handphone_number' => '085706264022',
            'email' => 'operator1@example.com',
            'image' => '1729604851.jpg',
        ]);
        Operator::create([
            'name' => 'AMANDIA',
            'address' => 'Jl. Noja No. 93 Kesiman Petilan, Denpasar',
            'website' => 'www.operator2.com',
            'handphone_number' => '085706264051',
            'email' => 'operator2@example.com',
            'image' => '1729604817.jpg',

        ]);
        Operator::create([
            'name' => 'SEA HORSE',
            'address' => 'Komp. Ruko Segitiga Emas Jl. By Pass Ngr Rai No.43, Badung, Bali',
            'website' => 'www.operator3.com',
            'handphone_number' => '085706264054',
            'email' => 'operator3@example.com',
            'image' => '1729532351.jpg',

        ]);
        Operator::create([
            'name' => 'JUSTIN',
            'address' => 'Warung Moru Jl. Tukad Punggawa, Serangan, Denpasar Selatan, Kota Denpasar, Bali',
            'website' => 'www.operator4.com',
            'handphone_number' => '085706264321',
            'email' => 'operator4@example.com',
            'image' => '1729589890.jpg',

        ]);
        Operator::create([
            'name' => 'Operator 5',
            'address' => 'Warung Moru Jl. Tukad Punggawa, Serangan, Denpasar Selatan, Kota Denpasar, Bali',
            'website' => 'www.operator5.com',
            'handphone_number' => '032106264321',
            'email' => 'operator5@example.com',
            'image' => '1729532148.jpg',

        ]);
     
        
    }
}
