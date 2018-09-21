<?php

use Illuminate\Database\Seeder;

class CourseCourseCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0;$i<20;$i++){
            DB::table('course_coursecategory')->insert([
                'course_id' => $faker->randomDigitNotNull,
                'coursecategory_id' => $faker->randomDigitNotNull,
            ]);
        }
    }
}
