<?php

use Illuminate\Database\Seeder;

class CourseLessonSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course_lesson')->truncate();

        $faker = Faker\Factory::create();

        for($i=0;$i<10;$i++){
        DB::table('course_lesson')->insert([
            'course_id' => $faker->randomDigitNotNull,
            'lesson_id' => $faker->randomDigitNotNull,
        ]);
        }
    }
}
