<?php

namespace Database\Seeders;

use App\Models\Models;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Models::factory()->count(5)->create();
    }
}
