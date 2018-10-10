<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasBancoProvedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_banco_provedores', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('idBanco')->unsigned();
            $table->foreign('idBanco')->references('id')->on('bancos');

            $table->string('num_cuenta');
            $table->string('cve_interbancaria');

            $table->integer('idEmpresa')->unsigned();
            $table->foreign('idEmpresa')->references('id')->on('empresas');


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
        Schema::drop('cuentas__banco__provedores');
    }
}
