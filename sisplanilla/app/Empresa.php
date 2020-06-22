<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
     protected $table = 'empresa';
     protected $primaryKey = 'id_empresa';
     protected $fillable =[
        'id_direccion','actividad','tipo','representante_legal','identificador_nic','identificador_nit','telefono','pagina_web'
    ];

    /*public function direccion(){
        return $this->belongsTo('App\Direccion');
    }
    */
    public function direccion()
    {
        return $this->hasOne('App\Direccion');
        //return $this->belongsTo('App\Direccion');
    }
}
