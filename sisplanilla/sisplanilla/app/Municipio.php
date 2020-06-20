<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';
    protected $primaryKey = 'codigo_municipio';
    protected $fillable = ['codigo_departamento','nombre'];

    public function Direccion()
    {
        return $this->hasMany('App\Direccion');
    }
    public function Departamento()
    {
        return $this->belongsTo('App\Departamento');
    }
    
   
}