<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('calidad')->unsigned();
            $table->foreign('calidad')->references('id')->on('calidad');
            $table->string('unidad_de_Medida');
            $table->integer('idFormatoEmpaque')->unsigned();
            $table->foreign('idFormatoEmpaque')->references('id')->on('forma_empaques');
            $table->string('porcentaje_Humedad');
            $table->string('imagen');
            $table->string('clave_del_Producto');
            $table->integer('idProvedor')->unsigned();
            $table->foreign('idProvedor')->references('id')->on('provedores');
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
        Schema::drop('productos');
    }
}
