<?php

use App\Models\User;
use App\Models\Role;

beforeEach(function(){

    $this->user = User::factory()->create();
    $this->role = Role::factory()->create(['user_id' => $this->user->id, 'name'=> 'name']);
    
});

it("a user can read the task", function()
{
    $response = $this->actingAs($this->user)->get('/roles'.$this->role->id);
    
    $response->assertSee($this->role->name);
});