<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('cliente')->insert([
    		'nombre' => 'DESHIDRATADORA AGUASCALIENTES S.A. DE C.V.', 
    		'rfc' =>  'DAG890503QG4',
    		'id_Regimen_Fiscal' => '1',
    		'contacto'  =>  'JAVIER VARGAS DIAZ',
    		'codigo_Postal' => '20016',
    		'telefono' => '(000)000-00000',
    		'email' =>  'xvargas@dasacv.com',
    		'direccion_fact'  => 'AGUASCALEIENTE AGS. COL. FUNDICION AV. FUNDICION 2213',
    		'direccion_entr' => 'AGUASCALEIENTE AGS. COL. FUNDICION AV. FUNDICION 2213',
    		'cantidad_venta'  => '70',
    		'volumen_venta' =>  '200',
    		'saldocliente' => '0',
    		'estado'=>'Activo',
    		]);


    	DB::table('cliente')->insert([
    		'nombre' => 'COMERCIALIZADORA SANTO TOMAS  SA DE CV', 
    		'rfc' =>  'CST8610088862',
    		'id_Regimen_Fiscal' => '1',
    		'contacto'  =>  'JAIME MELENDEZ',
    		'codigo_Postal' => '44940',
    		'telefono' => '(444)863-6080',
    		'email' =>  'jmelendez@santotomas.com.mx',
    		'direccion_fact'  => 'COL. ZONA INDUSTRIAL CALLE 25 NO. 2508',
    		'direccion_entr' => 'DELEGACION BOCAS SLP CAPITAN MANUEL PALAU NO. 275',
    		'cantidad_venta'  => '15',
    		'volumen_venta' =>  'TONELADAS',
    		'saldocliente' => '0',
    		'estado'=>'Activo',
    		]);



    	DB::table('cliente')->insert([
    		'nombre' => 'OROZCO FRUTAS Y LEGUMBRES S DE RL DE CV', 
    		'rfc' =>  'OFL0405128F2',
    		'id_Regimen_Fiscal' => '1',
    		'contacto'  =>  'FERNANDO OROZCO',
    		'codigo_Postal' => '44940',
    		'telefono' => '(331)608-1377',
    		'email' =>  'orozcofrutasylegumbres@hotmail.com',
    		'direccion_fact'  => 'COL. JARDINES DE LA CRUZ AV. CRUZ DEL SUR 2911',
    		'direccion_entr' => 'COL. JARDINES DE LA CRUZ AV. CRUZ DEL SUR 2911',
    		'cantidad_venta'  => '15',
    		'volumen_venta' =>  'TONELADAS',
    		'saldocliente' => '0',
    		'estado'=>'Activo',
    		]);



    }
}



