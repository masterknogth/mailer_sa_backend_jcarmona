<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StateSeeder extends Seeder
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
            \DB::table("states")->insert(
                array(                       
                    'name' => $faker->state(),
                    'country_id' => $faker->numberBetween(1,10),
                    'created_at' =>date('Y-m-d H:m:s'),
                    'updated_at' =>date('Y-m-d H:m:s')
                    
                )   
            );
        }
    }
}
