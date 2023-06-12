<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Seed the application's users and admins.
     */
    public function run(): void
    {
        $file = public_path('assets/cities.json');
        $data = json_decode(file_get_contents($file));

        foreach ($data as $key => $city) {

            City::create(['name' => $city]);
        }
    }
}
