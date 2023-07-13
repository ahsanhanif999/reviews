<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Seed the application's users and admins.
     */
    public function run(): void
    {
        \App\Models\Post::create([
            'user_id' => \App\Models\User::skip(1)->take(1)->first()->id,
            'company_id' => \App\Models\Company::where('name', 'Suzuki')->first()->id,
            'title' => 'Expect a lot more features in suzuki swift than people will tell you',
            'description' => 'I have a Suzuki Swift Sports 2016. It is done around 130,000kms and been very well looked after considering I bought it brand new! It has been serviced at Suzuki for years it was last serviced here in November 2021. 4 months later the transmission blows up whilst I was driving, no warning signs before hand nothing. Just blew up and would no longer drive forward',
            'status' => 'review',
            'slug' => 'expect-a-lot-more-features-in-suzuki-swift-than-people-will-tell-you',
            'rating' => 1
        ]);
        \App\Models\Post::create([
            'user_id' => \App\Models\User::skip(2)->take(1)->first()->id,
            'company_id' => \App\Models\Company::where('name', 'Suzuki')->first()->id,
            'title' => 'My suzuki XL7 experience is very bad',
            'description' => 'I just bought a Suzuki XL7 last year September 2020. In just six months rust are developing inside the glove box and outside of the door handle, drivers side in particular. I already informed my dealership regarding this matter but they just told us that they will call upon the approval of repair from Suzuki PH. This was not just an isolated case, it was a clear flaws of this Suzuki brand. This is not an isolated case because many of us (Suzuki XL7 PH owner) had the same problem and in the same spot of problem. Hope Suzuki had a time to read this complain and hope they will give us a better solution on this issues. This may give a bad impression on the integrity of how this car was built. The engine performance and the overall appearance was great but the rust problem will give you a headache. I will give you an update if they come up for a better solution on this',
            'status' => 'active',
            'slug' => 'my-suzuki-xl7-experience-is-very-bad',
            'rating' => 2
        ]);
        \App\Models\Post::create([
            'user_id' => \App\Models\User::skip(3)->take(1)->first()->id,
            'company_id' => \App\Models\Company::where('name', 'Apple')->first()->id,
            'title' => 'I purchased apple macbook and has a worst experience',
            'description' => 'It did not go well',
            'status' => 'active',
            'slug' => 'i-purchased-apple-macbook-and-has-a-worst-experience',
            'rating' => 3
        ]);
    }
}
