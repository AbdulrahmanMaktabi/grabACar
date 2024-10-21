<?php

namespace Database\Seeders;

use App\Models\car_type;
use App\Models\fuel;
use App\Models\Marker;
use App\Models\Models;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Car_models_markers_carTypes_fuel extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Markers
        $markers = [
            ['name' => 'BMW'],
            ['name' => 'Audi'],
            ['name' => 'Toyota'],
            ['name' => 'Nissan'],
        ];

        collect($markers)->map(function ($marker) {
            Marker::create($marker);
        });

        // Models
        $carModels = [
            ['marker_id' => 1, 'name' => 'Mustang'],
            ['marker_id' => 1, 'name' => 'Fiesta'],
            ['marker_id' => 2, 'name' => '3-Series'],
            ['marker_id' => 2, 'name' => 'X5'],
            ['marker_id' => 3, 'name' => 'A6'],
            ['marker_id' => 3, 'name' => 'Q7'],
            ['marker_id' => 4, 'name' => 'Corolla'],
            ['marker_id' => 4, 'name' => 'Camry'],
            ['marker_id' => 5, 'name' => 'Altima'],
            ['marker_id' => 5, 'name' => 'Sentra'],
        ];
        collect($carModels)->map(function ($carModel) {
            Models::create($carModel);
        });

        // Car Types
        $carTypes = [
            ['name' => 'Sedan'],
            ['name' => 'SUV'],
            ['name' => 'Hatchback'],
            ['name' => 'Coupe'],
            ['name' => 'Convertible'],
            ['name' => 'Wagon'],
            ['name' => 'Pickup Truck'],
            ['name' => 'Van'],
            ['name' => 'Minivan'],
            ['name' => 'Crossover'],
        ];
        collect($carTypes)->map(function ($carType) {
            car_type::create($carType);
        });

        // Fuel
        $fuelTypes = [
            ['name' => 'Petrol'],
            ['name' => 'Diesel'],
            ['name' => 'Electric'],
            ['name' => 'Hybrid'],
            ['name' => 'CNG'],
            ['name' => 'LPG'],
            ['name' => 'Hydrogen'],
            ['name' => 'Biofuel'],
        ];
        collect($fuelTypes)->map(function ($fuel) {
            Fuel::create($fuel);
        });
    }
}
