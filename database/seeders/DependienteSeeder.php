<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Empleado;
use Carbon\Carbon;
use DB;
class DependienteSeeder extends Seeder
{
    //Llenado de tabla

    public function run()
    {
        $faker = Faker::create();
        $empleados = Empleado::all();
        $random = rand(0, 3);
        foreach ($empleados as $empleado) 
        {
            for ($i = 0; $i <= $random; $i++) 
            {
                $nacimiento =  Carbon::now()->subYears(rand(18,30));
                $nacimiento =  $nacimiento->subMonths(rand(1,12));

                DB::table('dependientes')->insert([
                    'nombre' => $faker->name,
                    'apellidoPaterno' => $faker->name,
                    'apellidoMaterno' => $faker->name,
                    'sexo' => rand(1, 3),
                    'telefono' => rand(1111111111,999999999),
                    'correo' => $faker->email,
                    'fechaNacimiento' => $nacimiento,
                    'idEmpleado' => $empleado->id,
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }
}
