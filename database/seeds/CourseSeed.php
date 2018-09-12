<?php

use Illuminate\Database\Seeder;

class CourseSeed extends Seeder
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
            \App\Course::create([
               'title' => $faker->word,
               'featured_image' => $faker->imageUrl(300,300),
               'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
               'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
               'duration' => $faker->randomDigitNotNull,
            ]);
        }
    }
}
