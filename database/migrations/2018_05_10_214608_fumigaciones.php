<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fumigaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fumigaciones', function (Blueprint $table) {
                       $table->increments('id');
            $table->string('horai')->nullable();
            $table->date('fechai')->nullable();
            $table->date('fechaf')->nullable();
            $table->string('horaf')->nullable();
             $table->string('agroquimicos')->nullable();
             $table->string('destino')->nullable();
                 $table->integer('id_almacen')->nullable()->unsigned();
            $table->foreign('id_almacen')->references('id')->on('almacengeneral');
                  $table->integer('id_producto')->nullable()->unsigned();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->integer('id_fumigador')->nullable()->unsigned();
            $table->foreign('id_fumigador')->references('id')->on('empleados');
                        $table->integer('id_salida')->nullable()->unsigned();
            $table->foreign('id_salida')->references('id')->on('salidasagroquimicos');
            $table->string('cantidad_aplicada')->nullable();
            $table->string('status')->nullable(); 
            $table->string('observaciones')->nullable();
            $table->string('estado')->nullable();
             $table->string('codigo')->nullable();
              $table->string('plaga_combate')->nullable();


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
        Schema::drop('fumigaciones');
    }
}
