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
        DB::table('course_trail')->truncate();

        $faker = Faker\Factory::create();

        for($i=0;$i<10;$i++){
        DB::table('course_trail')->insert([
            'course_id' => $faker->randomDigitNotNull,
            'trail_id' => $faker->randomDigitNotNull,
        ]);
        }
    }
}
