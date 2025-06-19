<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        $this->seed(DataBaseSeeder::class);
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
