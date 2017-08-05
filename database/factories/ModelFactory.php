<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * @see https://laravel.com/docs/5.4/database-testing#writing-factories
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

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

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucwords(join(' ', $faker->words(2))),
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->word
    ];
});