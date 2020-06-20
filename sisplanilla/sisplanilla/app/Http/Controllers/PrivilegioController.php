<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Privilegio;

class PrivilegioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Para redigir en caso se acceda directo por URL
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $privilegios = Privilegio::orderBy('id_privilegio', 'desc')->paginate(6);
        }
        else{
            $privilegios = Privilegio::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id_privilegio', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'        => $privilegios->total(),
                'current_page' => $privilegios->currentPage(),
                'per_page'     => $privilegios->perPage(),
                'last_page'    => $privilegios->lastPage(),
                'from'         => $privilegios->firstItem(),
                'to'           => $privilegios->lastItem(),
            ],
            'privilegios' => $privilegios
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $privilegio = new Privilegio();
        $privilegio->nombre = $request->nombre;
        $privilegio->accion = $request->accion;
        $privilegio->entidad = $request->entidad;
        $privilegio->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $privilegio = Privilegio::findOrFail($request->id_privilegio);//Se busca el objeto que se recibe segun este id, para actualizarlo
        $privilegio->nombre = $request->nombre;
        $privilegio->accion = $request->accion;
        $privilegio->entidad = $request->entidad;
        $privilegio->save();
    }

    //Estos métodos se usarían para hacer un borrado lógico en las tablas
    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $privilegio = Privilegio::findOrFail($request->id_privilegio);
        $privilegio->delete();
    }

    /* public function activar(Request $request)
    {
        $privilegio = Privilegio::findOrFail($request->id_privilegio);
        $privilegio->condicion = '1';
        $privilegio->save();
    } */

   
}
