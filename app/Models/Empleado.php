<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    //Atributos y tablas
    use HasFactory, SoftDeletes;
    protected $table = 'empleados';

    //Función para mandar directo el puesto del empleado

    public function puesto() {
        return $this->belongsTo(Puesto::class, 'idPuesto');
    }
}
