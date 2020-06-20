<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipos_Contacto_Telefonico extends Model
{
    protected $table = 'tipos_contacto_telefonico';
    protected $primaryKey = 'id_tipo_contacto_telefonico';
    protected $fillable = ['titulo'];

    
    public function Contactos_Telefonicos()
    {
        return $this->hasMany('App\Contactos_Telefonicos');
    }
    
   
}