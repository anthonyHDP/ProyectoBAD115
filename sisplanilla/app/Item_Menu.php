<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_Menu extends Model
{
    //
    protected $table = 'items_menu';
    protected $primaryKey = 'id_item_menu';
    protected $fillable =[
        'id_menu','id_item_superior','titulo','url_menu','activo'
    ];

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }


}
