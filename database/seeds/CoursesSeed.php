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
       
        /* for($i=0;$i<10;$i++){
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
        } */

        $items = [
            ['order' => 1,
             'title' => "Curso 01",
             'slug' => "curso1",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 2,
             'title' => "Curso 02",
             'slug' => "curso2",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 3,
             'title' => "Curso 03",
             'slug' => "curso3",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 4,
             'title' => "Curso 04",
             'slug' => "curso4",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 5,
             'title' => "Curso 05",
             'slug' => "curso5",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 6,
             'title' => "Curso 06",
             'slug' => "curso6",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 7,
             'title' => "Curso 07",
             'slug' => "curso7",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 8,
             'title' => "Curso 08",
             'slug' => "curso8",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 9,
             'title' => "Curso 09",
             'slug' => "curso9",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 10,
             'title' => "Curso 10",
             'slug' => "curso10",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'duration' => $faker->randomDigitNotNull,
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
        ];

        foreach ($items as $item) {
            \App\Course::create($item);
        }
    }
}
