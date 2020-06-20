<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipos_Identificacion extends Model
{
    protected $table = 'tipos_identificacion';
    protected $primaryKey = 'id_tipo_identificacion';
    protected $fillable = ['titulo'];

    
    public function Documentos_Identificacion()
    {
        return $this->hasMany('App\Documentos_Identificacion');
    }
    
   
}