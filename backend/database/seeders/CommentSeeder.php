<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Seed the application's users and admins.
     */
    public function run(): void
    {
        \App\Models\Comment::create([
            'post_id' => \App\Models\Post::all()->first()->id,
            'user_id' => \App\Models\User::skip(1)->take(1)->first()->id,
            'comment' => 'Yes i second this opinion. Very well explained'
        ]);
        \App\Models\Comment::create([
            'post_id' => \App\Models\Post::all()->first()->id,
            'user_id' => \App\Models\User::skip(2)->take(1)->first()->id,
            'comment' => 'Yes i can confirm you are 100% correct'
        ]);
    }
}
