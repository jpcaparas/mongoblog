<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * @var \Illuminate\Database\Eloquent\Collection $tags
         */
        $tags = factory(\App\Models\Tag::class, 30)->make();

        $tags->each(function(\App\Models\Tag $tag) {
            $tag->save();
        });
    }
}
