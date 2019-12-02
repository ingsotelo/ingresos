<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObligacionesRegistradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obligaciones_registradas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rfc');
            $table->string('claveObligacion');
            $table->smallInteger('estado');
            $table->timestamp('fechaAlta');
            //$table->timestamp('fechaCausacion');
            //$table->timestamp('fechaBaja');
            //$table->timestamp('fechaReactivacion');
            //$table->timestamp('fechaIMSS');
            $table->string('registroIMSS');
            $table->string('doctoIMSS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obligaciones_registradas');
    }
}

