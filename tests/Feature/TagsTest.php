<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Tag; // Import the Tag model

class TagsTest extends TestCase
{
    use RefreshDatabase;

    // work before any tests
    // public function setup(): void
    // {
    //     parent::setup();
    //     $this->seed([]);
    // }
    /**
     * Test creating a tag.
     */
    public function test_create_tag(): void
    {
        $data = [
            'name' => 'Test Tag',
            'description' => 'This is a test tag description.',
        ];

        $response = $this->post('/tags', $data); // Assuming you have a route for creating tags

        $response->assertStatus(201); // Assert that the tag was successfully created
        $this->assertDatabaseHas('tags', ['name' => 'Test Tag']); // Verify the tag is in the database
    }

    /**
     * Test retrieving a single tag.
     */
    public function test_read_tag(): void
    {
        $tag = Tag::factory()->create(); // Create a tag using the factory

        $response = $this->get("/tags/{$tag->id}"); // Assuming you use the tag's ID in the route

        $response->assertStatus(200); // Assert the request was successful
        $response->assertSee($tag->name); // Check if the response contains the tag's name
    }

    /**
     * Test updating a tag.
     */
    public function test_update_tag(): void
    {
        $tag = Tag::factory()->create(); // Create a tag

        $updatedData = [
            'name' => 'Updated Tag Name',
            'description' => 'Updated description for the tag.',
        ];

        $response = $this->put("/tags/{$tag->id}", $updatedData); // Assuming you have a route for updating tags

        $response->assertStatus(200); // Assert the update was successful
        $this->assertDatabaseHas('tags', ['name' => 'Updated Tag Name']); // Verify the updated data is in the database
    }

    /**
     * Test listing all tags.
     */
    public function test_list_tags(): void
    {
        Tag::factory()->count(5)->create(); // Create 5 tags using the factory

        $response = $this->get('/tags'); // Assuming you have a route for listing all tags

        $response->assertStatus(200); // Assert the request was successful
        $response->assertJsonCount(5); // Verify the response contains 5 tags
    }

    /**
     * Test Delete tags
     */
    public function test_delete_tag(): void
    {
        $tag = Tag::factory()->create();


        $this->assertDatabaseHas('tags', ['id' => $tag->id]);

        $response = $this->delete("/tags/{$tag->id}"); // Assuming you have a route for deleting tags

        $response->assertStatus(204); // Assert the delete was successful
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]); // Verify the tag is no longer in the database
    }
}
