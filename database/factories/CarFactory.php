<?php

namespace Database\Factories;

use App\Models\car_type;
use App\Models\fuel;
use App\Models\Marker;
use App\Models\Models;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'owner_id' => 1,
            'marker_id' => Marker::factory()->create()->id,
            'model_id' => Models::factory()->create()->id,
            'carType_id' => car_type::factory()->create()->id,
            'fuel_id' => fuel::factory()->create()->id,
            'year' => $this->faker->numberBetween(1990, 2025),
            'price' => $this->faker->numberBetween(1000, 2000),
            'vin' => $this->faker->numberBetween(1000, 9999),
            'mileage' => $this->faker->numberBetween(1000, 50000),
            'address' => $this->faker->address,
            'description' => $this->faker->paragraph,
            'car_specifications' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl()
        ];
    }
}
