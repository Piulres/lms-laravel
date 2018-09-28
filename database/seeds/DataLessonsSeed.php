<?php

use Illuminate\Database\Seeder;

class DataLessonsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
       
        for($i=0;$i<30;$i++){
            \App\Datalesson::create([
                'view' => $faker->numberBetween(0,1),
                'progress' => $faker->numberBetween(0,100),
                'course_id' => $faker->randomDigitNotNull,
                'user_id' => $faker->randomDigitNotNull,            
                'lesson_id' => $faker->randomDigitNotNull,            
            ]);
        }
    }
}
