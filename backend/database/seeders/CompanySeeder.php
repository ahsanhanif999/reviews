<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Seed the application's users and admins.
     */
    public function run(): void
    {
        $data = [

            ['name' => 'Suzuki', 'slug' => 'suzuki', 'logo' => 'suzuki.png'],
            ['name' => 'Toyota', 'slug' => 'toyota', 'logo' => 'toyota.png'],
            ['name' => 'Honda', 'slug' => 'honda', 'logo' => 'honda.png'],
            ['name' => 'Apple', 'slug' => 'apple', 'logo' => 'apple.png'],
            ['name' => 'Chanel', 'slug' => 'chanel', 'logo' => 'chanel.png'],
            ['name' => 'Procter and Gamble', 'slug' => 'procter-and-gamble', 'logo' => 'png.jpeg'],
        ];

        foreach ($data as $key => $company) {

            \App\Models\Company::create([
                'name' => $company['name'],
                'logo' => $company['logo'],
                'slug' => $company['slug'],
            ]);
        }
    }
}
