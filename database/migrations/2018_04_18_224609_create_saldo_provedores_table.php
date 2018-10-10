<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaldoProvedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldo_provedores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idProvedor')->unsigned();
            $table->foreign('idProvedor')->references('id')->on('provedores');
            $table->double('saldo');  
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
        Schema::drop('saldo_provedors');
    }
}
