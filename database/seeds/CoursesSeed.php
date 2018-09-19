<?php

use Illuminate\Database\Seeder;

class CoursesSeed extends Seeder
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
                'order' => $i+1,            
                'title' => $faker->word,
                'slug' => $faker->word,
                'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'featured_image' => $faker->imageUrl(300,300),
                'duration' => $faker->randomDigitNotNull,
                'start_date' => $faker->date($format = 'd/m/Y', $max = 'now'),
                'end_date' => $faker->date($format = 'd/m/Y', $min = 'now'),
                'approved' => 1,
            ]);
        }
    }
}
