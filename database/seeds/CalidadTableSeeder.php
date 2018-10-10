<?php

use Illuminate\Database\Seeder;

class CalidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('calidad')->insert([
    		'nombre' => '1ª EXPORTACION SIN PATA', 
    		'estado'=>'Activo',]);

    	DB::table('calidad')->insert([
    		'nombre' => '1ª EXPORTACION CON PATA', 
    		'estado'=>'Activo',]);


    	DB::table('calidad')->insert([
    		'nombre' => '1ª NACIONAL CON PATA', 
    		'estado'=>'Activo',]);

    	DB::table('calidad')->insert([
    		'nombre' => '1ª NACIONAL SIN PATA', 
    		'estado'=>'Activo',]);

    	DB::table('calidad')->insert([
    		'nombre' => '2ª CON PATA', 
    		'estado'=>'Activo',]);

    	DB::table('calidad')->insert([
    		'nombre' => '2ª SIN PATA', 
    		'estado'=>'Activo',]);

    	DB::table('calidad')->insert([
    		'nombre' => '3ª SIN PATA', 
    		'estado'=>'Activo',]);


    	DB::table('calidad')->insert([
    		'nombre' => '3ª CON PATA', 
    		'estado'=>'Activo',]);


    	DB::table('calidad')->insert([
    		'nombre' => '3ª TROCEADO SANITIZADO', 
    		'estado'=>'Activo',]);

    	DB::table('calidad')->insert([
    		'nombre' => '3ª TROCEADO', 
    		'estado'=>'Activo',]);

    }
}
