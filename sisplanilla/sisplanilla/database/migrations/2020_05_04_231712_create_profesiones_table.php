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
            $table->increments('codigo_profesion');
            $table->string('titulo',70);
            $table->string('descripcion',150)->nullable();
            $table->timestamps();

            $table->primary('codigo_profesion');
        });
        DB::table('profesiones')->insert(array('codigo_profesion'=>'1', 'titulo'=>'Ingeniero Industrial','descripcion'=>'Administrador'));
        DB::table('profesiones')->insert(array('codigo_profesion'=>'2', 'titulo'=>'Licenciado en Contaduria Publica','descripcion'=>'Contador General'));
        DB::table('profesiones')->insert(array('codigo_profesion'=>'3', 'titulo'=>'Licenciado en Finanzas','descripcion'=>'Jefe de Finanzas'));
        DB::table('profesiones')->insert(array('codigo_profesion'=>'4', 'titulo'=>'Ingeniero Industrial','descripcion'=>'Administrador de RRHH'));

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
