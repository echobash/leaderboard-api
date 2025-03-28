<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_user() {
        $response = $this->post('/users', ['name' => 'Echobash', 'age' => 29, 'address' => 'Gurgao']);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'name' => 'Echobash',
            'age' => 30,
            'address' => 'Gurugram'
        ]);

        // Retrieve the user and check if all attributes match
        $user = \App\Models\User::where('name', 'Echobash')->first();

        $this->assertNotNull($user);
        $this->assertEquals(30, $user->age);
        $this->assertEquals('Gurugram', $user->address);
    }
}
