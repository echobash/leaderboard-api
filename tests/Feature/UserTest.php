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
        $response = $this->post('/users', ['name' => 'John', 'age' => 25, 'address' => '123 Street']);
        $response->assertStatus(302);
    }
}
