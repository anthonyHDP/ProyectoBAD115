<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViaticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viaticos', function (Blueprint $table) {
            $table->increments('id_viaticos');
            $table->char('codigo_puesto',6)->unsigned();
            $table->string('nombre',20);
            $table->float('monto',8,2);
            $table->timestamps();

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
        Schema::dropIfExists('viaticos');
    }
}
