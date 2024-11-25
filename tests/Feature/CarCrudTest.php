<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarCrudTest extends TestCase
{
    use RefreshDatabase; // This ensures the database is reset after each test

    public function test_create_car()
    {
        $data = [
            'name' => 'Test Car',
            'owner_id' => 1,
            'marker_id' => 1,
            'model_id' => 1,
            'carType_id' => 1,
            'fuel_id' => 1,
            'year' => 2020,
            'price' => '20000 $',
            'vin' => 'ABC123',
            'mileage' => '10000 KM',
            'address' => '123 Test Street',
            'description' => 'A nice test car',
            'car_specifications' => 'Test specs'
        ];

        $response = $this->post('/cars', $data); // Assuming you have a route for storing cars

        $response->assertStatus(201); // Assert that the status code is 201 (Created)
        $this->assertDatabaseHas('cars', ['name' => 'Test Car']); // Assert that the database contains this record
    }

    public function test_read_car()
    {
        $car = Car::factory()->create(); // Create a car instance using factory

        $response = $this->get("/cars/{$car->slug}"); // Assuming you use slug as the route parameter

        $response->assertStatus(200); // Assert that the request was successful
        $response->assertSee($car->name); // Check that the response contains the car's name
    }

    public function test_update_car()
    {
        $car = Car::factory()->create(); // Create a car instance

        $updatedData = [
            'name' => 'Updated Test Car',
            'price' => '25000 $',
            // Add other fields as necessary
        ];

        $response = $this->put("/cars/{$car->slug}", $updatedData); // Assuming you have a route for updating cars

        $response->assertStatus(200); // Assert the update was successful
        $this->assertDatabaseHas('cars', ['name' => 'Updated Test Car']); // Assert that the database contains the updated data
    }

    // This test will not delete any data and will focus on reading only
    public function test_list_cars()
    {
        Car::factory()->count(5)->create(); // Create 5 car records

        $response = $this->get('/cars'); // Assuming the route for listing cars

        $response->assertStatus(200); // Assert the status is OK
        $response->assertJsonCount(5); // Assert there are 5 cars in the response
    }
}
