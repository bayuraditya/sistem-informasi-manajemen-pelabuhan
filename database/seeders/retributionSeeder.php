<?php

namespace Database\Seeders;

use App\Models\Retribution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class retributionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {    
        // $table->id();
        // $table->date('month');
        // $table->integer('target')->nullable();
        // $table->integer('total')->nullable();
        // $table->enum('status', ['tercapai', 'belum tercapai'])->default('belum tercapai');

        Retribution::create([
            'month' => '2024-10',
            'target' => 4000000,
            'total' => 1000000,
        ]);

        Retribution::create([
            'month' => '2024-11',
            'target' => 2000000,
            'total' => 0,
        ]);

        Retribution::create([
            'month' => '2024-09',
            'target' => 3000000,
            'total' => 0,
        ]);
        
    }
}
