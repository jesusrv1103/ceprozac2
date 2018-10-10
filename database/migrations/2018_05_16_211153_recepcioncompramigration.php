<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Recepcioncompramigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcioncompra', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->date('fecha_compra');
            $table->integer('id_provedor')->unsigned();
            $table->foreign('id_provedor')->references('id')->on('provedores');
            $table->string('transporte');
            $table->integer('num_transportes');
            $table->integer('recibe')->unsigned();
            $table->foreign('recibe')->references('id')->on('empresas_ceprozac');
            $table->integer('entregado')->unsigned();
            $table->foreign('entregado')->references('id')->on('empleados');
            $table->string('observacionesc')->nullable();
            $table->double('total_compra')->nullable();

            $table->integer('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->integer('id_calidad')->unsigned();
            $table->foreign('id_calidad')->references('id')->on('calidad');
            $table->integer('id_empaque')->unsigned();
            $table->foreign('id_empaque')->references('id')->on('forma_empaques');
            $table->string('humedad');
            $table->double('pacas')->nullable();
            $table->double('pacas_rev')->nullable();
            $table->double('granel')->nullable();

            $table->string('observacionesm')->nullable();

            $table->integer('id_bascula')->unsigned();
            $table->foreign('id_bascula')->references('id')->on('basculas');
                        $table->string('ticket');
            $table->integer('peso')->unsigned();
            $table->foreign('peso')->references('id')->on('empleados');
            $table->double('kg_recibidos');
            $table->double('kg_enviados');
            $table->double('diferencia');
            $table->string('observacionesb')->nullable();


            $table->integer('ubicacion_act')->unsigned();
            $table->foreign('ubicacion_act')->references('id')->on('almacengeneral');
            $table->string('espacio_asignado');
            $table->string('observacionesu')->nullable();

            $table->integer('id_fumigacion')->unsigned();
            $table->foreign('id_fumigacion')->references('id')->on('fumigaciones');
            $table->string('codigo');
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
        Schema::drop('recepcioncompra');
    }
}
