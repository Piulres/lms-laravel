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
        DB::table('course_user')->truncate();

        $faker = Faker\Factory::create();

        for($i=0;$i<10;$i++){
        DB::table('course_user')->insert([
            'course_id' => $faker->randomDigitNotNull,
            'user_id' => $faker->randomDigitNotNull,
        ]);
        }
    }
}
