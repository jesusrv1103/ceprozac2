<?php

use Illuminate\Database\Seeder;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//1
    	DB::table('empleados')->insert([
    		'nombre' => 'OMAR', 
    		'apellidos' => 'CASTORENA',
    		'numero_Seguro_Social'  =>  '349-67-800359',
    		'curp' => 'CADO780416HZSSLM04', 
            'fecha_Nacimiento' => '16/04/1978',
    		'domicilio' => 'CALLE HIDALGO #10 EL LAMPOTAL VETAGRANDE ZACATECAS', 
    		'telefono' => '(492) 124-9395',
    		'email' => 'omarcd780416@gmail.com', 
            'sexo'  => 'HOMBRE',
            'tipo' => 'NORMAL',
            'estado'=>'Activo',
            ]);




//2
    	DB::table('empleados')->insert([
    		'nombre' => 'JUAN MANUEL', 
    		'apellidos' => 'MUÑOZ ARANDA',
    		'curp' => 'MUAJ760530HZSXRN08', 
            'fecha_Nacimiento' => '30/05/1976',
    		'numero_Seguro_Social'  =>  '830-67-601431',
    		'domicilio' => 'CALLE LA BORDADORA #13 ', 
    		'telefono' => '(492) 892-5101',
    		'email' => 'juanmma760530@gmail.com', 
            'sexo'  => 'HOMBRE',
            'tipo' => 'NORMAL',
            'estado'=>'Activo',
            ]);

//3
    	DB::table('empleados')->insert([
    		'nombre' => 'JUAN MANUEL', 
    		'apellidos' => 'MUÑOZ RODRIGUEZ',
    		'curp' => 'MURJ810813HZSXDN01',
            'fecha_Nacimiento' => '13/08/1981',
    		'numero_Seguro_Social'  =>  '340-48-100043', 
    		'domicilio' => 'JUAN ALDAMA #25B EL LAMPOTAL VETAGRANDE ZACATECAS', 
    		'telefono' => '(492) 124-9395',
    		'email' => 'juanmmr810813@gmail.com', 
            'sexo'  => 'HOMBRE',
            'tipo' => 'NORMAL',
            'estado'=>'Activo',
            ]);


//4
    	DB::table('empleados')->insert([
    		'nombre' => 'NOE ', 
    		'apellidos' => 'MUÑOZ RODRIGUEZ',
    		'curp' => 'MURN990105HZSXDX09', 
            'fecha_Nacimiento' => '05/01/1999',
    		'numero_Seguro_Social'  =>  '317-99-28308',
    		'domicilio' => 'JUAN ALDAMA #25B EL LAMPOTAL VETAGRANDE ZACATECAS', 
    		'telefono' => '(492) 124-9395',
    		'email' => 'ceprozac@gmail.com ', 
            'sexo'  => 'HOMBRE',
            'tipo' => 'NORMAL',
            'estado'=>'Activo',
            ]);
//5
    	DB::table('empleados')->insert([
    		'nombre' => 'MANUEL', 
    		'apellidos' => 'MUÑOZ ESCOBEDO',
    		'curp' => 'MUEM690901HZSXSN01',
            'fecha_Nacimiento' => '01/09/1969', 
    		'numero_Seguro_Social'  =>  '349-26-100032',
    		'domicilio' => 'JUAN ALDAMA #25B EL LAMPOTAL VETAGRANDE ZACATECAS', 
    		'telefono' => '(492) 124-9395',
    		'email' => 'ceprozac@gmail.com ', 
         'tipo' => 'NORMAL',
         'estado'=>'Activo',
         ]);

//6
    	DB::table('empleados')->insert([
    		'nombre' => 'LUIS ALBERTO', 
    		'apellidos' => 'RODRIGUEZ',
    		'curp' => 'ROTL800609HZSDRS01', 
            'fecha_Nacimiento' => '09/06/1980',
    		'numero_Seguro_Social'  =>  '031-48-036407',
    		'domicilio' => 'CALLE ORIZABA #15 EL LAMPOTAL VETAGRANDE ZAC', 
    		'telefono' => '(492) 892-5101',
    		'email' => 'luisart800609@gmail.com', 
            'sexo'  => 'HOMBRE',
            'tipo' => 'NORMAL',
            'estado'=>'Activo',
            ]);

    	//7

    	DB::table('empleados')->insert([
    		'nombre' => 'EZEQUIEL', 
    		'apellidos' => 'MACIEL',
    		'curp' => 'MACE771102HZSCRZ00', 
            'fecha_Nacimiento' => '02/11/1977',
    		'numero_Seguro_Social'  =>  '349-77-703866',
    		'domicilio' => 'CALLE 10 DE MAYO #1 EL LAMPOTAL VETAGRANDE,ZAC. ', 
    		'telefono' => '(492) 146-9626',
    		'email' => 'ezequielmc771102@gmail.com', 
            'sexo'  => 'HOMBRE',
            'tipo' => 'NORMAL',
            'estado'=>'Activo',
            ]);

//8
    	
    	DB::table('empleados')->insert([
    		'nombre' => 'ALEJANDRO', 
    		'apellidos' => 'RODRIGUEZ',
    		'curp' => 'ROTM930606HZSDRN08',
            'fecha_Nacimiento' => '06/06/1993',
    		'numero_Seguro_Social'  =>  '341-29-315213', 
    		'domicilio' => 'COLONIA LAS ROSITAS #6 EL LAMPOTAL VETAGRANDE ZACATECAS', 
    		'telefono' => '(492) 124-9395',
    		'email' => 'ceprozac@gmail.com ', 
            'sexo'  => 'HOMBRE',
            'estado'=>'Activo',
            ]);


//9
    	DB::table('empleados')->insert([
    		'nombre' => 'MANUEL', 
    		'apellidos' => 'GARCIA',
    		'curp' => 'GAMM970101HXXRXN00', 
            'fecha_Nacimiento' => '01/01/1997',
    		'numero_Seguro_Social'  =>  '631-59-741014',
    		'domicilio' => 'AVENIDA ZACATECAS S/N EL LAMPOTAL VETAGRANDE ZACATECAS', 
    		'telefono' => '(492) 909-9345',
    		'email' => 'manuelagm970101@gmail.com',
            'sexo'  => 'HOMBRE', 
            'tipo' => 'NORMAL',
            'estado'=>'Activo',
            ]);



    	//10

    	DB::table('empleados')->insert([
    		'nombre' => 'GENARO', 
    		'apellidos' => 'MACIEL',
    		'curp' => 'MARG551019HZSCYN07',
            'fecha_Nacimiento' => '19/10/1955',
    		'numero_Seguro_Social'  =>  '338-05-500916', 
    		'domicilio' => 'CARRETERA A SANTA MONICA POZO DE GAMBOA EL LAMPOTAL VETAGRANDE ZACATECAS', 
    		'telefono' => '(492) 124-9395',
    		'email' => 'genaromr551019@gmail.com', 
            'sexo'  => 'HOMBRE',
            'tipo' => 'NORMAL',
            'estado'=>'Activo',
            ]);
    	


//11
    	DB::table('empleados')->insert([
    		'nombre' => 'PEDRO', 
    		'apellidos' => 'REYES',
    		'curp' => 'RERP910209HZSYSD06', 
            'fecha_Nacimiento' => '09/02/1991',
            'fecha_Nacimiento' => '',
    		'numero_Seguro_Social'  =>  '341-09-103613',
    		'domicilio' => 'CALLE CHAPULTEPEC #1 EL LAMPOTAL VETAGRANDE ZACATECAS ', 
    		'telefono' => '(556) 115-5114',
         'email' => 'pedroerr910209@gmail.com', 
         'sexo'  => 'HOMBRE',
         'tipo' => 'NORMAL',
         'estado'=>'Activo',
         ]);

///////////////
//Empleado ROles
//1
        DB::table('empleado_roles')->insert([
            'idEmpleado' => '1', 
            'idRol' => '10',
            ]);

        //2

        DB::table('empleado_roles')->insert([
            'idEmpleado' => '2', 
            'idRol' => '10',
            ]);

        //3

        DB::table('empleado_roles')->insert([
            'idEmpleado' => '3', 
            'idRol' => '10',
            ]);

        //4


        DB::table('empleado_roles')->insert([
            'idEmpleado' => '4', 
            'idRol' => '10',
            ]);

        //5


        DB::table('empleado_roles')->insert([
            'idEmpleado' => '5', 
            'idRol' => '10',
            ]);

        //6


        DB::table('empleado_roles')->insert([
            'idEmpleado' => '6', 
            'idRol' => '10',
            ]);

        //7

        
        DB::table('empleado_roles')->insert([
            'idEmpleado' => '7', 
            'idRol' => '10',
            ]);

        //8

        DB::table('empleado_roles')->insert([
            'idEmpleado' => '8', 
            'idRol' => '10',
            ]);

        //9

        DB::table('empleado_roles')->insert([
            'idEmpleado' => '9', 
            'idRol' => '10',
            ]);

        //10


        DB::table('empleado_roles')->insert([
            'idEmpleado' => '10', 
            'idRol' => '10',
            ]);

        //11

        DB::table('empleado_roles')->insert([
            'idEmpleado' => '11', 
            'idRol' => '10',
            ]);


    }

}
