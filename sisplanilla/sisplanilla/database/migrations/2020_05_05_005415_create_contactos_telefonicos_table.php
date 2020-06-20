<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTelefonicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos_telefonicos', function (Blueprint $table) {
            $table->increments('id_contacto_telefonico');
            $table->integer('id_tipo_contacto_telefonico')->unsigned();
            $table->char('numero',8);
            $table->timestamps();

            $table->foreign('id_tipo_contacto_telefonico')->references('id_tipo_contacto_telefonico')->on('tipos_contacto_telefonico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactos_telefonicos');
    }
}
