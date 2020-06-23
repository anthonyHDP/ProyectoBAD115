<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'codigo_contrato';
    protected $fillable = ['codigo_empleado','codigo_puesto','fecha_inicio','fecha_final','duracion','tipo','salario','vigencia'];

    public function Empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
    public function Puesto()
    {
        return $this->belongsTo('App\Puesto');
    }
    public function Horarios_Laborales()
    {
        return $this->hasMany('App\Horarios_Laborales');
    }
   
}