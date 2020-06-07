<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generos', function (Blueprint $table) {
            $table->increments('id_genero');
            $table->string('titulo',20);
            $table->timestamps();
        });

        DB::table('generos')->insert(array('id_genero'=>'1', 'titulo'=>'Hombre'));
        DB::table('generos')->insert(array('id_genero'=>'2', 'titulo'=>'Mujer'));
        DB::table('generos')->insert(array('id_genero'=>'3', 'titulo'=>'Lesbiana'));
        DB::table('generos')->insert(array('id_genero'=>'4', 'titulo'=>'Gay'));
        DB::table('generos')->insert(array('id_genero'=>'5', 'titulo'=>'Bisexual'));
        DB::table('generos')->insert(array('id_genero'=>'6', 'titulo'=>'Transgénero'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generos');
    }
}
