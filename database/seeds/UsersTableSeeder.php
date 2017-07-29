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


        factory(\App\User::class, 6)->create()->each(function ($u) {
            for ($i = 0; $i < 10; $i++):
                $u->movies()->save(factory(\App\Movie::class)->make());
            endfor;

        });

        factory(\App\Movie::class, 3)->create()->each(function ($u) {
            for ($i = 0; $i < 3; $i++):
                $u->actors()->save(factory(\App\Actor::class)->make());
            endfor;
        });


    }
}









