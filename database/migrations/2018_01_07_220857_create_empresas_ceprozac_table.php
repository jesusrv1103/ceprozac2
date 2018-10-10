<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasCeprozacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_ceprozac', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('representanteLegal');
            $table->string('telefono');
            $table->string('rfc');
            $table->string('direcionFisica');
            $table->string('direcionFacturacion');
            $table->string('email');
            $table->integer('idRegimenFiscal')->unsigned();
            $table->foreign('idRegimenFiscal')->references('id')->on('regimen_fiscal');
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
        Schema::drop('empresas_ceprozac');
    }
}
