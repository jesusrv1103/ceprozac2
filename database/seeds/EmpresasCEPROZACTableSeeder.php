<?php

use Illuminate\Database\Seeder;

class EmpresasCEPROZACTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('empresas_ceprozac')->insert([
    		'nombre' => 'CENTRO DE PRODUCTORES DE ZACATECAS SPR DE RL', 
    		'representanteLegal' => 'MANUEL MUÑOZ ESCOBEDO ', 
    		'telefono' => '(492) 936-8597', 
    		'rfc' => 'CPZ010907KR8', 
    		'direcionFisica' => 'CARR. SANTA MONICA POZO DE GAMBOA KM 18',
    		'direcionFacturacion' => 'EL LAMPOTAL VETAGRANDE ZACATECAS  C.P. 98150', 
    		'email' => 'ceprozac@gmail.com', 
    		'idRegimenFiscal' => '14', 
    		'estado'=>'Activo',
    		]);


    	DB::table('empresas_ceprozac')->insert([
    		'nombre' => 'PRODUCTORES UNIDOS DE ZACATECAS SPR DE RL', 
    		'representanteLegal' => 'JUAN MANUEL MUÑOZ ESCOBEDO ', 
    		'telefono' => '(492) 936-8597', 
    		'rfc' => 'PUZ030318D99', 
    		'direcionFisica' => 'JUAN ALDAMA NO 25B',
    		'direcionFacturacion' => 'EL LAMPOTAL VETAGRANDE ZACATECAS  C.P. 98150', 
    		'email' => 'produzac@gmail.com', 
    		'idRegimenFiscal' => '14', 
    		'estado'=>'Activo',
    		]);



    	DB::table('empresas_ceprozac')->insert([
    		'nombre' => 'INDUSTRIALIZACION Y COMERCIALIACION AGRICOLA DE ZAC S. DE R.L. DE C.V.', 
    		'representanteLegal' => 'MANUEL MUÑOZ ESCOBEDO ', 
    		'telefono' => '(492) 541-2470', 
    		'rfc' => 'ICA160420DJ3', 
    		'direcionFisica' => 'PRIVADA OPALO NO. 78',
    		'direcionFacturacion' => 'FRAC. MINA AZUL 2DA SECCION, GUADALUPE ZACATECAS C.P. 98068', 
    		'email' => 'icazac16@gmail.com', 
    		'idRegimenFiscal' => '1', 
    		'estado'=>'Activo',
    		]);



    	DB::table('empresas_ceprozac')->insert([
    		'nombre' => 'JUAN MANUEL MUÑOZ RODRIGEZ', 
    		'representanteLegal' => 'JUAN MANUEL MUÑOZ ESCOBEDO ', 
    		'telefono' => '(492) 949-1163', 
    		'rfc' => 'MURJ810813SU2', 
    		'direcionFisica' => 'AV. CAMPESINO NO. 16B',
    		'direcionFacturacion' => 'EL LAMPOTAL VETAGRANDE ZACATECAS  C.P. 98150', 
    		'email' => 'jmmr8108@gmail.com', 
    		'idRegimenFiscal' => '9', 
    		'estado'=>'Activo',
    		]);



    	DB::table('empresas_ceprozac')->insert([
    		'nombre' => 'BLANCA CECILIA MUÑOZ RODRIGUEZ', 
    		'representanteLegal' => 'BLANCA CECILIA MUÑOZ RODRIGUEZ', 
    		'telefono' => '(492) 124-9382', 
    		'rfc' => 'MURB9009177E5', 
    		'direcionFisica' => 'JUAN ALDAMA NO 25B',
    		'direcionFacturacion' => 'EL LAMPOTAL VETAGRANDE ZACATECAS  C.P. 98150', 
    		'email' => 'cecilia170990@yahoo.com.mx', 
    		'idRegimenFiscal' => '9', 
    		'estado'=>'Activo',
    		]);


    	DB::table('empresas_ceprozac')->insert([
    		'nombre' => 'MANUEL MUÑOZ ESCOBEDO', 
    		'representanteLegal' => 'MANUEL MUÑOZ ESCOBEDO ', 
    		'telefono' => '(492) 909-0033', 
    		'rfc' => 'MUEM6109013W5',
    		'direcionFisica' => 'JUAN ALDAMA NO 25B', 
    		'direcionFacturacion' => 'EL LAMPOTAL VETAGRANDE ZACATECAS  C.P. 98150', 
    		'email' => 'manuelmunozesc@gmail.com', 
    		'idRegimenFiscal' => '9', 
    		'estado'=>'Activo',
    		]);

    }
}
