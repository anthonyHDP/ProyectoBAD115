<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentos_Identificacion extends Model
{
    protected $table ='documentos_identificacion';
    protected $primaryKey = 'numero_documento_identificacion';
    protected $fillable = ['id_tipo_identificacion','detalles'];

    public function Empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
    public function Tipos_Identificacion()
    {
        return $this->belongsTo('App\Tipos_Identificacion');
    }
}