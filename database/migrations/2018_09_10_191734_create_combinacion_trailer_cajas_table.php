<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombinacionTrailerCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combinacion_trailer_cajas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_Transportes')->unsigned();
            $table->foreign('id_Transportes')->references('id')->on('transportes');
            $table->integer('id_Caja')->unsigned();
            $table->foreign('id_Caja')->references('id')->on('transporte_sencillos');
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
        Schema::drop('combinacion_trailer_cajas');
    }
}
