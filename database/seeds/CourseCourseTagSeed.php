<?php

use Illuminate\Database\Seeder;

class CourseCourseTagSeed extends Seeder
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
            DB::table('course_coursetag')->insert([
                'course_id' => $faker->randomDigitNotNull,
                'coursetag_id' => $faker->randomDigitNotNull,
            ]);
        }
    }
}
