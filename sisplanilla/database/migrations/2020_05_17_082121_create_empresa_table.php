<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id_empresa');
            $table->integer('id_direccion')->unsigned();
            $table->string('actividad', 40);
            $table->string('tipo', 25);
            $table->string('representante_legal', 60);
            $table->string('identificador_nic', 20)->unique();
            $table->string('identificador_nit', 14)->unique();
            $table->string('telefono', 11);
            $table->string('pagina_web', 60);

            $table->foreign('id_direccion')->references('id_direccion')->on('direcciones');


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
        Schema::dropIfExists('empresa');
    }
}
