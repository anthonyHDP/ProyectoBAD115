<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados_Civiles extends Model
{
    protected $table = 'estados_civiles';
    protected $primaryKey = 'id_estado_civil';
    protected $fillable = ['titulo'];
    
    public function Empleado()
    {
        return $this->hasMany('App\Empleado');
    }


}
