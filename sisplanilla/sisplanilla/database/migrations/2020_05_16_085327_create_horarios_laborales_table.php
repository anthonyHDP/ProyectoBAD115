<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosLaboralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios_laborales', function (Blueprint $table) {
            $table->increments('id_horario_laboral');
            $table->char('dia',10);
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->char('codigo_contrato',8)->unsigned();
            
            $table->timestamps();

            $table->primary('id_horario_laboral');
            $table->foreign('codigo_contrato')->references('codigo_contrato')->on('contratos');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios_laborales');
    }
}
