<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacoraMantenimientoComedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora_mantenimiento_comedor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('limpieza_mesas');
            $table->string('lookers');
            $table->string('realizado');
            $table->string('observaciones');
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
        Schema::drop('bitacora_mantenimiento_comedors');
    }
}
