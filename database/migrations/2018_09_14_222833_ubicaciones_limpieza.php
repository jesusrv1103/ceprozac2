<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UbicacionesLimpieza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicaciones_limpieza', function (Blueprint $table) {
         $table->increments('id');
         $table->string('nombre'); 
         $table->string('ubicacion')->nullable();
         $table->string('descripcion')->nullable();
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
        Schema::drop('ubicaciones_limpieza');
    }
}
