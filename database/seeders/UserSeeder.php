<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
       
        \DB::table("users")->insert(
            array(        
                'rol'              => 1,//administrador               
                'nombre'           => $faker->name(),
                'telefono'         => "12346542",
                'cedula'           => "19453765",
                'email'            => "admin@gmail.com",
                'password'         => bcrypt('12345678'),
                'fecha_nacimiento' => "1990-12-20",
                'codigo_ciudad'    => "12345",
                'city_id'          => 1,
                'created_at'       => date('Y-m-d H:m:s'),
                'updated_at'       => date('Y-m-d H:m:s')
                
            )   
        );
        
    }
}
