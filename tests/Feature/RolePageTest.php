<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
class RolePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_roles_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/roles');

        $response->assertStatus(200);
    }
    public function test_roles_create_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/roles/create');

        $response->assertStatus(200);
    }
   
}