<?php

use App\Models\User;
use App\Models\Role;

beforeEach(function()
{
    $this->user = User::factory()->create();
    $this->role = Role::factory()->create(['user_id' => $this->user->id]); 
});

it("unauthenticated user can not update a role", function()
{
    $response = $this->put("roles/{$this->role->id}")
                    ->assertRedirect('/login');

    $this->assertDatabaseHas('roles', [
        'id' => $this->role->id,
        'name' => $this->role->name,
    ]);
});

it("authenticated user can update a role", function()
{
    $response = $this->actingAs($this->user)
                    ->put('roles/'.$this->role->id, [
                        'id' => $this->role->id,
                        'name' => 'new name'
                    ])
                    ->assertStatus(302);

    $this->assertDatabaseHas('roles', [
        'id' => $this->role->id,
        'name' => 'new name',
    ]);
});
