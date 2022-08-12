<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompromisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compromisos', function (Blueprint $table) {
            $table->id();
            $table->integer('prioridad');
            $table->string('tarea');
            $table->string('responsable');
            $table->date('fechaEntrega');
            $table->UnsignedBigInteger('id_evento');
            $table->foreign('id_evento')->references('id')->on('eventos');
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
        Schema::dropIfExists('compromisos');
    }
}
