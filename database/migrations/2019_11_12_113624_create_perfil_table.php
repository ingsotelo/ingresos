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
            $table->string('actividad');
            $table->string('colonia');
            $table->string('calle');
            $table->string('exterior');
            $table->string('interior');
            $table->string('fijo');
            $table->string('movil');
            $table->string('constancia');
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
