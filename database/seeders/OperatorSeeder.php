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
            'name' => 'operator1',
            'address' => 'denpasar',
            'website' => 'www.operator1.com',
            'handphone_number' => '3424234',
            'email' => 'operator1@example.com',
        ]);
    }
}
