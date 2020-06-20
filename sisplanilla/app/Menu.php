<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = 'menus';
    protected $primaryKey = 'id_menu';
    protected $fillable =[
        'id_rol','titulo','vista','activo'
    ];

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

    public function items_menu()
    {
        return $this->hasMany('App\Item_Menu');
    }
}
