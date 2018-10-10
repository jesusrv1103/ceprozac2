<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lote', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('id_producto')->unsigned()->nullable();
         $table->foreign('id_producto')->references('id')->on('productos');
          $table->integer('id_calidad')->unsigned()->nullable();
         $table->foreign('id_calidad')->references('id')->on('calidad');
        $table->integer('id_provedor')->unsigned()->nullable();
        $table->foreign('id_provedor')->references('id')->on('provedores');
        $table->string('nombre_lote')->nullable();
        $table->double('cantidad_act')->nullable();
                $table->string('medida');
        $table->date('fecha_entrada')->nullable();
        $table->integer('id_almacen')->unsigned();
        $table->foreign('id_almacen')->references('id')->on('almacengeneral');
        $table->string('num_espacio');
         $table->integer('num_fumigaciones');
        $table->date('ultima_fumigacion')->nullable();
        $table->integer('id_fumigacion')->nullable()->unsigned();
        $table->foreign('id_fumigacion')->references('id')->on('fumigaciones');
        $table->string('observaciones')->nullable();
        $table->integer('id_empaque')->unsigned();
        $table->foreign('id_empaque')->references('id')->on('forma_empaques');
        $table->string('humedad')->nullable();
          $table->string('codigo')->nullable();
        $table->string('estado')->nullable();
          $table->timestamps();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lote', function (Blueprint $table) {
            //
        });
    }
}
