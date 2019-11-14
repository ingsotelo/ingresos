<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rfc');
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('clave_subactividad');
            $table->string('constancia');
            $table->string('codigo_postal');
            $table->string('municipio');
            $table->string('ciudad');
            $table->string('colonia');
            $table->string('calle');
            $table->string('numero_ext');
            $table->string('numero_int');
            $table->string('comprobante');
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
        Schema::dropIfExists('perfil');
    }
}
