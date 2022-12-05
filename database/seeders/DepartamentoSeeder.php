<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use DB;

class DepartamentoSeeder extends Seeder
{
    //Llenado de tabla

    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i <= 10; $i++) 
            {
                DB::table('departamentos')->insert([
                    'nombre' => 'Departamento de ' . $faker->state,
                    'direccion' => $faker->streetName,
                    'created_at' => Carbon::now()
                ]);
            }
    }
}
