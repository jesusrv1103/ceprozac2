<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicioBasculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_basculas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numeroTicket');   
            $table->integer('idEmpleado')->unsigned();
            $table->foreign('idEmpleado')->references('id')->on('empleados');
            $table->integer('idBascula')->unsigned();
            $table->foreign('idBascula')->references('id')->on('basculas');
            $table->integer('idPrecioBascula')->unsigned();
            $table->foreign('idPrecioBascula')->references('id')->on('precio_basculas');
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
        Schema::drop('servicio_basculas');
    }
}
