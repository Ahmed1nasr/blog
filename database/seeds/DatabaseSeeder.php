<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Wink\WinkAuthor;
use Wink\WinkPost;
use Wink\WinkTag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        WinkAuthor::create([
            'id' => (string) Str::uuid(),
            'name' => 'Elsayed Kamal',
            'slug' => 'elsayed',
            'bio' => "I'm a Web developer who is passionate about creating Laravel Apps.",
            'email' => "elsayedkamal581999@gmail.com",
            'password' => Hash::make("password"),
        ]);

        WinkAuthor::create([
            'id' => (string) Str::uuid(),
            'name' => 'Ahmed Essam',
            'slug' => 'ahmed',
            'bio' => "this ahmed essam bio",
            'email' => "ahmedessam55558@gmail.com",
            'password' => Hash::make("password"),
        ]);

        factory(WinkPost::class, 100)->create();

        collect(['database' , 'sql' , 'laravel' , 'queues' , 'tips' , 'api' , 'auth' , 'routing' , 'apps' , 'request'])->each(function($el){
            WinkTag::create([
                'id' => Str::uuid(),
                'name' => strtoupper($el),
                'slug' => Str::slug($el)
            ]);
        });
    }
}
