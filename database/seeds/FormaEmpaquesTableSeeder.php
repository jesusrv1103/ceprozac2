<?php

use Illuminate\Database\Seeder;

class FormaEmpaquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('forma_empaques')->insert([
    		'formaEmpaque' => 'TOTE', 
    		'estado'=>'Activo',
    		]);

    	DB::table('forma_empaques')->insert([
    		'formaEmpaque' => 'CAJA DE PLASTICO', 
    		'estado'=>'Activo',
    		]);


    	DB::table('forma_empaques')->insert([
    		'formaEmpaque' => 'COSTAL DE PLASTICO', 
    		'estado'=>'Activo',
    		]);

    	DB::table('forma_empaques')->insert([
    		'formaEmpaque' => 'COSTAL DE IXTE', 
    		'estado'=>'Activo',
    		]);


    	DB::table('forma_empaques')->insert([
    		'formaEmpaque' => 'GRANEL', 
    		'estado'=>'Activo',
    		]);

    }
}
