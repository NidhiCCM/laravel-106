<?php

use App\Models\User;

beforeEach(fn () => $this->user = User::factory()->create());

it("authenticated user can visit the create role route", function()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/roles/create');

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
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post('/roles', [
            'user_id' => $user->id,
            'name' => 'name'
    ]);

    $response->assertRedirect('/roles');
   
    $this->assertDatabaseHas('roles', [
        'name' => 'name'
    ]);
});

it("requires a role name", function()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/roles');
    
    $response->assertSessionHasErrors(['name']);
});

it("create role has name label", function()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/roles/create');

    $response->assertSee('Name');
});
