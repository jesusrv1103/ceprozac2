<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlmacenGeneralMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacengeneral', function (Blueprint $table) {
           $table->increments('id');
         $table->string('nombre');
         $table->integer('capacidad')->nullable();
         $table->string('medida')->nullable();
         $table->string('ubicacion')->nullable();
         $table->string('total_ocupado')->nullable();
         $table->string('total_libre')->nullable();
          $table->string('esp_ocupado')->nullable();
         $table->string('esp_libre')->nullable();
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
        Schema::drop('almacengeneral');
    }
}
