<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Services\Wink\WinkAuthor;
use App\Services\Wink\WinkPost;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
