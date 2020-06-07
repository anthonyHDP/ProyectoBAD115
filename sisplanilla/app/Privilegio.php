<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilegio extends Model
{
    protected $table = 'privilegios'; //En caso de que la tabla de la bd sea el mismo nombre del privilegio en plural, no es necesaria esta línea de código
    protected $primaryKey = 'id_privilegio'; //Si no se pone, asume que por defecto la PK se llama id
    protected $fillable = ['nombre', 'accion', 'entidad'];

    public function roles_privilegios()
    {
        return $this->hasMany('App\Roles_Privilegios');
    }
}
