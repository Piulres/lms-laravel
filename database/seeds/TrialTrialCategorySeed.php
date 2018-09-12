<?php

use Illuminate\Database\Seeder;

class TrialTrialCategorySeed extends Seeder
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
        DB::table('trail_trailscategory')->insert([
            'trail_id' => $faker->randomDigitNotNull,
            'trailscategory_id' => $faker->randomDigitNotNull,
        ]);
        }
    }
}
