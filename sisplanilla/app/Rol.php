<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['nombre'];

    public function usuarios()
    {
        return $this->hasMany('App\Usuario');
    }

    public function roles_privilegios()
    {
        return $this->hasMany('App\Roles_Privilegios');
    }

    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
}
