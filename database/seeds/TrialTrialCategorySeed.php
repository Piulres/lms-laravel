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
        DB::table('trail_trailscategory')->truncate();

        $faker = Faker\Factory::create();

        for($i=0;$i<10;$i++){
        DB::table('trail_trailscategory')->insert([
            'trail_id' => $faker->randomDigitNotNull,
            'trailscategory_id' => $faker->randomDigitNotNull,
        ]);
        }
    }
}
