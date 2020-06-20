<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles_Privilegios extends Model
{
    protected $table = 'roles_privilegios';
    protected $primary_key = 'id';
    protected $fillable = ['id_rol', 'id_privilegio'];

    public function roles()
    {
        return $this->belongsTo('App\Rol');
    }

    public function privilegios()
    {
        return $this->belongsTo('App\Privilegio');
    }
}
