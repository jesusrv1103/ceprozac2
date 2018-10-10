<?php

use Illuminate\Database\Seeder;

class NombreUnidadMedidaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('nombre_unidades_medidas')->insert([
    		'nombreUnidadMedida' => 'KILOGRAMOS',
    		]);


    	DB::table('nombre_unidades_medidas')->insert([
    		'nombreUnidadMedida' => 'GRAMOS',
    		]);



    	DB::table('nombre_unidades_medidas')->insert([
    		'nombreUnidadMedida' => 'LITROS',
    		]);


        DB::table('nombre_unidades_medidas')->insert([
            'nombreUnidadMedida' => 'MILILITROS',
            ]);


        DB::table('nombre_unidades_medidas')->insert([
          'nombreUnidadMedida' => 'UNIDADES',
          ]);

        DB::table('nombre_unidades_medidas')->insert([
          'nombreUnidadMedida' => 'METROS',
          ]);

        DB::table('nombre_unidades_medidas')->insert([
          'nombreUnidadMedida' => 'CENTIMETROS',
          ]);

        DB::table('nombre_unidades_medidas')->insert([
          'nombreUnidadMedida' => 'MILIMETROS',
          ]);

    }
}
