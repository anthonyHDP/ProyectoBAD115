<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            //$menus = Menu::orderBy('id_menu', 'desc')->paginate(10);

            
            $menus = Menu::join('roles','menus.id_rol','=','roles.id_rol')
            ->select('menus.id_menu','menus.id_rol','roles.nombre as nombre_rol','menus.titulo','menus.vista','menus.activo')
            ->orderBy('menus.id_menu', 'desc')->paginate(10);
            
        }
        else{
            //$menus = Menu::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_menu', 'desc')->paginate(3);

            $menus = Menu::join('roles','menus.id_rol','=','roles.id_rol')
            ->select('menus.id_menu','menus.id_rol','roles.nombre as nombre_rol','menus.titulo','menus.vista','menus.activo')
            ->where('menus.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('menus.id_menu', 'desc')->paginate(10);

        }
        

        return [
            'pagination' => [
                'total'        => $menus->total(),
                'current_page' => $menus->currentPage(),
                'per_page'     => $menus->perPage(),
                'last_page'    => $menus->lastPage(),
                'from'         => $menus->firstItem(),
                'to'           => $menus->lastItem(),
            ],
            'menus' => $menus
        ];
    }

    //LISTAR MENUS
    public function selectMenus(Request $request){
        if (!$request->ajax()) return redirect('/');
        $menus = Menu::select('id_menu','titulo')->orderBy('titulo', 'asc')->get();
        return ['menus' => $menus];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $menu = new Menu();
        $menu->id_rol = $request->id_rol;
        $menu->titulo = $request->titulo;
        $menu->vista = $request->vista;
        $menu->activo = '1';
        $menu->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $menu = Menu::findOrFail($request->id_menu);
        $menu->id_rol = $request->id_rol;
        $menu->titulo = $request->titulo;
        $menu->vista = $request->vista;
        $menu->activo = '1';
        $menu->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $menu = Menu::findOrFail($request->id_menu);
        $menu->activo = '0';
        $menu->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $menu = Menu::findOrFail($request->id_menu);
        $menu->activo = '1';
        $menu->save();
    }


}
