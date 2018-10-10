<?php

use Illuminate\Database\Seeder;

class LimpiezaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'OFICINAS GENERALES',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'OFICINAS GENERALES', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑOS SALA DE JUNTA',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑOS SALA DE JUNTA', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑO OFICINA PRINCIPAL ',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑO OFICINA PRINCIPA', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑO OFICINA  ADMINISTRATIVA ',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑO OFICINA  ADMINISTRATIVA', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑO OFICINA RH',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑO OFICINA RH', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑO COCHERA EN OFICINA',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑO COCHERA EN OFICINA', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑO OFICINA ENTRADA PRINCIPAL ',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑO OFICINA ENTRADA PRINCIPAL', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑOS INVERNADERO',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑOS INVERNADERO', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑO DE COCINA',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑO DE COCINA', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑO COMEDOR TRABAJADORES',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑO COMEDOR TRABAJADORES', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑO PATIO 1',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑO PATIO 1', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'BAÑO PATIO 2',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'BAÑO PATIO 2', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'COMEDOR TRABAJADORES',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'COMEDOR TRABAJADORES', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'LAVADO DE TRANSPORTE',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'LAVADO DE TRANSPORTE', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'DESACTIVAR PHOSTOXIN',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'DESACTIVAR PHOSTOXIN', 
    		'estado'=>'Activo',
    		]);

    	DB::table('ubicaciones_limpieza')->insert([
    		'nombre' => 'ALMACENES Y TEJABANES DE MATERIA PRIMA',
    		'ubicacion' => 'CERPOZAC',
    		'descripcion' => 'ALMACENES Y TEJABANES DE MATERIA PRIMA', 
    		'estado'=>'Activo',
    		]);


        //
    }
}
