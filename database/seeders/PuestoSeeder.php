<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Departamento;
use Carbon\Carbon;
use DB;
class PuestoSeeder extends Seeder
{
    //Llenado de tabla

    public function run()
    {
        $faker = Faker::create();
        $departamentos = Departamento::all();
        $random = rand(1, 3);
        foreach ($departamentos as $departamento) 
        {
            for ($i = 0; $i <= $random; $i++) 
            {
                DB::table('puestos')->insert([
                    'nombre' => $faker->title,
                    'idDepartamento' => $departamento->id,
                    'salario' => rand(100, 500),
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }
}
