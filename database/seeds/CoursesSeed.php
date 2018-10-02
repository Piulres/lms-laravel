<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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
                'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
                'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
                'approved' => 1,
            ]);
        } 
    }
}
