<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosIdentificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_identificacion', function (Blueprint $table) {
            $table->increments('numero_documento_identificacion');
            $table->integer('id_tipo_identificacion')->unsigned();
            $table->string('detalles',100)->nullable();
            $table->timestamps();

            $table->primary('numero_documento_identificacion');
            $table->foreign('id_tipo_identificacion')->references('id_tipo_identificacion')->on('tipos_identificacion');
        });
        DB::table('documentos_identificacion')->insert(array('id_tipo_identificacion'=>'1', 'numero_documento_identificacion'=>'9898789', 'detalles'=>'Es el dui'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_identificacion');
    }
}
