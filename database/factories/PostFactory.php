<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    static $isPublished;

    return [
        'title' => $faker->sentence(5),
        'content' => $faker->paragraph(20) . "\n\n" . $faker->paragraph(20),
        'excerpt' => $faker->sentence(8),
        'is_published' => $isPublished ?: $isPublished = true,
        'user_id' => function () {
            return App\Models\User::all()->random()->id;
        }
    ];
});
