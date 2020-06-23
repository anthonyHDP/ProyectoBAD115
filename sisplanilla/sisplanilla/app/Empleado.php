<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'codigo_empleado';
    protected $fillable = ['codigo_jefe','primer_nombre', 'segundo_nombre','primer_apellido','segundo_apellido'];

    public function generos()
    {
        return $this->belongsTo('App\genero');
    }
    public function Estados_Civiles()
    {
        return $this->belongsTo('App\Estados_Civiles');
    }
     public function documentos_identificacion()
    {
        return $this->hasMany('App\Documentos_Identificacion');
    }
    public function contactos_telefonicos()
    {
        return $this->hasMany('App\contactos_telefonicos');
    }
    public function usuario()
    {
        return $this->belongsTo('App\usuario');
    }
    public function profesiones()
    {
        return $this->hasMany('App\profesiones');
    }
    public function direccion()
    {
        return $this->hasOne('App\direccion');
    }

}
