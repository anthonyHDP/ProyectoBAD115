<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Direccion;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            //$empresa = Empresa::orderBy('id_empresa', 'desc')->paginate(10);

            $empresa = Empresa::join('direcciones','empresa.id_direccion','=','direcciones.id_direccion')
            ->select('empresa.id_empresa','empresa.id_direccion','empresa.actividad','empresa.tipo','empresa.representante_legal','empresa.identificador_nic','empresa.identificador_nit','empresa.telefono','empresa.pagina_web',DB::raw("CONCAT(direcciones.ubicacion,', ',direcciones.numero_vivienda)as direccioncom"))
            ->orderBy('empresa.id_empresa', 'desc')->paginate(3);
        
        }
        else{
            //$empresa = Empresa::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);

            $empresa = Empresa::join('direcciones','empresa.id_direccion','=','direcciones.id_direccion')
            ->select('empresa.id_empresa','empresa.id_direccion','empresa.actividad','empresa.tipo','direcciones.ubicacion','empresa.representante_legal','empresa.identificador_nic','empresa.identificador_nit','empresa.telefono','empresa.pagina_web')
            ->where('empresa.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('empresa.id_empresa', 'desc')->paginate(3);
            


        }
        

        return [
            'pagination' => [
                'total'        => $empresa->total(),
                'current_page' => $empresa->currentPage(),
                'per_page'     => $empresa->perPage(),
                'last_page'    => $empresa->lastPage(),
                'from'         => $empresa->firstItem(),
                'to'           => $empresa->lastItem(),
            ],
            'empresa' => $empresa
        ];
    }

    //en direcciones
    public function selectDireccion(Request $request){
        if (!$request->ajax()) return redirect('/');
        //$direcciones = Direccion::where('activo','=','1')
        $direcciones = Direccion::select('id_direccion','ubicacion')->orderBy('ubicacion', 'asc')->get();
        
        return ['direcciones' => $direcciones];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empresa = new Empresa();
        $empresa->id_direccion = $request->id_direccion;
        $empresa->actividad = $request->actividad;
        $empresa->tipo = $request->tipo;
        $empresa->representante_legal = $request->representante_legal;
        $empresa->identificador_nic = $request->identificador_nic;
        $empresa->identificador_nit = $request->identificador_nit;
        $empresa->telefono = $request->telefono;
        $empresa->pagina_web = $request->pagina_web;
        $empresa->save();
    }


    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empresa = Empresa::findOrFail($request->id_empresa);
        $empresa->id_direccion = $request->id_direccion;
        $empresa->actividad = $request->actividad;
        $empresa->tipo = $request->tipo;
        $empresa->representante_legal = $request->representante_legal;
        $empresa->identificador_nic = $request->identificador_nic;
        $empresa->identificador_nit = $request->identificador_nit;
        $empresa->telefono = $request->telefono;
        $empresa->pagina_web = $request->pagina_web;
        $empresa->save();
    }

    /*
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empresa = Empresa::findOrFail($request->id_empresa);
        $empresa->activo = '0';
        $empresa->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empresa = Empresa::findOrFail($request->id);
        $empresa->activo = '1';
        $empresa->save();
    }
    */

}
