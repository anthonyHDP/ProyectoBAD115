<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos', function (Blueprint $table) {
            $table->char('codigo_puesto',6);
            $table->string('nombre',25);
            $table->string('descripcion',150)->nullable();
            $table->integer('id_categoria_salarial');
            $table->char('codigo_unidad_organizativa',4);
            $table->timestamps();

            $table->primary('codigo_puesto');
            $table->foreign('id_categoria_salarial')->references('id_categoria_salarial')->on('categorias_salariales');
            //$table->foreign('codigo_unidad_organizativa')->references('codigo_unidad_organizativa')->on('unidades_organizacionales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puestos');
    }
}
