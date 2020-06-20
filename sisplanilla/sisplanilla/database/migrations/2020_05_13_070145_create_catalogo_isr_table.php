<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogoIsrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo_isr', function (Blueprint $table) {
            $table->increments('id_catalogo_isr');
            $table->float('limite_inferior',8,2);
            $table->float('limite_superior',8,2);
            $table->float('porcentaje',8,2);
            $table->float('cuota_fija',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogo_isr');
    }
}
