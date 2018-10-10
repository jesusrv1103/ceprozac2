<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbonosAProvedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonos_a_provedores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idSaldoProvedor')->unsigned();
            $table->foreign('idSaldoProvedor')->references('id')->on('saldo_provedores');
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
        Schema::drop('abonos__a__provedors');
    }
}
