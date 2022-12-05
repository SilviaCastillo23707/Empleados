<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Puesto;
use Carbon\Carbon;
use DB;
class EmpleadoSeeder extends Seeder
{
       //Llenado de tabla

    public function run()
    {
        $faker = Faker::create();
        $puestos = Puesto::all();
        $random = rand(1, 3);
        foreach ($puestos as $puesto) 
        {
            for ($i = 0; $i <= $random; $i++) 
            {
                $nacimiento =  Carbon::now()->subYears(rand(18,40));
                $nacimiento =  $nacimiento->subMonths(rand(1,12));

                $contratacion =  Carbon::now()->subYears(rand(1,10));
                $contratacion =  $contratacion->subMonths(rand(1,12));

                DB::table('empleados')->insert([
                    'nombre' => $faker->name,
                    'apellidoPaterno' => $faker->name,
                    'apellidoMaterno' => $faker->name,
                    'sexo' => rand(1, 3),
                    'telefono' => rand(1111111111,999999999),
                    'correo' => $faker->email,
                    'fechaNacimiento' => $nacimiento,
                    'fechaContratacion' => $contratacion,
                    'idPuesto' => $puesto->id,
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }
}
