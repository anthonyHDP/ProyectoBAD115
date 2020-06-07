<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesiones', function (Blueprint $table) {
            $table->char('codigo_profesion',6);
            $table->string('titulo',70);
            $table->string('descripcion',150)->nullable();
            $table->timestamps();

            $table->primary('codigo_profesion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesiones');
    }
}
