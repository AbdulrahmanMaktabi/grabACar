<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Car;
use App\Models\User; // Import User model
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarMainTest extends TestCase
{
    // use RefreshDatabase;

    // Helper method to create an authenticated user
    protected function authenticateUser()
    {
        $user = User::factory()->create(); // Create a user using the factory
        $this->actingAs($user); // Authenticate the user for the test
    }

    public function test_create_car()
    {
        $this->authenticateUser(); // Ensure the user is authenticated before the test

        $data = [
            'name' => 'Test Car',
            'owner_id' => 5, // Use the authenticated user's ID
            'marker_id' => 1,
            'model_id' => 1,
            'carType_id' => 1,
            'fuel_id' => 1,
            'year' => 2020,
            'price' => 20000,
            'vin' => 123,
            'mileage' => 1000,
            'address' => '123 Test Street',
            'description' => 'A nice test car',
            'car_specifications' => 'Test specs'
        ];

        $response = $this->post('/dashboard/car', $data);

        $response->assertStatus(201); // Assert the car was created
        $this->assertDatabaseHas('cars', ['name' => 'Test Car', 'owner_id' => auth()->id()]); // Ensure the owner_id is correct
    }


    public function test_read_car()
    {
        $this->authenticateUser(); // Ensure the user is authenticated before the test

        $car = Car::factory()->create();

        $response = $this->get("/dashboard/cars/{$car->slug}");

        $response->assertStatus(200); // Assert the request was successful
        $response->assertSee($car->name);
    }

    public function test_update_car()
    {
        $this->authenticateUser(); // Ensure the user is authenticated before the test

        $car = Car::factory()->create();

        $updatedData = [
            'name' => 'Updated Test Car',
            'price' => '25000 $',
        ];

        $response = $this->put("/dashboard/cars/{$car->slug}", $updatedData);

        $response->assertStatus(200); // Assert the update was successful
        $this->assertDatabaseHas('cars', ['name' => 'Updated Test Car']);
    }

    public function test_list_cars()
    {
        $this->authenticateUser(); // Ensure the user is authenticated before the test

        Car::factory()->count(5)->create();

        $response = $this->get('/dashboard/cars');

        $response->assertStatus(200); // Assert the status is OK
        $response->assertJsonCount(5); // Assert there are 5 cars in the response
    }
}
