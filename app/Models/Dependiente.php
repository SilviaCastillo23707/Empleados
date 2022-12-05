<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dependiente extends Model
{
    //Atributos y tablas
    use HasFactory, SoftDeletes;
    protected $table = 'dependientes';


}