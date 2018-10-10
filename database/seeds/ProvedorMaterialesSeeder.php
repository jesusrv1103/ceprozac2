<?php

use Illuminate\Database\Seeder;

class ProvedorMaterialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('provedor_materiales')->insert([
    		'nombre' => 'MARCOS GONZALEZ RODRIGUEZ', 
    		'rfc' =>  'GORM600515H70',
    		'direccion' => 'C. LUIS ECHEVERRIA N°10, COL CENTRO, ZOQUITE, GUADALUPE, ZACATECAS',
    		'telefono' => '(492)943-0260',
    		'email' =>  'marcos-glez1@hotmail.com',
    
    		'estado'=>'Activo',
    		]);


    	DB::table('provedor_materiales')->insert([
    		'nombre' => 'LIZBETH MUÑOZ RAMOS', 
    		'rfc' =>  'BARA720624H9A',
    		'direccion' => 'C.ZACATECAS N°10, EL LAMPOTAL, VETAGRANDE, ZACATECAS',
    		'telefono' => '(492)102-5786',
    		'email' =>  'nocorreo@desconocido.com',
    		
    		'estado'=>'Activo',
    		]);

    	DB::table('provedor_materiales')->insert([
    		'nombre' => 'JUAN MARTIN FAJARDO FLORES', 
    		'rfc' =>  ' FAFJ900530T21',
    		'direccion' => 'C.HIDALGO N° 64, TACOALECHE, GUADALUPE, ZACATECAS',
    		'telefono' => '(492)943-0931',
    		'email' =>  'mfajardof_05@hotmail.com',
    
    		'estado'=>'Activo',
    		]);

    }
}
