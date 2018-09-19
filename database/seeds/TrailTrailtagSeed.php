<?php

use Illuminate\Database\Seeder;

class TrailTrailtagSeed extends Seeder
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
            DB::table('trail_trailtag')->insert([
                'trail_id' => $faker->randomDigitNotNull,
                'trailtag_id' => $faker->randomDigitNotNull,
            ]);
        }
    }
}
