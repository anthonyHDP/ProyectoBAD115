<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Empleado;
use App\Contactos_Telefonicos;
use App\Tipos_Contacto_Telefonico;
use App\Direccion;
use App\Estados_Civiles;
use App\Generos;
use App\Profesiones;
use App\Municipio;
use App\Departamento;
use App\Documentos_Identificacion;
use App\Tipos_Identificacion;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $empleados = Empleado::join('generos','empleados.id_genero','=','generos.id_genero')
            ->select('empleados.codigo_empleado','empleados.id_genero','empleados.titulo','empleados.primer_nombre','empleados.segundo_nombre','empleados.primer_apellido','empleados.segundo_apellido','empleados.codigo_jefe','empleados.email_personal','empleados.email_institucional')
            ->orderBy('empleados.codigo_empleado', 'desc')->paginate(3);
        }


        else{
            $empleados = Empleado::join('generos','empleados.id_genero','=','generos.id_genero')
            ->select('empleados.codigo_empleado','empleados.id_genero','empleados.titulo','empleados.primer_nombre','empleados.segundo_nombre','empleados.primer_apellido','empleados.segundo_apellido','empleados.codigo_jefe','empleados.email_personal','empleados.email_institucional')
            ->where('empleados.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('empleados.codigo_empleado', 'desc')->paginate(3);
        }
       
        
        /*

        if ($buscar==''){
            $empleado = Empleado::orderBy('codigo_empleado', 'desc')->paginate(3);
        }
        else{
            $empleado = Empleado::where($criterio, 'like', '%'. $buscar . '%')->orderBy('codigo_empleado', 'desc')->paginate(3);
        }
        
*/
        return [
            'pagination' => [
                'total'        => $empleado->total(),
                'current_page' => $empleado->currentPage(),
                'per_page'     => $empleado->perPage(),
                'last_page'    => $empleado->lastPage(),
                'from'         => $empleado->firstItem(),
                'to'           => $empleado->lastItem(),
            ],
            'Empleados' => $empleados
        ];
    }

    

    //Metodo para Guardar Objeto Direccion
    public function storew(Request $request){



        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //GUARDAR O REGISTRAR EMPLEADO
    public function store(Request $request)
    {
        try{
                $direccion=new Direccion();
                $direccion->ubicacion=$request->ubicacion;
                $direccion->numero_vivienda=$request->numero_vivienda;
                $direccion->codigo_municipio=$request->codigo_municipio;
                $direccion->save(); 

                $contactos_telefonicos=new Contactos_Telefonicos();
                $contactos_telefonicos->numero=$request->numero;
                $contactos_telefonicos->id_tipo_contacto_telefonico=$request->id_tipo_contacto_telefonico;
                $contactos_telefonicos->save();

                $documentos_identificacion=new Documentos_Identificacion();
                $documentos_identificacion->id_tipo_identificacion=$request->id_tipo_identificacion;
                $documentos_identificacion->detalles=$request->detalles;
                $documentos_identificacion->save();

                $empleado=new Empleado();
                $empleado->codigo_empleado='GG2020';
                $empleado->codigo_jefe=$request->codigo_jefe;
                $empleado->primer_nombre =$request->primer_nombre;
                $empleado->segundo_nombre=$request->segundo_nombre;
                $empleado->primer_apellido=$request->primer_apellido;
                $empleado->segundo_apellido=$request->segundo_apellido;
                $empleado->email_personal=$request->email_personal;
                $empleado->email_institucional=$request->email_institucional;
                $empleado->fecha_nacimiento=$request->fecha_nacimiento;
                $empleado->identificador_isss=$request->identificador_isss;
                $empleado->identificador_nup=$request->identificador_nup;
                $empleado->identificador_nit=$request->identificador_nit;
                $empleado->codigo_profesion=$request->codigo_profesion;
                $empleado->id_direccion=2;
                $empleado->numero_documento_identificacion=1;
                $empleado->id_estado_civil=$request->id_estado_civil;
                $empleado->id_genero=$request->id_genero;
                $empleado->id_contacto_telefonico=2;
                /*
                $empleado->condicion='1';
                */
                $empleado->save();

         }
         catch(\Exception $e){
            error_log($e->getMessage());
         }
        
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //ACTUALIZAR EMPLEADO
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empleados = Empleado::findOrFail($request->id);
        $empleado=new Empleado();
        $empleado->primer_nombre =$request->primer_nombre;
        $empleado->segundo_nombre=$request->segundo_nombre;
        $empleado->primer_apellido=$request->primer_apellido;
        $empleado->segundo_apellido=$request->segundo_apellido;
        $empleado->email_personal=$request->email_personal;
        $empleado->email_institucional=$request->email_institucional;
        $empleado->fecha_nacimiento=$request->fecha_nacimiento;
        $empleado->identificador_isss=$request->identificador_isss;
        $empleado->identificador_nup=$request->identificador_nup;
        $empleado->identificador_nit=$request->identificador_nit;
        $empleado->codigo_profesion=$request->codigo_profesion;
        $empleado->id_direccion=$request->id_direccion;
        $empleado->numero_documento_identificacion=$request->numero_documento_identificacion;
        $empleado->id_estado_civil=$request->id_estado_civil;
        $empleado->id_genero=$request->id_genero;
        $empleado->id_contacto_telefonico=$request->id_contacto_telefonico;
        /*
        $empleado->condicion='1';
        */
        $empleado->save();
    }
    /*
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->condicion = '0';
        $empleado->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $empleado = Empleado::findOrFail($request->id);
        $empleado->condicion = '1';
        $empleado->save();
    }
    */
    //LISTAR EMPLEADOS
    /*
    public function selectEmpleado(Request $request){
        if (!$request->ajax()) return redirect('/');
        $empleados_jefe = Empleado::select('codigo_empleado')->orderBy('codigo_empleado', 'asc')->get();
        return ['empleados_jefe' => $empleados_jefe];
    }
    */
    public function selectEmpleados(Request $request){

        //if (!$request->ajax()) return redirect('/');

        $buscarCodigo = $request->codigo_empleado;
        
        $empleado = Empleado::select('primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                            ->where('codigo_empleado', '=', $buscarCodigo)
                            ->get();
        
        if(!$usuario){
            return ['empleado' => $empleado];
        }else{
            return ['empleado' => $empleado, 'bandera' => '0'];
        }

        
    
    }
    //LISTAR CODIGO DE PROFESIONES
    public function selectProfesion(Request $request){
        if (!$request->ajax()) return redirect('/');
        $profesiones = Profesiones::select('codigo_profesion','titulo')->orderBy('titulo', 'asc')->get();
        return ['profesiones' => $profesiones];
    }
    //LISTAR MUNICIPIOS
    public function selectDireccionMunicipio(Request $request){
        if (!$request->ajax()) return redirect('/');
        $direccion_municipios = Municipio::select('codigo_municipio','nombre')->orderBy('nombre', 'asc')->get();
        return ['direccion_municipios' => $direccion_municipios];
    }
     //LISTAR DEPARTAMENTOS
     public function selectDireccionDepartamento(Request $request){
        if (!$request->ajax()) return redirect('/');
        $direccion_departamentos = Departamento::select('codigo_departamento','nombre')->orderBy('nombre', 'asc')->get();
        return ['direccion_departamentos' => $direccion_departamentos];
    }
     //LISTAR ESTADOS CIVILES
    public function selectEstadoCivil(Request $request){
        if (!$request->ajax()) return redirect('/');
        $Estados_Civiles = Estados_Civiles::select('id_estado_civil','titulo')->orderBy('titulo', 'asc')->get();
        return ['Estados_Civiles' => $Estados_Civiles];
        
    }
    //LISTAR GENEROS
    public function selectGenero(Request $request){
        if (!$request->ajax()) return redirect('/');
        $generos = Generos::select('id_genero','titulo')->orderBy('titulo', 'asc')->get();
        return ['generos' => $generos];
    }
    //LISTAR ID DE CONTACTO TELEFONICO
    public function selectContacto(Request $request){
        if (!$request->ajax()) return redirect('/');
        $contactos = Tipos_Contacto_Telefonico::select('id_tipo_contacto_telefonico','titulo')->orderBy('titulo', 'asc')->get();
        return ['contactos' => $contactos];
    }
    //LISTAR TIPO DE IDENTIFICACION
    public function selectIdentificacion(Request $request){
        if (!$request->ajax()) return redirect('/');
        $identificaciones = Tipos_Identificacion::select('id_tipo_identificacion','titulo')->orderBy('titulo', 'asc')->get();
        return ['identificaciones' => $identificaciones];
    }
    
}