<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalidasAlmacengeneral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas_almacengeneral', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_almacen')->unsigned();
            $table->foreign('id_almacen')->references('id')->on('almacengeneral');
            $table->string('espacio_asignado');

            $table->integer('destino')->unsigned();
            $table->foreign('destino')->references('id')->on('almacengeneral');
            $table->date('fecha');
            $table->string('kg_salida');
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->integer('id_provedor')->unsigned()->nullable();
            $table->foreign('id_provedor')->references('id')->on('provedores');
            $table->integer('entrego')->unsigned();
            $table->foreign('entrego')->references('id')->on('empleados');
            $table->integer('recibe_alm')->unsigned();
            $table->foreign('recibe_alm')->references('id')->on('empleados');
            $table->string('observacionesc')->nullable();

                                            $table->integer('id_lote')->nullable()->unsigned();
            $table->foreign('id_lote')->references('id')->on('lote');
             $table->string('estado')->nullable();

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
        Schema::drop('salidas_almacengeneral');
    }
}
