<?php

use Illuminate\Database\Seeder;

class UnidadesMedidaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        DB::table('unidades_medidas')->insert([
            'nombre' => 'COSTAL',
            'cantidad' => '5',
            'idUnidadMedida' => '1', 
            'estado'=>'Activo',
            ]);
        DB::table('unidades_medidas')->insert([
            'nombre' => 'GALON',
            'cantidad' => '3',
            'idUnidadMedida' => '3', 
            'estado'=>'Activo',
            ]);
        DB::table('unidades_medidas')->insert([
            'nombre' => 'MALLA',
            'cantidad' => '5',
            'idUnidadMedida' => '6', 
            'estado'=>'Activo',
            ]);

        //
    }
}
