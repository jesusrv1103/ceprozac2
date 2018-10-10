<?php

use Illuminate\Database\Seeder;

class TractoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'MONTACARGAS HYSTER 1', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);

    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'MONTACARGAS HYSTER 2', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);

    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'MONTACARGAS MITSUBISHI', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);

    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'MONTACARGAS DAEWO', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);


    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'MONTACARGAS TOYOTA', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);

    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'TRACTOR JHON DERE 5615', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);

    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'TRACTOR JHON DERE 5090', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);

    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'TRACTOR MASEY FERGUSON 390 T', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);

    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'TRACTOR MASEY FERGUSON 285', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);

    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'TRACTOR MASEY FERGUSON 135 (1)', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);


    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'TRACTOR MASEY FERGUSON 135 (2)', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);


    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'TRACTOR MASEY FERGUSON 135 (3)', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);


    	DB::table('transporte_sencillos')->insert([
    		'nombre' => 'TRACTOR  NARANJA KUBOTA', 
    		'descripcion' => '',
    		'tipo' =>  'tractor',
    		'estado'=>'Activo',]);
    }
}
