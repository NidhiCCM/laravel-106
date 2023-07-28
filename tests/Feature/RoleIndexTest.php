<?php

use App\Models\User;
use App\Models\Role;


beforeEach(fn() =>  $this->user = User::factory()->create());

it("has role index page", function()
{
    $response = $this->actingAs($this->user)->get('/roles');
    
    $response->assertStatus(200); 
});

it("authenticated user can see roles on index page", function()
{ 
    $role1 = Role::factory()->create([
        'user_id' => $this->user->id,
        'name' => 'role'  
    ]);
    
    $response = $this->actingAs($this->user)->get('/roles');
    $response->assertSuccessful();
    $response->assertSee('role', $role1);
    $this->assertCount(1, Role::all());   
});