<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's users and admins.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\Admin::create([
            'user_id' => \App\Models\User::all()->first()->id,
            'is_verified' => true
        ]);
    }
}
