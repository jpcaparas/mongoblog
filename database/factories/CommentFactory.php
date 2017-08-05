<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'author' => $faker->name,
        'author_email' => $faker->email,
        'author_url' => $faker->url,
        'author_ip' => $faker->ipv4,
        'author_agent' => $faker->userAgent,
        'content' => $faker->paragraph(10) . "\n\n" . $faker->paragraph(10),
        'post_id' => function () {
            return App\Models\Post::all()->random()->id;
        }
    ];
});