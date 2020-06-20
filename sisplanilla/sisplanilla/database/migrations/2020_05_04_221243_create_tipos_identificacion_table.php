<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposIdentificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_identificacion', function (Blueprint $table) {
            $table->increments('id_tipo_identificacion');
            $table->string('titulo',13)->unique();
            $table->timestamps();
        });
        DB::table('tipos_identificacion')->insert(array('id_tipo_identificacion'=>'1', 'titulo'=>'DUI'));
        DB::table('tipos_identificacion')->insert(array('id_tipo_identificacion'=>'2', 'titulo'=>'Pasaporte'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_identificacion');
    }
}
