<?php

namespace Database\Seeders;

use App\Models\fuel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        fuel::factory()->count(5)->create();
    }
}
