<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empleado_Generos;

class Empleado_GenerosController extends Controller
{
    //CONSULTAR
    public function index()
    {
        if ($buscar==''){
            $empleados_generos = Empleado_Generos::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $empleados_generos = Empleado_Generos::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
    }

    //GUARDAR 
    public function store(Request $request)
    {
        //
    }

    //ELIMINAR 
    public function destroy($id)
    {
        //
    }
    public function selectGenero(Request $request){
        if (!$request->ajax()) return redirect('/');
        $genero = Genero::where('condicion','=','1')
        ->select('id_genero','titulo')->orderBy('titulo', 'asc')->get();
        return ['genero' => $genero];
    }

}
