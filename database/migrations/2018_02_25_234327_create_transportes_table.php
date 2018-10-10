<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_Unidad');
            $table->string('no_Serie');
            $table->string('placas');
            $table->string('poliza_Seguro');
            $table->string('vigencia_Seguro');
            $table->string('aseguradora');
            $table->double('m3_Unidad');
            $table->double('capacidad');
            $table->integer('chofer_id')->unsigned();
            $table->foreign('chofer_id')->references('id')->on('empleados');
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
        Schema::drop('transportes');
    }
}
