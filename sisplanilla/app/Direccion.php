<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';
    protected $primaryKey = 'id_direccion';
    protected $fillable = ['codigo_municipio','ubicacion','numero_vivienda'];

    public function Empleado()
    {
        return $this->hasOne('App\Empleado');
    }
   
    public function direccion(){
        return $this->belongsTo('App\Empresa');
        //return $this->hasOne('App\Empresa');
    }

}