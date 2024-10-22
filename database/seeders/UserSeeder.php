<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('passwordadmin'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'operator1',
            'email' => 'operator1@gmail.com',
            'password' => Hash::make('passwordoperator'),
            'role' => 'operator',
        ]);
        DB::table('users')->insert([
            'name' => 'master',
            'email' => 'master@gmail.com',
            'password' => Hash::make('passwordmaster'),
            'role' => 'master',
        ]);
    }
}
