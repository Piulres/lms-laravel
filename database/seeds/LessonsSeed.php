<?php

use Illuminate\Database\Seeder;

class LessonsSeed extends Seeder
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
            \App\Lesson::create([
                'order' => $i+1,
                'title' => $faker->word,
                'slug' => $faker->word,
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'study_material' => $faker->imageUrl(300,300),
            ]);
        }
    }
}
