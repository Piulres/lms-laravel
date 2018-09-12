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
        $faker = Faker\Factory::create();

        for($i=0;$i<20;$i++){
        DB::table('course_coursescategory')->insert([
            'course_id' => $faker->randomDigitNotNull,
            'coursescategory_id' => $faker->randomDigitNotNull,
        ]);
        }
    }
}
