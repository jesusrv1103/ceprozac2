<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NumeroContratoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       //
        DB::unprepared('
            CREATE TRIGGER tr_updStrockCompras AFTER INSERT ON contratos
            FOR EACH ROW BEGIN
            UPDATE empleados SET numero_Contrato =new.id
            WHERE empleados.id=new.idEmpleado;
            END');


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
