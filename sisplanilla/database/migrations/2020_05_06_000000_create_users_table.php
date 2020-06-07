<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            //ATRIBUTOS
            $table->increments('id_usuario');
            $table->integer('id_rol')->unsigned();
            $table->char('codigo_empleado', 6);
            $table->string('username', 25)->unique();
            $table->string('password', 64);
            $table->boolean('activo')->default(1);
            $table->datetime('first_session')->nullable();
            $table->datetime('last_session')->nullable();
            $table->integer('intentos_fallidos')->nullable() ;

            //LLAVES
            $table->primary('id_usuario');
            $table->foreign('id_rol')->references('id_rol')->on('roles');
            $table->foreign('codigo_empleado')->references('codigo_empleado')->on('empleados')->onDelete('cascade');
            $table->rememberToken();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
