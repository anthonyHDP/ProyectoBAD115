<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->bigIncrements('id_direccion');
            $table->integer('codigo_municipio',4)->unsigned();
            $table->string('ubicacion',100);
            $table->char('numero_vivienda',4);
            $table->timestamps();

            $table->foreign('codigo_municipio')->references('codigo_municipio')->on('municipios');
        });
        DB::table('direcciones')->insert(array('id_direccion'=>'1', 'codigo_municipio'=>'0201', 'ubicacion'=>'Buena vista', 'numero_vivienda'=>'100'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direcciones');
    }
}
