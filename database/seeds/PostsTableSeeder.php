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
                $p->categories()->attach(\App\Models\Category::inRandomOrder()->limit(3)->get());
            });
    }
}
