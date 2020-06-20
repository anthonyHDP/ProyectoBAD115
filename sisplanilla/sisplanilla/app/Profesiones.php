<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesiones extends Model
{
    protected $table = 'profesiones';
    protected $primaryKey = 'codigo_profesion';
    protected $fillable = ['codigo_profesion', 'titulo', 'descripcion'];

    public function empleados()
    {
        return $this->hasMany('App\Empleado');
    }
}

