<?php

use Illuminate\Database\Seeder;

class CourseTagsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
       
        for($i=0;$i<10;$i++){
            \App\Coursetag::create([
               'title' => $faker->word,
               'slug' => $faker->word,
            ]);
        }
    }
}
