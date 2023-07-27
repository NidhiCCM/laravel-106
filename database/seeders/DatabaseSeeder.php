<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(20)->create()
        //     ->each(function($user) {
        //     Role::create([
        //         'user_id' => $user->id,
        //         'name' => fake()->name()
        //     ]);
        // });
        User::factory(5)->create();
        Role::factory(10)->create();
   
    }
}
