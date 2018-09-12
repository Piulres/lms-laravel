<?php

use Illuminate\Database\Seeder;

class DataCoursesSeed extends Seeder
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
        DB::table('datacourses')->insert([
            'view' => $faker->numberBetween(0,1),
            'progress' => $faker->numberBetween(0,2),
            'rating' => $faker->numberBetween(1,5),
            'course_id' => $faker->randomDigitNotNull,
            'user_id' => $faker->randomDigitNotNull,
        ]);
        }
    }
}
