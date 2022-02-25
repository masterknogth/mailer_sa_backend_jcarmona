<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
       
        for ($i=0; $i < 10; $i++) {
            \DB::table("countries")->insert(
                array(                       
                    'name' => $faker->country(),
                    'created_at' =>date('Y-m-d H:m:s'),
                    'updated_at' =>date('Y-m-d H:m:s')
                    
                )   
            );
        }
    }
}
