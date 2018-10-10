<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('rol_empleados')->insert([
    		'rol_Empleado' => 'SUPERVISOR DE PRODUCCIÓN BODEGA 6', 
    		'estado'=>'Activo',]);

    	DB::table('rol_empleados')->insert([
    		'rol_Empleado' => 'MANTENIMIENTO', 
    		'estado'=>'Activo',]);

        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'ENCARGADO DE PRODUCCIÓN', 
            'estado'=>'Activo',]);

        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'GERENTE  DE CALIDAD', 
            'estado'=>'Activo',]);

        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'SECRETARIA', 
            'estado'=>'Activo',]);

        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'SUPERVISOR DE PRODUCCION BODEGA 5', 
            'estado'=>'Activo',]);

        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'ENCARGADO DE LLAVES', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'SUPERVISORA DE PRODUCCIÓN BODEGA 7', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'INTENDENTE', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'OPERADOR DE TRÁILER', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'SUPERVISOR DE PRODUCCIÓN LAVADORA', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'CONTROLADOR DE PLAGA INTERNO', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'ENCARGADO DE RIEGO MALLAS', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'MAYORDOMO EN INVERNADERO', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'REGADOR PLÁSTICO', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'FUMIGADOR INVERNADERO', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'REPRESENTANTE LEGAL', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'GERENTE ADMINISTRATIVO ', 
            'estado'=>'Activo',]);
        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'GERENTE DE RECURSOS HUMANOS', 
            'estado'=>'Activo',]);

        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'AUXILIAR ADMINISTRATIVO', 
            'estado'=>'Activo',]);

        DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'GERENTE OPERATIVO', 
            'estado'=>'Activo',]);

          DB::table('rol_empleados')->insert([
            'rol_Empleado' => 'EMPLEADO', 
            'estado'=>'Activo',]);
    }
}
