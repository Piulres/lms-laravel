<?php

use Illuminate\Database\Seeder;

class LessonSeed extends Seeder
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
               'title' => $faker->word,
               'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
               'content' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            ]);
        }
    }
}
