<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->char('codigo_departamento',5);
            $table->string('nombre',14);
            $table->primary('codigo_departamento');
        });
        //Zona Occidental
        DB::table('departamentos')->insert(array('codigo_departamento'=>'2101', 'nombre'=>'Ahuachapan'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'2201', 'nombre'=>'Santa Ana'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'2301', 'nombre'=>'Sonsonate'));
        //Zona Central
        DB::table('departamentos')->insert(array('codigo_departamento'=>'1101', 'nombre'=>'San Salvador'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'1201', 'nombre'=>'Cabañas'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'1301', 'nombre'=>'Chalatenango'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'1401', 'nombre'=>'Cuscatlan'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'1501', 'nombre'=>'La Libertad'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'1601', 'nombre'=>'La Paz'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'1701', 'nombre'=>'San Vicente'));
        //Zona Oriental
        DB::table('departamentos')->insert(array('codigo_departamento'=>'3101', 'nombre'=>'La Union'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'3201', 'nombre'=>'Morazan'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'3301', 'nombre'=>'San Miguel'));
        DB::table('departamentos')->insert(array('codigo_departamento'=>'3401', 'nombre'=>'Usulutan'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}
