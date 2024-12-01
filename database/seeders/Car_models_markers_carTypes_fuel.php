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

        $bmw = Marker::create(['name' => 'BMW']);
        $audi = Marker::create(['name' => 'Audi']);
        $toyota = Marker::create(['name' => 'Toyota']);
        $nissan = Marker::create(['name' => 'Nissan']);

        // collect($markers)->map(function ($marker) {
        //     Marker::create($marker);
        // });

        // Models
        $carModels = [
            ['marker_id' => $bmw->id, 'name' => 'Mustang'],
            ['marker_id' => $bmw->id, 'name' => 'Fiesta'],
            ['marker_id' => $audi->id, 'name' => '3-Series'],
            ['marker_id' => $audi->id, 'name' => 'X5'],
            ['marker_id' => $toyota->id, 'name' => 'A6'],
            ['marker_id' => $toyota->id, 'name' => 'Q7'],
            ['marker_id' => $nissan->id, 'name' => 'Corolla'],
            ['marker_id' => $nissan->id, 'name' => 'Camry'],
            ['marker_id' => $nissan->id, 'name' => 'Altima'],
            ['marker_id' => $nissan->id, 'name' => 'Sentra'],
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
