<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->char('codigo_empleado',6);
            $table->char('codigo_jefe',6)->unsigned();//nullable();????
            $table->string('primer_nombre',50);
            $table->string('segundo_nombre',50);
            $table->string('primer_apellido',50);
            $table->string('segundo_apellido',50);
            $table->string('email_personal',45)->unique();
            $table->string('email_institucional',45)->unique();
            $table->date('fecha_nacimiento');
            $table->char('identificador_isss',9)->unique();
            $table->char('identificador_nup',12)->unique();
            $table->char('identificador_nit',14)->unique();
            $table->integer('codigo_profesion')->unsigned();
            $table->integer('id_direccion')->unsigned();
            $table->integer('numero_documento_identificacion')->unsigned();
            $table->integer('id_estado_civil')->unsigned();
            $table->integer('id_genero')->unsigned();
            $table->integer('id_contacto_telefonico')->unsigned();
            $table->timestamps();
            
            $table->primary('codigo_empleado');
            $table->foreign('codigo_jefe')->references('codigo_empleado')->on('empleados');
            $table->foreign('codigo_profesion')->references('codigo_profesion')->on('profesiones');
            $table->foreign('id_direccion')->references('id_direccion')->on('direcciones');
            $table->foreign('numero_documento_identificacion')->references('numero_documento_identificacion')->on('documentos_identificacion');
            $table->foreign('id_estado_civil')->references('id_estado_civil')->on('estados_civiles');
            $table->foreign('id_genero')->references('id_genero')->on('generos');
            $table->foreign('id_contacto_telefonico')->references('id_contacto_telefonico')->on('contactos_telefonicos');
        });
        
        DB::table('empleados')->insert(array('codigo_empleado'=>'EMP001', 'codigo_jefe'=>'EMP001', 'primer_nombre'=>'Edwin', 'segundo_nombre'=>'Jose', 'primer_apellido'=>'Molina', 'segundo_apellido'=>'Aleman',
        'email_personal'=>'email', 'email_institucional'=>'email','fecha_nacimiento'=>'15/06/20', 'identificador_isss'=>'987979', 'identificador_nup'=>'8788887', 'identificador_nit'=>'899797', 'codigo_profesion'=>'1', 'id_direccion'=>'1',
        'numero_documento_identificacion'=>'9898789', 'id_estado_civil'=>'1', 'id_genero'=>'1', 'id_contacto_telefonico'=>'1'));
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}