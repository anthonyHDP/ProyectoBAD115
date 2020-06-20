<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item_Menu;

class ItemMenuController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            //$menus = Menu::orderBy('id_menu', 'desc')->paginate(10);

            //->join('items_menu','items_menu.id_item_superior','=','items_menu.id_item_menu')
            /*
            $items_menu = Item_Menu::join('menus','items_menu.id_menu','=','menus.id_menu')
            ->select('items_menu.id_item_menu','items_menu.id_item_superior','items_menu.titulo','menus.id_menu','menus.titulo as titulo_menu','items_menu.activo','items_menu.url_menu')
            ->orderBy('items_menu.id_item_menu', 'desc')->paginate(10);
            */
            
            $items_menu = Item_Menu::join('menus','items_menu.id_menu','=','menus.id_menu')
            ->leftJoin('items_menu as item_padre','items_menu.id_item_superior','=','item_padre.id_item_menu')
            ->select('items_menu.id_item_menu','items_menu.id_item_superior','items_menu.titulo','items_menu.url_menu','menus.id_menu','menus.titulo as titulo_menu','item_padre.id_item_menu as id_padre','item_padre.titulo as titulo_padre','items_menu.activo')
            ->orderBy('items_menu.id_item_menu', 'desc')->paginate(10);
            

        }
        else{
            //$menus = Menu::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_menu', 'desc')->paginate(3);

            $items_menu = Item_Menu::join('menus','items_menu.id_menu','=','menus.id_menu')
            ->leftJoin('items_menu as item_padre','items_menu.id_item_superior','=','item_padre.id_item_menu')
            ->select('items_menu.id_item_menu','items_menu.id_item_superior','items_menu.titulo','items_menu.url_menu','menus.id_menu','menus.titulo as titulo_menu','item_padre.id_item_menu as id_padre','item_padre.titulo as titulo_padre','items_menu.activo')
            ->where('items_menu.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('items_menu.id_item_menu', 'desc')->paginate(10);

        }
        

        return [
            'pagination' => [
                'total'        => $items_menu->total(),
                'current_page' => $items_menu->currentPage(),
                'per_page'     => $items_menu->perPage(),
                'last_page'    => $items_menu->lastPage(),
                'from'         => $items_menu->firstItem(),
                'to'           => $items_menu->lastItem(),
            ],
            'items_menu' => $items_menu
        ];
    }

    //LISTAR ITEMS MENUS
    public function selectItemsPadre(Request $request){
        if (!$request->ajax()) return redirect('/');
        $items_padre = Item_Menu::select('id_item_menu','titulo')->orderBy('titulo', 'asc')->get();
        return ['items_padre' => $items_padre];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $item_menu = new Item_Menu();
        $item_menu->id_menu = $request->id_menu;
        $item_menu->id_item_superior = $request->id_item_superior;
        $item_menu->titulo = $request->titulo;
        $item_menu->url_menu = $request->url_menu;

        //$item_menu->activo = '1';
        $item_menu->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $item_menu = Item_Menu::findOrFail($request->id_item_menu);
        $item_menu->id_menu = $request->id_menu;
        $item_menu->id_item_superior = $request->id_item_superior;
        $item_menu->titulo = $request->titulo;
        $item_menu->url_menu = $request->url_menu;

        //$item_menu->activo = '1';
        $item_menu->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $item_menu = Item_Menu::findOrFail($request->id_item_menu);
        $item_menu->activo = '0';
        $item_menu->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $item_menu = Item_Menu::findOrFail($request->id_item_menu);
        $item_menu->activo = '1';
        $item_menu->save();
    }


}
