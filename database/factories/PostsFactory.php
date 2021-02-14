<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Wink\WinkAuthor;
use Wink\WinkPost;

$factory->define(WinkPost::class, function (Faker $faker) {
    return [
        'id' => Str::uuid(),
        "slug" => $faker->slug(),
        'title' => $faker->sentence(),
        'excerpt' => $faker->sentence(),
        'body' => $faker->paragraph(15),
        'published' => rand(0,1),
        'featured_image_caption' => $faker->sentence(),
        'author_id' => WinkAuthor::first()->id
    ];
});
