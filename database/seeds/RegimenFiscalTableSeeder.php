<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegimenFiscalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('regimen_fiscal')->insert([
    		'nombre' => 'General de Ley Personas Morales', 
            'estado'=>'Activo',]);

    	DB::table('regimen_fiscal')->insert([
    		'nombre' => 'Personas Morales con Fines no Lucrativos', 
            'estado'=>'Activo',]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Sueldos y Salarios e Ingresos Asimilados a Salarios',
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Arrendamiento',
            'estado'=>'Activo',  ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Demás ingresos',
            'estado'=>'Activo', ]);


        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Consolidación', 
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Residentes en el Extranjero sin Establecimiento Permanente en México', 
            'estado'=>'Activo',]);


        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Ingresos por Dividendos (socios y accionistas)', 
            'estado'=>'Activo',]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Personas Físicas con Actividades Empresariales y Profesionales', 
            'estado'=>'Activo',]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Ingresos por intereses',
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Sin obligaciones fiscales',
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Sociedades Cooperativas de Producción que optan por diferir sus ingresos',
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Incorporación Fiscal', 
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras',
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Opcional para Grupos de Sociedades',
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Coordinados',
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Hidrocarburos',
            'estado'=>'Activo', ]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Régimen de Enajenación o Adquisición de Bienes', 
            'estado'=>'Activo',]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales', 
            'estado'=>'Activo',]);


        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Enajenación de acciones en bolsa de valores', 
            'estado'=>'Activo',]);

        DB::table('regimen_fiscal')->insert([
            'nombre' => 'Régimen de los ingresos por obtención de premios', 
            'estado'=>'Activo',]);




            DB::table('regimen_fiscal')->insert([
            'nombre' => 'General de Ley Personas Morales', 
            'estado'=>'Activo',]);




    }
}
