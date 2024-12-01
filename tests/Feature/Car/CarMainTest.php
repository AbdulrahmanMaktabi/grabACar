<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Car;
use App\Models\User; // Import User model
use Database\Seeders\Car_models_markers_carTypes_fuel;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function PHPUnit\Framework\assertNotEmpty;

class CarMainTest extends TestCase
{
    use RefreshDatabase;

    // work before any tests
    public function setup(): void
    {
        parent::setup();
        $this->seed([
            Car_models_markers_carTypes_fuel::class,
            UserSeeder::class
        ]);
    }

    /**
     * Test Create car
     */
    public function test_create_car(): void
    {
        $user = User::first();

        // Generate car data and associate with the user
        $carData = Car::factory()->make([
            'owner_id' => $user->id,
        ])->toArray();

        // Remove 'image' if it is managed separately
        unset($carData['image']);
        $car = Car::create($carData);

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'owner_id' => $user->id
        ]);
    }

    /**
     * Test Update car
     */
    public function test_update_car(): void
    {
        $user = User::first();

        $carData = Car::factory()->make(['owner_id' => $user->id])->toArray();
        unset($carData['image']);

        $car = Car::create($carData);

        $updatedData = [
            'name' => 'Updated Test Car',
            'price' => 2025,
            // Add other fields as necessary
        ];

        $car->update($updatedData);

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'name' => 'Updated Test Car',
            'price' => 2025,
            // Add other fields as necessary
        ]);
    }

    /**
     * Test Delete car
     */
    public function test_delete_car(): void
    {
        $user = User::first();

        $carData = Car::factory()->make(['owner_id' => $user->id])->toArray();
        unset($carData['image']);

        $car = Car::create($carData);

        $car->forceDelete();

        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }
}
