<?php

use Illuminate\Database\Seeder;

class TransportesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {






    	DB::table('transportes')->insert([
    		'nombre_Unidad' => 'TORTON KENWORTH', 
    		'placas' => '65AA4N',
    		'no_Serie' =>   '3WKADE60X7YF505671',
    		'poliza_Seguro' => '2160120438117',
    		'vigencia_Seguro' => '19/07/2019',
    		'aseguradora' => 'INBURSA',
    		'm3_Unidad' => '0',
    		'capacidad' => '0',
    		'chofer_id' => '1',
    		'estado'=>'Activo',]);


    	DB::table('transportes')->insert([
    		'nombre_Unidad' => 'TORTON MERCEDES', 
    		'placas' => 'ZB2587A',
    		'no_Serie' =>   '3AM68532150025917',
    		'poliza_Seguro' => '0650060145',
    		'vigencia_Seguro' => '25/11/2018',
    		'aseguradora' => 'QUALITAS',
    		'm3_Unidad' => '0',
    		'capacidad' => '0',
    		'chofer_id' => '1',
    		'estado'=>'Activo',]);




    	DB::table('transportes')->insert([
    		'nombre_Unidad' => 'TORTON DINA', 
    		'placas' => 'ZF31269',
    		'no_Serie' =>   '4623450-B1',
    		'poliza_Seguro' => '0000000000' ,
    		'vigencia_Seguro' => '00/00/0000',
    		'aseguradora' => 'NO DEFINIDA',
    		'm3_Unidad' => '0',
    		'capacidad' => '0',
    		'chofer_id' => '1',
    		'estado'=>'Activo',]);


    	DB::table('transportes')->insert([
    		'nombre_Unidad' => 'TORTON FORD', 
    		'placas' => 'ZF31273',
    		'no_Serie' =>   'AC5JPJ-64043' ,
    		'poliza_Seguro' => '0000000000',
    		'vigencia_Seguro' => '00/00/0000',
    		'aseguradora' => 'NO DEFINIDA',
    		'm3_Unidad' => '0',
    		'capacidad' => '0',
    		'chofer_id' => '1',
    		'estado'=>'Activo',]);


    	DB::table('transportes')->insert([
    		'nombre_Unidad' => 'CAMIONETA H 100', 
    		'placas' => 'ZB2585A',
    		'no_Serie' =>   'KMFZB17H49U414055',
    		'poliza_Seguro' => '0650058790' ,
    		'vigencia_Seguro' => '18/09/2018',
    		'aseguradora' => 'QUALITAS',
    		'm3_Unidad' => '0',
    		'capacidad' => '0',
    		'chofer_id' => '1',
    		'estado'=>'Activo',]);

    	DB::table('transportes')->insert([
    		'nombre_Unidad' => 'CAMION CITY STAR', 
    		'placas' => 'AD4458A',
    		'no_Serie' =>   'LJ11KCBC7D8045978',
    		'poliza_Seguro' => '0650060447',
    		'vigencia_Seguro' => '21/12/2018',
    		'aseguradora' => 'QUALITAS',
    		'm3_Unidad' => '0',
    		'capacidad' => '0',
    		'chofer_id' => '1',
    		'estado'=>'Activo',]);

    	DB::table('transportes')->insert([
    		'nombre_Unidad' => 'CAMION CITY STAR', 
    		'placas' => 'AE4219A',
    		'no_Serie' =>   'LJ11KCBC1D8045975',
    		'poliza_Seguro' => '0650060449' ,
    		'vigencia_Seguro' => '21/12/2018',
    		'aseguradora' => 'QUALITAS' ,
    		'm3_Unidad' => '0',
    		'capacidad' => '0',
    		'chofer_id' => '1',
    		'estado'=>'Activo',]);

    	DB::table('transportes')->insert([
    		'nombre_Unidad' => 'CAMION INTERNACIONAL', 
    		'placas' => 'ZB2586A',
    		'no_Serie' =>   'LJ11KCBC1D8036306' ,
    		'poliza_Seguro' =>  '0650060448',
    		'vigencia_Seguro' => '21/12/2018',
    		'aseguradora' => 'QUALITAS',
    		'm3_Unidad' => '0' ,
    		'capacidad' => '0' ,
    		'chofer_id' => '1' ,
    		'estado'=>'Activo',]);

    }
}






