<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientoTractoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimiento_tractores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idTractor')->unsigned();
            $table->foreign('idTractor')->references('id')->on('transporte_sencillos');
            $table->string('concepto');
            $table->string('descripcion');
            $table->integer('idChofer')->unsigned();
            $table->foreign('idChofer')->references('id')->on('empleados');
            $table->integer('idMecanico')->unsigned();
            $table->foreign('idMecanico')->references('id')->on('empleados');
            $table->string('fecha');
            $table->string('estado');
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
        Schema::drop('mantenimiento_tractores');
    }
}
