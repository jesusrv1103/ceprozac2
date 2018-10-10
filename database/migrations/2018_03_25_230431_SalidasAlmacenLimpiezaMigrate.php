<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalidasAlmacenLimpiezaMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidasalmacenlimpieza', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_material')->unsigned();
            $table->foreign('id_material')->references('id')->on('almacenlimpieza');
            $table->double('cantidad');
            $table->string('medida');
            $table->string('medidaaux');
            $table->string('destino');
            $table->integer('entrego')->unsigned();
            $table->foreign('entrego')->references('id')->on('empleados');
            $table->integer('recibio')->unsigned();
            $table->foreign('recibio')->references('id')->on('empleados');
            $table->string('tipo_movimiento');
            $table->date('fecha');
            $table->string('estado')->nullable();
            $table->timestamps();    
        });
        DB::unprepared('

            CREATE TRIGGER tr_updStrockVenta3 AFTER INSERT ON salidasalmacenlimpieza
            FOR EACH ROW BEGIN
            UPDATE almacenlimpieza SET cantidad=cantidad-NEW.cantidad
            WHERE almacenlimpieza.id=NEW.id_material;

            END

            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salidasalmacenlimpieza');
    }
}
