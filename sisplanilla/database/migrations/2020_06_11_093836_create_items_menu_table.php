<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_menu', function (Blueprint $table) {
            $table->increments('id_item_menu');
            $table->integer('id_menu')->unsigned();
            $table->integer('id_item_superior')->nullable();
            $table->string('titulo', 50);
            $table->string('url_menu', 50);
            $table->boolean('activo')->default(1);
            $table->timestamps();

            $table->foreign('id_item_superior')->references('id_item_menu')->on('items_menu');
            $table->foreign('id_menu')->references('id_menu')->on('menus');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_menu');
    }
}
