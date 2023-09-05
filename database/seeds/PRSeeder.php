<?php

use Illuminate\Database\Seeder;


class PRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\PR::class, 100000)->create(); 
    }
}
