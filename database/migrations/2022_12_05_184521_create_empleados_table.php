<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Creación de tabla
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidoPaterno');
            $table->string('apellidoMaterno')->nullable();
            $table->integer('sexo');
            $table->integer('telefono')->nullable();
            $table->string('correo');
            $table->date('fechaNacimiento');
            $table->date('fechaContratacion');
            $table->foreignId('idPuesto');
            $table->timestamps();
            $table->softDeletes();
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
