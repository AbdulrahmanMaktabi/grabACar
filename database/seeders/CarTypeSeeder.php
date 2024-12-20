<?php

namespace Database\Seeders;

use App\Models\car_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        car_type::factory()->count(5)->create();
    }
}
