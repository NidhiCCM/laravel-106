<?php

use App\Models\User;
use App\Models\Role;

beforeEach(function(){

    $this->user = User::factory()->create();
    $this->role = Role::factory()->create(['user_id' => $this->user->id]);
    
});

it("a user can get a single role", function()
{
    $response = $this->actingAs($this->user)
                    ->get("roles/{$this->role->id}");
    
    $response->assertStatus(200)->assertSee([
                        'id' => $this->role->id,
                        'name' => $this->role->name,     
                    ]);
});