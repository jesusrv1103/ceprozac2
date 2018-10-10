<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesMedidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades_medidas', function (Blueprint $table) {
         $table->increments('id');
         $table->string('nombre'); 
         $table->double('cantidad')->nullable();
         $table->integer('idUnidadMedida')->unsigned();
         $table->foreign('idUnidadMedida')->references('id')->on('nombre_unidades_medidas');
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
        Schema::drop('unidades_medidas');
    }
}
