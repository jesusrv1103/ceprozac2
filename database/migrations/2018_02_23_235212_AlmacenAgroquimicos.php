<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlmacenAgroquimicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('almacenagroquimicos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nombre');
        $table->string('codigo')->nullable();
        $table->string('imagen')->nullable();
        $table->string('descripcion')->nullable();
        $table->integer('cantidad');
        $table->integer('stock_minimo')->nullable();
        $table->integer('idUnidadMedida')->unsigned();
        $table->foreign('idUnidadMedida')->references('id')->on('unidades_medidas');
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
      Schema::drop('AlmacenAgroquimicos');
    }
  }
