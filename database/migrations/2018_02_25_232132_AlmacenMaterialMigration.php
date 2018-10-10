<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlmacenMaterialMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacenmateriales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('provedor')->nullable();
            $table->string('codigo')->nullable();
            $table->string('imagen')->nullable();
            $table->string('descripcion')->nullable();
            $table->double('cantidad');
            $table->string('medida')->nullable();
            $table->string('estado');

            $table->double('stock_minimo')->nullable();
            $table->integer('ubicacion')->unsigned();


            $table->foreign('ubicacion')->references('id')->on('almacengeneral');
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
        Schema::drop('almacenmateriales');
    }
}
