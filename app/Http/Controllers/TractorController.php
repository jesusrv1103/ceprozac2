<?php

namespace CEPROZAC\Http\Controllers;
use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use CEPROZAC\TransporteSencillo;
use CEPROZAC\MantenimientoTractores;
use Maatwebsite\Excel\Facades\Excel;


class TractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vehiculos= DB::table('transporte_sencillos')
        ->select('transporte_sencillos.*')
        ->where('transporte_sencillos.estado','Activo')->get();
        return  view('Transportes.tractores.index', ['vehiculos'=> $vehiculos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Transportes.tractores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tractores= new TransporteSencillo;

        $tractores->nombre=$request->get('nombre');
        $tractores->descripcion=$request->get('descripcion');
        $tractores->estado="Activo";
        $tractores->save();
        return Redirect::to('tractores');
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
        $tractores=TransporteSencillo::findOrFail($id);
        return view("Transportes.tractores.edit",["tractores"=>$tractores]);
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
        $tractores=TransporteSencillo::findOrFail($id);
        $tractores->nombre=$request->get('nombre');
        $tractores->descripcion=$request->get('descripcion');

        $tractores->update();
        return Redirect::to('tractores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tractores=TransporteSencillo::findOrFail($id);
        $tractores->estado='Inactivo';
        $tractores->save();
        return Redirect::to('tractores');
    }



    public function excel()
    {        

        Excel::create('Tractores', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $bancos = TransporteSencillo::select('nombre', 'descripcion')
                ->where('estado', 'Activo')
                ->get();       
                
                $sheet->fromArray($bancos);
                $sheet->row(1,['Nombre Tractor','Descripcion']);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }



    public function verMantenimientos($id)
    {
        $transporte=TransporteSencillo::findOrFail($id);
        $mantenimientos= DB::table('mantenimiento_tractores')
        ->join('transporte_sencillos as t', 'mantenimiento_tractores.idTractor', '=', 't.id')
        ->join('empleados as m', 'mantenimiento_tractores.idMecanico','=','m.id')
        ->join('empleados as c', 'mantenimiento_tractores.idChofer','=','c.id')
        ->select('t.nombre','mantenimiento_tractores.concepto','mantenimiento_tractores.descripcion','mantenimiento_tractores.fecha' ,'m.nombre as nm', 'm.apellidos as am','c.nombre as nc', 'c.apellidos as ac',
            'mantenimiento_tractores.id as idMantenimiento')
        ->where('mantenimiento_tractores.estado','Activo')
        ->where('mantenimiento_tractores.idTractor','=',$id)
        ->get();
        return view('Transportes.tractores.listaMantenimientos',['transporte' => $transporte, 'mantenimientos'=>$mantenimientos]);
        
    }


    public function descargarMantenimientos($id,$nombre)
    {
        $nombreExcel ='Lista Mantenimiento de Tractor'.' '.$nombre;
        Excel::create($nombreExcel,function($excel) use ($id) {

            $excel->sheet('Excel sheet', function($sheet) use($id) {

                $mantenimiento = MantenimientoTractores::join('transporte_sencillos as t', 'mantenimiento_tractores.idTractor', '=', 't.id')
                ->select('mantenimiento_tractores.concepto','mantenimiento_tractores.descripcion','mantenimiento_tractores.fecha')
                ->where('mantenimiento_tractores.estado','Activo')
                ->where('t.id','=',$id)
                ->get(); 

                $sheet->fromArray($mantenimiento);
                $sheet->row(1,['Concepto','Desripcion','Fecha' ]);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');

    }



}
