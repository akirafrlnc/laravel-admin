<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase; // This trait is useful to migrate the database and reset it after the tests

    public function testStoreUser()
    {
        $response = $this->postJson('/api/users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'role_id' => 1, // Ensure this role exists or is created during the test setup
            'password' => 'password'
        ]);

        $response->assertStatus(201); // HTTP 201 Created
        $response->assertJsonStructure([
            'data' => [
                'id',
                'first_name',
                'last_name',
                'email',
                // Include other fields expected in the response
            ]
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com'
        ]);
    }
}
