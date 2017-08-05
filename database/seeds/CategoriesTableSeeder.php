<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(\App\Models\Category::class, 10)->make();

        $categories->each(function(\App\Models\Category $category) {
           $category->save();
        });
    }
}
