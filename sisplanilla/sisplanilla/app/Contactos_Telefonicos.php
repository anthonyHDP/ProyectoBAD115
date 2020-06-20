<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactos_Telefonicos extends Model
{
    protected $table = 'contactos_telefonicos';
    protected $primaryKey = 'id_contacto_telefonico';
    protected $fillable = ['id_tipo_contacto_telefonico','numero'];

    public function Empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
    public function Tipos_Contacto_Telefonico()
    {
        return $this->belongsTo('App\Tipos_Conctacto_Telefonico');
    }
   
}