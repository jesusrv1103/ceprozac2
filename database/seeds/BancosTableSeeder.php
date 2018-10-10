<?php

use Illuminate\Database\Seeder;

class BancosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('bancos')->insert([
    		'nombre' => 'BBVA BANCOMER S.A', 
    		'estado'=>'Activo',
    		]);

    	DB::table('bancos')->insert([
    		'nombre' => 'BANCO MERCANTIL DEL NORTE', 
    		'estado'=>'Activo',
    		]);

    	DB::table('bancos')->insert([
    		'nombre' => 'BANREGIO', 
    		'estado'=>'Activo',
    		]);

    	DB::table('bancos')->insert([
    		'nombre' => 'BMONEX', 
    		'estado'=>'Activo',
    		]);
    }
}
