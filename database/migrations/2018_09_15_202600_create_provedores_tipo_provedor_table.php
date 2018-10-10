<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvedoresTipoProvedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provedores_tipo_provedor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idProvedorMaterial')->unsigned();
            $table->foreign('idProvedorMaterial')->references('id')->on('provedor_materiales');
            $table->integer('idTipoProvedor')->unsigned();
            $table->foreign('idTipoProvedor')->references('id')->on('tipo_provedor');
            
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
        Schema::drop('provedores_tipo_provedor');
    }
}
