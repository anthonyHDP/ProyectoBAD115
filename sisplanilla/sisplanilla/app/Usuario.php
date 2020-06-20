<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = ['id_rol', 'codigo_empleado', 'username', 'password', 'activo', 'first_session', 'last_session', 'intentos_fallidos'];

    public function roles()
    {
        return $this->belongsTo('App\Rol');
    }
}
