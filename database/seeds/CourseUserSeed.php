<?php

use Illuminate\Database\Seeder;

class CourseUserSeed extends Seeder
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
            DB::table('course_user')->insert([
                'course_id' => $faker->randomDigitNotNull,
                'user_id' => $faker->randomDigitNotNull,
            ]);
        }
    }
}
