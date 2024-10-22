<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'name' => 'bayu',
            'email' => 'bayu@gmail.com',
            'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, earum.',
            'point' => '5',
            'status' => 'approve'

        ]);
        Review::create([
            'name' => 'bayuq',
            'email' => 'bayu1@gmail.com',
            'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, earum.',
            'point' => '4',
            'status' => 'pending'
        ]); Review::create([
            'name' => 'bayue',
            'email' => 'bayu2@gmail.com',
            'review' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, earum.',
            'point' => '1',
            'status' => 'declined'

        ]);
    }
}
