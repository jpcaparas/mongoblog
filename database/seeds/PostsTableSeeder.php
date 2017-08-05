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
        /**
         * @var \Illuminate\Database\Eloquent\Collection $posts
         */
        $posts = factory(\App\Models\Post::class, 50)->make();

        $posts->each(function(\App\Models\Post $p) {
            $p->save();

            // Attach categories
            $p->categories()->attach(\App\Models\Category::all()->random(3));

            // Attach tags
            $p->tags()->attach(\App\Models\Tag::all()->random(7));
        });
    }
}
