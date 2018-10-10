<?php

use Illuminate\Database\Seeder;

class AlmacengeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'ALMACEN DE FERTILIZANTES', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'ALMACEN DE FERTILIZANTES', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'ALMACEN DE ACEITES Y LUBRICANTES', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'ALMACEN DE ACEITES Y LUBRICANTES', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'ALMACEN DE REFACCIONES INVERNADERO', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'ALMACEN DE REFACCIONES INVERNADERO', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'TEJABAN 1 ALMACEN MATERIA PRIMA', 
    		'capacidad' => '6', 
    		'medida' => 'CASILLEROS', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '6', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1,2,3,4,5,6', 
    		'descripcion' => 'TEJABAN 1 ALMACEN MATERIA PRIMA', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'SANITIZADORA ALMACEN DE PRODUCTO TERMINADO', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'SANITIZADORA ALMACEN DE PRODUCTO TERMINADO', 
    		'estado'=>'Activo',
    		]);


    	DB::table('almacengeneral')->insert([
    		'nombre' => 'CAMARA FRIA 2 ALMACEN DE PRODUCTO TERMINADO', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'CAMARA FRIA 2 ALMACEN DE PRODUCTO TERMINADO', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 5 PRODUCCION', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 5 PRODUCCION', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 6 PRODUCCION', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 6 PRODUCCION', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 7 PRODUCCION', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 7 PRODUCCION', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 8 ALMACEN PRODUCTO TERMINADO', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 8 ALMACEN PRODUCTO TERMINADO', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'TEJABAN 2 ALMACEN MATERIA PRIMA', 
    		'capacidad' => '6', 
    		'medida' => 'CASILLERO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '6', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1,2,3,4,5,6', 
    		'descripcion' => '', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 9 PRODUCCION', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 9 PRODUCCION', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA MAIZ CEPROZAC', 
    		'capacidad' => '12', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '12', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1,2,3,4,5,6,7,8,9,10,11,12', 
    		'descripcion' => '', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 1 MATERIA PRIMA', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'PATIO ATRÁS CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 1 MATERIA PRIMA', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 2 MATERIA PRIMA', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'PATIO ATRÁS CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 2 MATERIA PRIMA', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 3  MATERIA PRIMA', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'PATIO ATRÁS CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 3  MATERIA PRIMA', 
    		'estado'=>'Activo',
    		]);


    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 4 MATERIA PRIMA', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'PATIO ATRÁS CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 4 MATERIA PRIMA', 
    		'estado'=>'Activo',
    		]);


    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 5 MATERIA PRIMA', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'PATIO ATRÁS CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 5 MATERIA PRIMA', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA TORTILLERIA CASA DE MANUEL', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'PATIO ATRÁS CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => '', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA TORTILLERIA CASA DE MANUEL', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'PATIO ATRÁS CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA TORTILLERIA CASA DE MANUEL', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA SALON EJIDAL', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'PATIO ATRÁS CEPROZAC', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA SALON EJIDAL', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA VIDEO JUEGOS', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'BODEGA SECUNDARIA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA VIDEO JUEGOS', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA CANTERA', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'BODEGA SECUNDARIA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA CANTERA', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA PAN', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'BODEGA SECUNDARIA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA PAN', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA LUPIS', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'BODEGA SECUNDARIA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA LUPIS', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA GRANDE', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'SANTA RITA ', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA GRANDE', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'SAN ANTONIO', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'SANTA RITA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'SAN ANTONIO', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'DESHIDRATADORA SAN ANTONIO', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'SANTA RITA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'DESHIDRATADORA SAN ANTONIO', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 1', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 1', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 2', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 2', 
    		'estado'=>'Activo',
    		]);
    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 3', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 3', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 4', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 4', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 5', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 5', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 6', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 6', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 7', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 7', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 8', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 8', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 9', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 9', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'LOCAL 10', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'LOCAL 10', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 1', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 1', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 2', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 2', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 3', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 3', 
    		'estado'=>'Activo',
    		]);

    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA 4', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA 4', 
    		'estado'=>'Activo',
    		]);


    	DB::table('almacengeneral')->insert([
    		'nombre' => 'BODEGA CALLE ZACATECAS', 
    		'capacidad' => '1', 
    		'medida' => 'ESPACIO', 
    		'ubicacion' => 'TACOALECHE MATERIA PRIMA', 
    		'total_ocupado' => '0', 
    		'total_libre' => '1', 
    		'esp_ocupado' => '', 
    		'esp_libre' => '1', 
    		'descripcion' => 'BODEGA CALLE ZACATECAS', 
    		'estado'=>'Activo',
    		]);
        //
    }
}
