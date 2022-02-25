<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
       
        for ($i=0; $i < 20; $i++) {
            \DB::table("cities")->insert(
                array(                       
                    'name' => $faker->city(),
                    'state_id' => $faker->numberBetween(1,20),
                    'created_at' =>date('Y-m-d H:m:s'),
                    'updated_at' =>date('Y-m-d H:m:s')
                    
                )   
            );
        }
    }
}
