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
       
        /* for($i=0;$i<10;$i++){
            \App\Lesson::create([
                'order' => $i+1,
                'title' => $faker->word,
                'slug' => $faker->word,
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'study_material' => $faker->imageUrl(300,300),
                'status' => $faker->numberBetween(0,1),
            ]);
        } */

        $items = [
            [   'order' => 1,
                'title' => "aula 01",
                'slug' => "aula1",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],
            [   'order' => 2,
                'title' => "aula 02",
                'slug' => "aula2",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],
            [   'order' => 3,
                'title' => "aula 03",
                'slug' => "aula3",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],
            [   'order' => 4,
                'title' => "aula 04",
                'slug' => "aula4",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],
            [   'order' => 5,
                'title' => "aula 05",
                'slug' => "aula5",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],
            [   'order' => 6,
                'title' => "aula 06",
                'slug' => "aula6",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],
            [   'order' => 7,
                'title' => "aula 07",
                'slug' => "aula7",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],
            [   'order' => 8,
                'title' => "aula 08",
                'slug' => "aula8",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],
            [   'order' => 9,
                'title' => "aula 09",
                'slug' => "aula9",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],
            [   'order' => 10,
                'title' => "aula 10",
                'slug' => "aula10",
                'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'content' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ],

        ];

        foreach ($items as $item) {
            \App\Lesson::create($item);
        }

    }
}
