<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles_Privilegios;

class Roles_PrivilegiosController extends Controller
{
    
    //CONSULTAR VINCULACION
    public function index()
    {
        
    }

    //GUARDAR VINCULACION
    public function store(Request $request)
    {
        //Recuperacion y conversion de json a array php
        $arrayOriginal = json_decode($request->lista_original, true);
        $arrayDiferencia = json_decode($request->lista_diferencia, true);

        //Longitud de arrays
        $num_or = sizeof($arrayOriginal);
        $num_di = sizeof($arrayDiferencia);

        //Banderas de eliminacion y agregacion
        $del_ban = 0;
        $add_ban = 0;

        //Vinculacion de privilegios segun situacion de arrays
        if($num_or == 0 && $num_di != 0){
            //CUANDO EL ROL NO TIENE NINGUN PRIVILEGIO ASIGNADO
            //Insertar diferencia
            for($i = 0; $i<$num_di; $i++){
                $r_p = new Roles_Privilegios();
                $r_p->id_rol = (int) $arrayDiferencia[$i]["id_rol"];
                $r_p->id_privilegio = (int) $arrayDiferencia[$i]["id_privilegio"];
                try{
                    $r_p->save();
                 }
                 catch(\Exception $e){
                    error_log($e->getMessage());
                 }
            }
        }elseif($num_or != 0 && $num_di != 0){
            //CUANDO EL ROL YA TIENE PRIVILEGIOS, PERO TIENE NUEVAS ASIGNACIONES (ALGUNAS REPETIDAS)
            //SEPARAR LISTA DE AGREGACION Y ELIMINACION
            for($i = 0; $i<$num_or; $i++){
                $del_ban = 0;
                for($j = 0; $j<$num_di; $j++){
                    if($arrayOriginal[$i]["id_rol"] == $arrayDiferencia[$j]["id_rol"] && $arrayOriginal[$i]["id_privilegio"] == $arrayDiferencia[$j]["id_privilegio"]){
                        $del_ban = 1;
                    }
                }
                if($del_ban != 1){
                    //Eliminar
                    $r_p = Roles_Privilegios::where([
                                                    ['id_rol', '=', $arrayOriginal[$i]["id_rol"]],
                                                    ['id_privilegio', '=', $arrayOriginal[$i]["id_privilegio"]],
                                                    ])->delete();
                }
            }
            for($i = 0; $i<$num_di; $i++){
                $add_ban = 0;
                for($j = 0; $j<$num_or; $j++){
                    if($arrayOriginal[$j]["id_rol"] == $arrayDiferencia[$i]["id_rol"] && $arrayOriginal[$j]["id_privilegio"] == $arrayDiferencia[$i]["id_privilegio"]){
                        $add_ban = 1;
                    }
                }
                if($add_ban != 1){
                    //Agregar
                    $r_p = new Roles_Privilegios();
                    $r_p->id_rol = (int) $arrayDiferencia[$i]["id_rol"];
                    $r_p->id_privilegio = (int) $arrayDiferencia[$i]["id_privilegio"];
                    $r_p->save();
                }
            }

        }elseif($num_or != 0 && $num_di == 0){
            //CUANDO EL ROL TENIA PRIVILEGIOS, PERO YA NO SE ASIGNA NINGUNO Y SE QUITAN LOS QUE TENIA
            //ELIMINAR CON EL ORIGINAL
            for($i = 0; $i<$num_or; $i++){
                
                try{
                    $r_p = Roles_Privilegios::where('id_rol', '=', $arrayOriginal[$i]["id_rol"], 'and', 'id_privilegio', '=', $arrayOriginal[$i]["id_privilegio"])->delete();
                }catch(\Exception $e){
                    error_log($e->getMessage());
                }
                
            }
        }
    }


    //ELIMINAR VINCULACION
    public function destroy($id)
    {
        //
    }
}
