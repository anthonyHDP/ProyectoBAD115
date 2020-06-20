<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $table = 'acciones';
    protected $primaryKey = 'id_accion';
    protected $fillable = ['nombre'];

    public function privilegios()
    {
        return $this->hasMany('App\Privilegio');
    }
}
