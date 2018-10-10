<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\ServicioBascula;
use DB;
use Maatwebsite\Excel\Facades\Excel;


class ServicioBasculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $servicioBascula= DB::table('servicio_basculas')
        ->join('empleados as e','servicio_basculas.idEmpleado','=','e.id')
        ->join('basculas as b','servicio_basculas.idBascula','=','b.id')
        ->join('precio_basculas as pb','servicio_basculas.idBascula','=','pb.id')
        ->select('servicio_basculas.*', 'pb.tipoVehiculo','pb.precioBascula','e.nombre','e.apellidos','b.nombreBascula')
        ->where('servicio_basculas.estado','Activo')->get();
        return view('Bascula.servicioBascula.index', ['servicioBascula' => $servicioBascula]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $precio_basculas=DB::table('precio_basculas')->where('estado','=','Activo')->get();
        $empleados=DB::table('empleados')->where('estado','=','Activo')->get();
        $basculas=DB::table('basculas')->where('estado','=','Activo')->get();
        return view('Bascula.servicioBascula.create',['precio_basculas'=>$precio_basculas,'empleados'=>$empleados,'basculas'=>$basculas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $servicioBascula = new ServicioBascula;
       $servicioBascula->numeroTicket=$request->get('numeroTicket');
       $servicioBascula->idEmpleado=$request->get('idEmpleado');
       $servicioBascula->idBascula=$request->get('idBascula');
       $servicioBascula->idPrecioBascula=$request->get('idPrecioBascula');
       $servicioBascula->estado='Activo';
       $servicioBascula->save();
       return Redirect::to('serviciosBascula');
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
      $servicioBascula=ServicioBascula::findOrFail($id);
      $precio_basculas=DB::table('precio_basculas')->where('estado','=','Activo')->get();
      $empleados=DB::table('empleados')->where('estado','=','Activo')->get();
      $basculas=DB::table('basculas')->where('estado','=','Activo')->get();
      return view('Bascula.servicioBascula.edit',['servicioBascula'=>$servicioBascula,'precio_basculas'=>$precio_basculas,'empleados'=>$empleados,'basculas'=>$basculas]);
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
        $servicioBascula=ServicioBascula::findOrFail($id);
        $servicioBascula->numeroTicket=$request->get('numeroTicket');
        $servicioBascula->idEmpleado=$request->get('idEmpleado');
        $servicioBascula->idBascula=$request->get('idBascula');
        $servicioBascula->idPrecioBascula=$request->get('idPrecioBascula');
        $servicioBascula->update();
        return Redirect::to('serviciosBascula');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicio=ServicioBascula::findOrFail($id);
        $servicio->estado="Inactivo";
        $servicio->update();
        return Redirect::to('serviciosBascula');
    }


    public function excel()
    {        
        Excel::create('Servicio Basculas', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $servicioBascula = ServicioBascula::join('empleados as e', 'servicio_basculas.idEmpleado', '=', 'e.id')
                ->join('basculas as b','servicio_basculas.idBascula','=','b.id')
                ->join('precio_basculas as pb','servicio_basculas.idBascula','=','pb.id')
                ->select('servicio_basculas.numeroTicket', 'pb.tipoVehiculo',DB::raw('CONCAT(e.nombre," ",e.apellidos) AS nomEm'),'b.nombreBascula','pb.precioBascula')
                ->where('servicio_basculas.estado','Activo')->get();


                $sheet->fromArray($servicioBascula);
                $sheet->row(1,['Numero Ticket','Tipo de Vehiculo','Nombre de Cajero','Bascula','Precio de Pesaje']);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }


}
