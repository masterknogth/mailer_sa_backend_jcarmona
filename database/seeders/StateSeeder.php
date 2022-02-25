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
       
        for ($i=1; $i <= 10; $i++) {
            \DB::table("states")->insert(
                array(                       
                    'name' => $faker->state(),
                    'country_id' => $i,
                    'created_at' =>date('Y-m-d H:m:s'),
                    'updated_at' =>date('Y-m-d H:m:s')
                    
                )   
            );
        }
        for ($i=1; $i <= 10; $i++) {
            \DB::table("states")->insert(
                array(                       
                    'name' => $faker->state(),
                    'country_id' => $i,
                    'created_at' =>date('Y-m-d H:m:s'),
                    'updated_at' =>date('Y-m-d H:m:s')
                    
                )   
            );
        }
        
    }
}
