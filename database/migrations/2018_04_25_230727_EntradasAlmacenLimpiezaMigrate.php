<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntradasAlmacenLimpiezaMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradasalmacenlimpieza', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provedor')->unsigned();
            $table->foreign('provedor')->references('id')->on('provedor_materiales');
            $table->date('fecha');
            $table->string('factura');
            $table->integer('id_material')->unsigned();
            $table->foreign('id_material')->references('id')->on('almacenlimpieza');
            $table->double('cantidad');
            $table->string('medida');
            $table->string('medidaaux');
            $table->double('p_unitario');
            $table->double('importe');
            $table->double('iva');
            $table->double('total');
            $table->integer('comprador')->unsigned();
            $table->foreign('comprador')->references('id')->on('empresas_ceprozac');
            $table->string('moneda');

            $table->integer('entregado')->unsigned();
            $table->foreign('entregado')->references('id')->on('empleados');
            $table->integer('recibe_alm')->unsigned();
            $table->foreign('recibe_alm')->references('id')->on('empleados');
            $table->string('observacionesc')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();

        });
        DB::unprepared('

            CREATE TRIGGER inserta_entrada3 AFTER INSERT ON entradasalmacenlimpieza
            FOR EACH ROW BEGIN
            UPDATE almacenlimpieza SET cantidad=cantidad+NEW.cantidad
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
        Schema::drop('entradasalmacenlimpieza');
    }
}
