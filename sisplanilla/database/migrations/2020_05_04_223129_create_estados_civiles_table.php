<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosCivilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_civiles', function (Blueprint $table) {
            $table->increments('id_estado_civil');
            $table->string('titulo',10);
            $table->timestamps();
        });
        DB::table('estados_civiles')->insert(array('id_estado_civil'=>'1', 'titulo'=>'Soltero'));
        DB::table('estados_civiles')->insert(array('id_estado_civil'=>'2', 'titulo'=>'Casado'));
        DB::table('estados_civiles')->insert(array('id_estado_civil'=>'3', 'titulo'=>'Viudo'));
        DB::table('estados_civiles')->insert(array('id_estado_civil'=>'4', 'titulo'=>'Divorciado'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados_civiles');
    }
}
