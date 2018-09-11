<?php

use Illuminate\Database\Seeder;

class CourseCoursesCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course_coursescategory')->truncate();

        $faker = Faker\Factory::create();

        for($i=0;$i<10;$i++){
        DB::table('course_coursescategory')->insert([
            'course_id' => $faker->randomDigitNotNull,
            'coursescategory_id' => $faker->randomDigitNotNull,
        ]);
        }
    }
}
