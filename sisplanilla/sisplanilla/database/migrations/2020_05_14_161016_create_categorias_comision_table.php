<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasComisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_comision', function (Blueprint $table) {
            $table->increments('id_categoria_comision');
            $table->char('codigo_puesto',6);
            $table->integer('ventas_minimas');
            $table->integer('ventas_maximas');
            $table->float('porcentaje',8,2);
            $table->timestamps();

            $table->primary('id_categoria_comision');
            $table->foreign('codigo_puesto')->references('codigo_puesto')->on('puestos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias_comision');
    }
}
