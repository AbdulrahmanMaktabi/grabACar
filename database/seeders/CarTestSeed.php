<?php

namespace Database\Seeders;

use App\Models\Marker;
use App\Models\Models;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarTestSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a 5 random users
        User::factory()->count(5)->create();

        // create markers 
        Marker::factory()->count(5)->create();

        //create models for markers
        Models::factory()->count(5)->create();
    }
}
