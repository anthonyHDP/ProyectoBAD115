<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $table = 'entidades';
    protected $primaryKey = 'id_entidad';
    protected $fillable = ['nombre'];

    public function privilegios()
    {
        return $this->hasMany('App\Privilegio'); 
    }
}
