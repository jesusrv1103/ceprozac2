<?php

use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;


class InvernaderosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invernaderos')->insert([
          'nombre' => 'MALLAS 1',
          'num_modulos' => '5', 
          'estado'=>'Activo',
          ]);

        DB::table('invernaderos')->insert([
          'nombre' => 'MALLAS 2',
          'num_modulos' => '3',  
          'estado'=>'Activo',
          ]);


        DB::table('invernaderos')->insert([
          'nombre' => 'PLASTICO',
          'num_modulos' => '3',  
          'estado'=>'Activo',
          ]);
        //
    }
}
