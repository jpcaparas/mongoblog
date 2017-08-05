<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = factory(\App\Models\Comment::class, 50)->make();

        $comments->each(function(\App\Models\Comment $comment) {
            $comment->save();
        });
    }
}
