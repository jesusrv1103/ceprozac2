<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('provedores', function (Blueprint $table) {

        $table->increments('id');
        $table->string('nombre');
        $table->string('apellidos');
        $table->string('direccion');
        $table->string('telefono');
        $table->string('email');
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
        //
    }
}
