<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\Roles_Privilegios;
use App\Privilegio;

class RolController extends Controller
{

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $roles = Rol::orderBy('id_rol', 'desc')->paginate(4);
        }
        else{
            $roles = Rol::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_rol', 'desc')->paginate(4);
        }

        $roles_privilegios = Roles_Privilegios::join('roles', 'roles_privilegios.id_rol', '=', 'roles.id_rol')
                                                ->join('privilegios', 'roles_privilegios.id_privilegio', '=', 'privilegios.id_privilegio')
                                                ->select('roles_privilegios.id', 'roles_privilegios.id_rol', 'roles_privilegios.id_privilegio', 'privilegios.nombre', 'privilegios.accion', 'privilegios.entidad')
                                                ->orderBy('privilegios.entidad', 'asc')
                                                ->orderBy('roles.id_rol', 'asc')
                                                ->get();

        $privilegios = Privilegio::orderBy('privilegios.entidad', 'asc')
                                    ->orderBy('privilegios.accion', 'asc')
                                    ->get();

        return [
            'pagination' => [
                'total'         => $roles->total(),
                'current_page'  => $roles->currentPage(),
                'per_page'      => $roles->perPage(),
                'last_page'     => $roles->lastPage(),
                'from'          => $roles->firstItem(),
                'to'            => $roles->lastItem(),
            ],
            'roles' => $roles,
            'privilegios' => $privilegios,
            'roles_privilegios' => $roles_privilegios
        ];
    }

     //GUARDAR ROL
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $rol = new Rol();
        $rol->nombre = $request->nombre;
        $rol->save();        
    }

    //ACTUALIZAR ROL
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $rol = Rol::findOrFail($request->id_rol);
        $rol->nombre = $request->nombre;
        $rol->save();
    }

    //**
    public function destroy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $rol = Rol::findOrFail($request->id_rol);
        $rol->delete();  
    }

    

}
