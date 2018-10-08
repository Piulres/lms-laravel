<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TrailsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
       
        // for($i=0;$i<10;$i++){
        //     \App\Trail::create([
        //         'order' => $i+1,
        //         'title' => $faker->word,
        //         'slug' => $faker->word,
        //         'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        //         'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        //         'featured_image' => $faker->imageUrl(300,300),
        //         'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
        //         'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
        //         'approved' => 1,
        //     ]);
        // }

        $items = [
            ['order' => 1,
             'title' => "Trail 01",
             'slug' => "trail01",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 2,
             'title' => "Trail 02",
             'slug' => "trail02",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 3,
             'title' => "Trail 03",
             'slug' => "trail03",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 4,
             'title' => "Trail 04",
             'slug' => "trail04",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 5,
             'title' => "Trail 05",
             'slug' => "trail05",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 6,
             'title' => "Trail 06",
             'slug' => "trail06",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 7,
             'title' => "Trail 07",
             'slug' => "trail07",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 8,
             'title' => "Trail 08",
             'slug' => "trail08",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 9,
             'title' => "Trail 09",
             'slug' => "trail09",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
            ['order' => 10,
             'title' => "Trail 10",
             'slug' => "trail10",
             'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
             'introduction' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
             'start_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('d/m/Y'),
             'end_date' => Carbon::createFromTimeStamp($faker->dateTimeBetween('now', '+90 days')->getTimestamp())->format('d/m/Y'),
             'approved' => 1,
            ],
        ];   

        foreach ($items as $item) {
            \App\Trail::create($item);
        }
    }
}
