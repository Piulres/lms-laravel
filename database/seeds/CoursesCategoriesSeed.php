<?php

use Illuminate\Database\Seeder;

class CoursesCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0;$i<20;$i++){
            \App\Coursescategory::create([
               'title' => $faker->word,               
            ]);
        }
    }
}
