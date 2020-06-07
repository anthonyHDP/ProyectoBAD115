<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            //ATRIBUTOS
            $table->increments('id_rol');
            $table->string('nombre', 25)->unique();
            $table->timestamps();
        });
        
        //INSERCION DE DATOS
        DB::table('roles')->insert(array('id_rol'=>'1', 'nombre'=>'Administrador'));
        DB::table('roles')->insert(array('id_rol'=>'2', 'nombre'=>'Jefe de RRHH'));
        DB::table('roles')->insert(array('id_rol'=>'3', 'nombre'=>'Jefe de planilla'));
        DB::table('roles')->insert(array('id_rol'=>'4', 'nombre'=>'Auxiliar de planilla'));
        DB::table('roles')->insert(array('id_rol'=>'5', 'nombre'=>'Jefe de finanzas'));
        DB::table('roles')->insert(array('id_rol'=>'6', 'nombre'=>'Gerente de unidad org.'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
