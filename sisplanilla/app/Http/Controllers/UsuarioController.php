<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Rol;
use App\Empleado;

class UsuarioController extends Controller
{
    //LISTAR USUARIOS
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $usuarios = Usuario::join('roles', 'usuarios.id_rol', '=', 'roles.id_rol')
            ->select('usuarios.id_usuario', 'usuarios.id_rol', 'usuarios.codigo_empleado', 'usuarios.username', 'usuarios.password', 'usuarios.activo', 'usuarios.first_session', 'usuarios.last_session', 'usuarios.intentos_fallidos', 'roles.nombre as nombre_rol')
            ->orderBy('usuarios.id_usuario', 'desc')->paginate(6);
        }
        else{
            $usuarios = Usuario::join('roles', 'usuarios.id_rol', '=', 'roles.id_rol')
            ->select('usuarios.id_usuario', 'usuarios.id_rol', 'usuarios.codigo_empleado', 'usuarios.username', 'usuarios.password', 'usuarios.activo', 'usuarios.first_session', 'usuarios.last_session', 'usuarios.intentos_fallidos', 'roles.nombre as nombre_rol')
            ->where('usuarios.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('usuarios.id_usuario', 'desc')->paginate(6);
        }

        return [
            'pagination' => [
                'total'         => $usuarios->total(),
                'current_page'  => $usuarios->currentPage(),
                'per_page'      => $usuarios->perPage(),
                'last_page'     => $usuarios->lastPage(),
                'from'          => $usuarios->firstItem(),
                'to'            => $usuarios->lastItem(),
            ],
            'usuarios' => $usuarios
        ];
    }

    //LISTAR ROLES
    public function selectRoles(Request $request){
        if (!$request->ajax()) return redirect('/');
        $roles = Rol::select('id_rol','nombre')->orderBy('nombre', 'asc')->get();
        return ['roles' => $roles];
    }
    
    //LISTAR EMPLEADOS
    public function selectEmpleados(Request $request){

        //if (!$request->ajax()) return redirect('/');

        $buscarCodigo = $request->codigo_empleado;

        $usuario = Usuario::where('codigo_empleado', '=', $buscarCodigo)->exists();   
        
        $empleado = Empleado::select('primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
                            ->where('codigo_empleado', '=', $buscarCodigo)
                            ->get();
        
        if(!$usuario){
            return ['empleado' => $empleado];
        }else{
            return ['empleado' => $empleado, 'bandera' => '0'];
        }

        
    
    }

    //GUARDAR USUARIO
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        

        function crearUsername($request){
            $nombres = $request->nombres;
            $apellidos = $request->apellidos;
            $uname = strtolower(substr($nombres, 0, strpos($nombres, ' ')).'.'.substr($apellidos, 0, strpos($apellidos, ' ')));
            if(strlen($uname)>=25){
                $uname = substr($uname, 0, 25);
            }
            return $uname;
        }

        $usuario = new Usuario();
        $usuario->id_rol = $request->id_rol;
        $usuario->codigo_empleado = $request->codigo_empleado;
        $usuario->username = crearUsername($request);
        //$usuario->password = $request->password;
        //$usuario->SHA256($request->password);
        //$usuario->hash('sha256', $request->password);
        $usuario->password = hash('sha256', $request->password);
        $usuario->activo = $request->activo;
        //$usuario->first_session = $request->first_session;
        //$usuario->last_session = $request->last_session;
        //$usuario->intentos_fallidos = $request->intentos_fallidos;
        $usuario->save();        
    }

    //ACTUALIZAR USUARIO
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $usuario = Usuario::findOrFail($request->id_usuario);
        $usuario->id_rol = $request->id_rol;
        //$usuario->password = $request->password;
        $usuario->activo = $request->activo;
        $usuario->save();   
    }

    //ELIMINAR USUARIO
    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $usuario = Usuario::findOrFail($request->id_usuario);
        $usuario->delete();   
    }
}
