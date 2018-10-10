<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasEmpresasCEPROZACTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_empresas_ceprozac', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idBanco')->unsigned();
            $table->foreign('idBanco')->references('id')->on('bancos');
            $table->string('num_cuenta');
            $table->string('cve_interbancaria');
            $table->integer('idEmpresa')->unsigned();
            $table->foreign('idEmpresa')->references('id')->on('empresas_ceprozac');
            
            $table->double('saldo');
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
        Schema::drop('cuentas_empresas_ceprozac');
    }
}
