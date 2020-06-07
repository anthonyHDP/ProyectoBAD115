<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'codigo_empleado';
    protected $fillable = ['primer_nombre', 'segundo_nombre','primer_apellido','segundo_apellido'];
}