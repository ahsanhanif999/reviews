<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;


class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            [
                'name' => 'Tag1',
                'is_active' => true,
                'created_by' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'tag1.jpg',
                'slug' => 'tag1-slug',
            ],
            [
                'name' => 'Tag2',
                'is_active' => true,
                'created_by' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'tag2.jpg',
                'slug' => 'tag2-slug',
            ],
            [
                'name' => 'Tag3',
                'is_active' => true,
                'created_by' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'tag3.jpg',
                'slug' => 'tag3-slug',
            ],
            [
                'name' => 'Tag4',
                'is_active' => true,
                'created_by' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'tag4.jpg',
                'slug' => 'tag4-slug',
            ],
            [
                'name' => 'Tag5',
                'is_active' => true,
                'created_by' => 11,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'tag5.jpg',
                'slug' => 'tag5-slug',
            ],
            // Add more tag data as needed
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }
    }
}
