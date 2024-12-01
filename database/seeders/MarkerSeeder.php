<?php

namespace Database\Seeders;

use App\Models\Marker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Marker::factory()->count(5)->create();
    }
}
