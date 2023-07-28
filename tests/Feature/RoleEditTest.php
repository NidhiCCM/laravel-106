<?php

use App\Models\User;
use App\Models\Role;

beforeEach(function(){
    $this->user = User::factory()->create();
    $this->role = Role::factory()->create(['user_id' => $this->user->id]); 
});

it("has role edit route", function()
{
  
    $response = $this->actingAs($this->user)->get('roles/'.$this->role->id.'/edit');

    $response->assertStatus(200);

});

it("has the role in the form", function()
{
    $response = $this->actingAs($this->user)->get('roles/'.$this->role->id.'/edit');

    $response->assertSee($this->role->name);

});

it("redirects unauthenticated user", function()
{
    $response = $this->get('roles/'.$this->role->id.'/edit');

    $response->assertStatus(302);
});
