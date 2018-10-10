<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesEntradasAgroquimicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_entradas_agroquimicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idEntradaAgroquimicos')->unsigned();
            $table->foreign('idEntradaAgroquimicos')->references('id')->on('entradasagroquimicos');
            $table->integer('id_material')->unsigned();
            $table->foreign('id_material')->references('id')->on('almacenagroquimicos');
            $table->integer('cantidad');
            $table->double('p_unitario');
            $table->double('iva');
            $table->double('ieps');
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
        Schema::drop('detalles_entradas_agroquimicos');
    }
}
