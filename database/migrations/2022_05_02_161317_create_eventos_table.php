<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('lugar');
            $table->date('fecha');
            $table->string('Objetivo');
            $table->string('organizacion');
            $table->string('asuntosTratados');
            $table->string('asuntosSecundarios');
            $table->string('observaciones');
            $table->date('fechaProximaReunion');
            $table->string('creadoPor');
            $table->UnsignedBigInteger('id_proyecto');
            $table->foreign('id_proyecto')->references('id')->on('proyectos');
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
        Schema::dropIfExists('eventos');
    }
}
