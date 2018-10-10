<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Transporte;
use CEPROZAC\MantenimientoTransporte;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class MantenimientoTransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mantenimientos= DB::table('mantenimiento_transportes')
        ->join('transportes', 'mantenimiento_transportes.idTransporte','=','transportes.id')
        ->join('empleados as m', 'mantenimiento_transportes.idMecanico','=','m.id')
        ->join('empleados as c', 'mantenimiento_transportes.idChofer','=','c.id')
        ->select('mantenimiento_transportes.*','transportes.nombre_Unidad', 'm.nombre as nm', 'm.apellidos as am','c.nombre as nc', 'c.apellidos as ac')
        ->where('mantenimiento_transportes.estado','Activo')
        ->get();
        return view('Transportes.mantenimientoTransportes.index', ['mantenimientos' => $mantenimientos]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operadores= DB::table('empleados')
        ->join('empleado_roles as er','er.idEmpleado','=','empleados.id')
        ->join('rol_empleados','er.idRol','=','rol_empleados.id')
        ->select('empleados.id','empleados.nombre','empleados.apellidos')
        ->where('rol_empleados.rol_Empleado','OPERADOR DE TRÁILER')
        ->where('empleados.estado','Activo')->get();


        $encargados_mantenimiento= DB::table('empleados')
        ->join('empleado_roles as er','er.idEmpleado','=','empleados.id')
        ->join('rol_empleados','er.idRol','=','rol_empleados.id')
        ->select('empleados.id','empleados.nombre','empleados.apellidos')
        ->where('rol_empleados.rol_Empleado','MANTENIMIENTO')
        ->where('empleados.estado','Activo')->get();


        $transportes= DB::table('transportes')->where('estado','Activo')->get();

        return   view('Transportes.mantenimientoTransportes.create',['transportes'=>$transportes,
            'operadores'=>$operadores,'encargados_mantenimiento'=>$encargados_mantenimiento]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $mantenimiento = new MantenimientoTransporte;
      $mantenimiento->concepto=$request->get('concepto');
      $mantenimiento->idTransporte=$request->get('idTransporte');
      $mantenimiento->descripcion=$request->get('descripcion');
      $mantenimiento->fecha=$request->get('fecha');
      $mantenimiento->idChofer=$request->get('idChofer');
      $mantenimiento->idMecanico=$request->get('idMecanico');
      $mantenimiento->estado='Activo';
      $mantenimiento->save();
      return Redirect::to('mantenimiento');
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }



    public function  crearMantenimientoEspecifico($id)
    {
       $operadores= DB::table('empleados')
       ->join('empleado_roles as er','er.idEmpleado','=','empleados.id')
       ->join('rol_empleados','er.idRol','=','rol_empleados.id')
       ->select('empleados.id','empleados.nombre','empleados.apellidos')
       ->where('rol_empleados.rol_Empleado','OPERADOR DE TRÁILER')
       ->where('empleados.estado','Activo')->get();


       $encargados_mantenimiento= DB::table('empleados')
       ->join('empleado_roles as er','er.idEmpleado','=','empleados.id')
       ->join('rol_empleados','er.idRol','=','rol_empleados.id')
       ->select('empleados.id','empleados.nombre','empleados.apellidos')
       ->where('rol_empleados.rol_Empleado','MANTENIMIENTO')
       ->where('empleados.estado','Activo')->get();


       $transportes= DB::table('transportes')->where('estado','Activo')->get();
       $transporteEspecifico=Transporte::findOrFail($id);

       return view('Transportes.mantenimientoTransportes.createMantenimientoEspecifico',['operadores'=>$operadores,'encargados_mantenimiento'=>$encargados_mantenimiento, 'transportes'=>$transportes,'transporteEspecifico'=>$transporteEspecifico]);

   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $mantenimiento=MantenimientoTransporte::findOrFail($id);

        $operadores= DB::table('empleados')
        ->join('empleado_roles as er','er.idEmpleado','=','empleados.id')
        ->join('rol_empleados','er.idRol','=','rol_empleados.id')
        ->select('empleados.id','empleados.nombre','empleados.apellidos')
        ->where('rol_empleados.rol_Empleado','OPERADOR DE TRÁILER')
        ->where('empleados.estado','Activo')->get();


        $encargados_mantenimiento= DB::table('empleados')
        ->join('empleado_roles as er','er.idEmpleado','=','empleados.id')
        ->join('rol_empleados','er.idRol','=','rol_empleados.id')
        ->select('empleados.id','empleados.nombre','empleados.apellidos')
        ->where('rol_empleados.rol_Empleado','MANTENIMIENTO')
        ->where('empleados.estado','Activo')->get();


        $transportes=DB::table('transportes')->where('estado','=','Activo')->get();
        
        return view('Transportes.mantenimientoTransportes.edit',['mantenimiento'=>$mantenimiento,'transportes'=>$transportes,'operadores'=>$operadores,'encargados_mantenimiento'=>$encargados_mantenimiento]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mantenimiento=MantenimientoTransporte::findOrFail($id);
        $mantenimiento->concepto=$request->get('concepto');
        //echo $request->get('nombre');
        $mantenimiento->idTransporte=$request->get('idTransporte');
        $mantenimiento->descripcion=$request->get('descripcion');
        $mantenimiento->fecha=$request->get('fecha');
        $mantenimiento->idChofer=$request->get('idChofer');
        $mantenimiento->idMecanico=$request->get('idMecanico');

        $mantenimiento->estado='Activo';
        $mantenimiento->update();
        return Redirect::to('mantenimiento');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mantenimiento=MantenimientoTransporte::findOrFail($id);
        $mantenimiento->estado="Inactivo";
        $mantenimiento->update();
        return Redirect::to('mantenimiento');
    }


    public function excel()
    {        

        Excel::create('Lista Mantenimiento Vehiculo', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $mantenimiento = MantenimientoTransporte::join('transportes as t', 'mantenimiento_transportes.idTransporte', '=', 't.id')
                ->select('t.nombre_Unidad','mantenimiento_transportes.concepto','mantenimiento_transportes.descripcion','mantenimiento_transportes.fecha')
                ->where('mantenimiento_transportes.estado','Activo')->get();     
                

                $sheet->fromArray($mantenimiento);
                $sheet->row(1,['Nombre Vehiculo','concepto','Desripcion','Fecha' ]);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

}
