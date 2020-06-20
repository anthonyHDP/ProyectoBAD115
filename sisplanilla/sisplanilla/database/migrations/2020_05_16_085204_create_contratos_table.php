<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->char('codigo_contrato',8);
            $table->char('codigo_empleado',6);
            $table->char('codigo_puesto',6);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->integer('duracion')->unsigned();
            $table->string('tipo',20);
            $table->float('salario',8,2);
            $table->boolean('vigencia')->default(1);
            $table->timestamps();

            $table->primary('codigo_contrato');
            $table->foreign('codigo_empleado')->references('codigo_empleado')->on('empleados');
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
        Schema::dropIfExists('contratos');
    }
}
