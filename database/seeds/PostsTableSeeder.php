<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Post::class, 50)
            ->create()
            ->each(function(\App\Models\Post $p) {
                // Attach categories
                $p->categories()->attach(\App\Models\Category::inRandomOrder()->limit(3)->get());

                // Attach tags
                $p->tags()->attach(\App\Models\Tag::inRandomOrder()->limit(7)->get());
            });
    }
}
