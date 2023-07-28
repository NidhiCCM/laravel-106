<?php

use App\Models\User;
use App\Models\Role;

beforeEach(function(){
    $this->user = User::factory()->create();
    $this->role = Role::factory()->create(['user_id' => $this->user->id]); 
});

it("unauthenticated user cannot delete a product", function()
{
    $response = $this->delete('roles/'.$this->role->id);
                    
    $response->assertStatus(302);

    $this->assertDatabaseCount('roles', 1);
});

it("authenticated user can delete a product", function()
{
    $response = $this->actingAs($this->user)
                    ->delete("roles/{$this->role->id}")
                    ->assertRedirect('/roles');

   $this->assertDatabaseCount('roles', 0);
});