<?php

use Illuminate\Database\Seeder;

class CourseTrailSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // for($i=0;$i<20;$i++){
        //     DB::table('course_trail')->insert([
        //         'course_id' => $faker->randomDigitNotNull,
        //         'trail_id' => $faker->randomDigitNotNull,
        //     ]);
        // }

        $items = [
            ['trail_id' => 1 , 'course_id' => 1,],
            ['trail_id' => 1 , 'course_id' => 2,],
            ['trail_id' => 1 , 'course_id' => 3,],
            ['trail_id' => 1 , 'course_id' => 4,],

            ['trail_id' => 2 , 'course_id' => 3,],
            ['trail_id' => 2 , 'course_id' => 4,],

            ['trail_id' => 3 , 'course_id' => 2,],
            ['trail_id' => 3 , 'course_id' => 3,],
            ['trail_id' => 3 , 'course_id' => 4,],
            ['trail_id' => 3 , 'course_id' => 5,],

            ['trail_id' => 4 , 'course_id' => 4,],
            ['trail_id' => 4 , 'course_id' => 5,],
            ['trail_id' => 4 , 'course_id' => 6,],
            ['trail_id' => 4 , 'course_id' => 7,],
            ['trail_id' => 4 , 'course_id' => 8,],
            ['trail_id' => 4 , 'course_id' => 9,],

            ['trail_id' => 5 , 'course_id' => 1,],
            ['trail_id' => 5 , 'course_id' => 3,],
            ['trail_id' => 5 , 'course_id' => 5,],

            ['trail_id' => 6 , 'course_id' => 1,],
            ['trail_id' => 6 , 'course_id' => 2,],
            ['trail_id' => 6 , 'course_id' => 3,],
            ['trail_id' => 6 , 'course_id' => 8,],

            ['trail_id' => 7 , 'course_id' => 3,],
            ['trail_id' => 7 , 'course_id' => 4,],
            ['trail_id' => 7 , 'course_id' => 5,],
            ['trail_id' => 7 , 'course_id' => 6,],
            ['trail_id' => 7 , 'course_id' => 7,],
            ['trail_id' => 7 , 'course_id' => 8,],
            ['trail_id' => 7 , 'course_id' => 9,],
            ['trail_id' => 7 , 'course_id' => 10,],

            ['trail_id' => 8 , 'course_id' => 2,],

            ['trail_id' => 9 , 'course_id' => 4,],
            ['trail_id' => 9 , 'course_id' => 8,],
            ['trail_id' => 9 , 'course_id' => 9,],

            ['trail_id' => 10 , 'course_id' => 1,],
            ['trail_id' => 10 , 'course_id' => 3,],
            ['trail_id' => 10 , 'course_id' => 5,],
        ];

        foreach ($items as $item) {
            DB::table('course_trail')->insert([
                'trail_id' => $item["trail_id"],
                'course_id' => $item["course_id"],
            ]);
        };

    }
}
