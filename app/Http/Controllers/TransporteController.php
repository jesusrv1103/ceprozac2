<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Empleado;
use CEPROZAC\Transporte;
use CEPROZAC\MantenimientoTransporte;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class TransporteController extends Controller
{

 public function __construct()
 {
    $this->middleware('guest', ['except' => 'getLogout']);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos= DB::table('transportes')
        ->join( 'empleados as e', 'transportes.chofer_id','=','e.id')
        ->select('transportes.*','e.nombre','e.apellidos')
        ->where('transportes.estado','Activo')->get();
        return view('Transportes.transportes.index',['vehiculos'=>$vehiculos]);


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

        return view('Transportes.transportes.create',['operadores'=>$operadores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $transporte = new Transporte;
        $transporte->nombre_Unidad=$request->get('nombre_Unidad');
        $transporte->no_Serie=$request->get('no_Serie');
        $transporte->placas=$request->get('placas');
        $transporte->poliza_Seguro=$request->get('poliza_Seguro');
        $transporte->vigencia_Seguro=$request->get('vigencia_Seguro');
        $transporte->aseguradora=$request->get('aseguradora');
        $transporte->m3_Unidad=$request->get('m3_Unidad');
        $transporte->capacidad=$request->get('capacidad');
        $transporte->chofer_id   =$request->get('chofer_id');
        $transporte->estado='Activo';
        $transporte->save();
        return Redirect::to('transportes');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculo=Transporte::findOrFail($id);
        $operadores= DB::table('empleados')
        ->join('empleado_roles as er','er.idEmpleado','=','empleados.id')
        ->join('rol_empleados','er.idRol','=','rol_empleados.id')
        ->select('empleados.id','empleados.nombre','empleados.apellidos')
        ->where('rol_empleados.rol_Empleado','OPERADOR DE TRÁILER')
        ->where('empleados.estado','Activo')->get();
        return view('Transportes.transportes.edit',['vehiculo'=>$vehiculo,"operadores"=>$operadores]);

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
        $transporte=Transporte::findOrFail($id);
        $transporte->nombre_Unidad=$request->get('nombre_Unidad');
        $transporte->no_Serie=$request->get('no_Serie');
        $transporte->placas=$request->get('placas');
        $transporte->poliza_Seguro=$request->get('poliza_Seguro');
        $transporte->vigencia_Seguro=$request->get('vigencia_Seguro');
        $transporte->aseguradora=$request->get('aseguradora');
        $transporte->m3_Unidad=$request->get('m3_Unidad');
        $transporte->capacidad=$request->get('capacidad');
        $transporte->chofer_id=$request->get('chofer_id');
        $transporte->update();
        return Redirect::to('transportes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transporte=Transporte::findOrFail($id);
        $transporte->estado="Inactivo";
        $transporte->update();
        return Redirect::to('transportes');
    }



    public function excel()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Lista de vehiculos', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $vehiculo = Transporte::join('empleados', 'empleados.id', '=', 'transportes.chofer_id')
                ->select('transportes.nombre_Unidad','transportes.no_Serie','transportes.placas','transportes.poliza_Seguro','transportes.vigencia_Seguro','transportes.aseguradora','transportes.m3_Unidad','transportes.capacidad', \DB::raw("concat(empleados.nombre,' ',empleados.apellidos) as 'name'"))
                ->where('empleados.estado', 'Activo')
                ->get();       
                $sheet->fromArray($vehiculo);
                $sheet->row(1,['Nombre Vehiculo','Numero Serie','Placas','Poliza Seguro','Vigencia Seguro','Aseguradora','Capacidad Ubica','Capacidad','Nombre Chofer']);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }



    public function verTransportes($id)
    {
        $transporte=Transporte::findOrFail($id);
        $mantenimientos= DB::table('mantenimiento_transportes')
        ->join('transportes as t', 'mantenimiento_transportes.idTransporte', '=', 't.id')
        ->join('empleados as m', 'mantenimiento_transportes.idMecanico','=','m.id')
        ->join('empleados as c', 'mantenimiento_transportes.idChofer','=','c.id')
        ->select('t.nombre_Unidad','mantenimiento_transportes.concepto','mantenimiento_transportes.descripcion','mantenimiento_transportes.fecha' ,'m.nombre as nm', 'm.apellidos as am','c.nombre as nc', 'c.apellidos as ac',
            'mantenimiento_transportes.id as idMantenimiento')
        ->where('mantenimiento_transportes.estado','Activo')
        ->where('mantenimiento_transportes.idTransporte','=',$id)
        ->get();
        return view('Transportes.transportes.listaMantenimientos',['transporte' => $transporte, 'mantenimientos'=>$mantenimientos]);
        
    }

    public function descargarMantenimientos($id,$nombre)
    {
        $nombreExcel ='Lista Mantenimiento de Vehiculo'.' '.$nombre;
        Excel::create($nombreExcel,function($excel) use ($id) {

            $excel->sheet('Excel sheet', function($sheet) use($id) {

                $mantenimiento = MantenimientoTransporte::join('transportes as t', 'mantenimiento_transportes.idTransporte', '=', 't.id')
                ->select('mantenimiento_transportes.concepto','mantenimiento_transportes.descripcion','mantenimiento_transportes.fecha')
                ->where('mantenimiento_transportes.estado','Activo')
                ->where('t.id','=',$id)
                ->get(); 

                $sheet->fromArray($mantenimiento);
                $sheet->row(1,['Concepto','Desripcion','Fecha' ]);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');

    }



    public function validarPlacas($placas_Or_serie)
    {

        $transportes= Transporte::
        select('id','nombre_Unidad','placas','no_Serie','aseguradora','capacidad','estado')

        ->where('placas','=',$placas_Or_serie)
        ->orWhere('no_Serie', '=',$placas_Or_serie)
        ->get();

        return response()->json(
            $transportes->toArray());

    }

    public function activar(Request $request)
    { 
        $id =  $request->get('idVehiculo');
        $transportes=Transporte::findOrFail($id);
        $transportes->estado="Activo";
        $transportes->update();
        return Redirect::to('transportes');
    }

    public function calcularFecha($fechaFin){

     $date = Carbon::now();
     $date->format('Y-m-d');

     $dia=substr($fechaFin,0,2);
     $mes=substr($fechaFin, 3,2);
     $ano=substr($fechaFin, 6,7);
     // $fecha =$ano."-".$mes."-".$;
     $dt = Carbon::createMidnightDate($ano, $mes, $dia);
     return $date->diffInDays($dt,false);                        


 }


}

