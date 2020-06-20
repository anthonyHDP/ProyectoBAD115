<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesPrivilegiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_privilegios', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_rol');
            $table->integer('id_privilegio');

            $table->foreign('id_rol')->references('id_rol')->on('roles');
            $table->foreign('id_privilegio')->references('id_privilegio')->on('privilegios');

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
        Schema::dropIfExists('roles_privilegios');
    }
}
