<?php

use Illuminate\Database\Seeder;

class DataTrailsSeed extends Seeder
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
            \App\Datatrail::create([
                'view' => $faker->numberBetween(0,1),
                'progress' => $faker->numberBetween(0,100),
                'rating' => $faker->numberBetween(1,5),
                'testimonal' => $faker->realText($maxNbChars = 200, $indexSize = 2),                
                'user_id' => $faker->randomDigitNotNull,
                'trail_id' => $faker->randomDigitNotNull,
                'certificate_id' => $faker->randomDigitNotNull,               
            ]);
        }
    }
}
