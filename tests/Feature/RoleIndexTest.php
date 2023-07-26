<?php

use App\Models\User;
use App\Models\Role;

it("has role index page", function()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/roles');

    $response->assertStatus(200); 
});

// it("can we see the new role", function()
// {
//     $role = Role::factory()->create();
//     $user = User::factory()->create();

//     $response = $this->get('/roles');
    
//     $response->assertseeText($role->name);
// });

