<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invernaderos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invernaderos', function (Blueprint $table) {
            $table->increments('id');
             $table->string('nombre'); 
         $table->string('ubicacion')->nullable();
         $table->string('num_modulos')->nullable();
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
        Schema::drop('invernaderos');
    }
}
