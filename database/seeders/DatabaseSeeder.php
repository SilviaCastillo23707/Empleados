<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        //Llamada a seeder para llenado de tablas
        $this->call([
            DepartamentoSeeder::class,
            PuestoSeeder::class,
            EmpleadoSeeder::class,
            DependienteSeeder::class,
        ]);
    }
}
