<?php

use App\Models\User;
use App\Models\Role;

beforeEach(fn() =>  $this->user = User::factory()->create());

it("has role index page", function()
{
    $response = $this->actingAs($this->user)->get('/roles');

    $response->assertStatus(200); 
});

it("can we see the new role", function()
{ 
    $role = Role::factory()->create(['user_id' => $this->user->id, 'name'=> 'name']);

    $response = $this->actingAs($this->user)->get('/roles');
    
    $response->assertSeeText($role->name);
});

