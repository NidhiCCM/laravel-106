<?php

use App\Models\User;
use Tests\TestCase;

beforeEach(fn () => $this->user = User::factory()->create());

it("authenticated user can visit the create role route", function()
{
    $response = $this->actingAs($this->user)->get('/roles/create');

    $response->assertStatus(200);
});

it("unauthenticated user cannot visit the create role route", function()
{
    $response = $this->get('/roles/create');

    $response->assertStatus(302);
});

it("unauthenticated user cannot store a role", function()
{
    $response = $this->post('/roles');

    $response->assertStatus(302);
});

it("authenticated user can store a role", function()
{
    $response = $this->actingAs($this->user)
                    ->post('/roles', [
                        'user_id' => $this->user->id,
                        'name' => 'role'
                ]);

    $response->assertRedirect('/roles');

    $this->assertDatabaseHas('roles', [
            'name' => 'role'
        ]);
});

it("requires a role name", function()
{
    $response = $this->actingAs($this->user)->post('/roles');
    
    $response->assertSessionHasErrors(['name']);
});

it("create role has name label", function()
{
    $response = $this->actingAs($this->user)->get('/roles/create');

    $response->assertSee('Name');
});
