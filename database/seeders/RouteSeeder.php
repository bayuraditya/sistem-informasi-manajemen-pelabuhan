<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Route::create([
            'route' => 'denpasar - lombok',
        ]);
        Route::create([
            'route' => 'lombok - denpasar',
        ]);  
        Route::create([
            'route' => 'denpasar - perairan',
        ]);  
        Route::create([
            'route' => 'perairan - denpasar',
        ]);  
        Route::create([
            'route' => 'denpasar - nusa penida'
        ]);
        Route::create([
            'route' => 'nusa penida - denpasar'
        ]);
    }
}
