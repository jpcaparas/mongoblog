<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\Models\User::class, 10)->make();

        $users->each(function(\App\Models\User $user) {
           $user->save();
        });
    }
}
