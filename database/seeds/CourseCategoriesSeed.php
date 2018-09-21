<?php

use Illuminate\Database\Seeder;

class CourseCategoriesSeed extends Seeder
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
            \App\Coursecategory::create([
               'title' => $faker->word,
               'slug' => $faker->word,
            ]);
        }
    }
}
