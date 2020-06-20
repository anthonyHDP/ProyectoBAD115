<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id_menu');
            $table->integer('id_rol')->unsigned();
            $table->string('titulo', 50);
            $table->string('vista', 50)->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamps();

            $table->foreign('id_rol')->references('id_rol')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
