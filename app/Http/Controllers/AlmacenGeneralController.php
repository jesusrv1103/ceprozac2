<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Requests;

use CEPROZAC\almacengeneral;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\EntradasAlmacenLimpieza;
use CEPROZAC\ProvedorMateriales;
use CEPROZAC\espacios_almacen;
use CEPROZAC\lote;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
class almacengeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $almacen = DB::table('almacengeneral')->where('estado','Activo')->get();
       return view('almacen.general.index', ['almacen' => $almacen]);

        //
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almacen.general.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $almacen= new almacengeneral;
        $almacen->nombre=$request->get('nombre');
        $almacen->capacidad=$request->get('capacidad');
        $almacen->ubicacion=$request->get('ubicacion');
        $almacen->medida=$request->get('medida');
        $almacen->descripcion=$request->get('descripcion');
        $almacen->estado="Activo";
        $almacen->esp_ocupado=$request->get('ocupado');
        $almacen->esp_libre=$request->get('libre'); 
        $almacen->total_ocupado=$request->get('totalocupado');
        $almacen->total_libre=$request->get('totallibre');
        $almacen->save();
        $ultimo = almacengeneral::orderBy('id', 'desc')->first()->id;

        $num = 1;
        $y = 0;
        $limite =  $almacen->total_libre;

        while ($num <= $limite) {
            $espacio= new espacios_almacen;
            //print_r($num);
            $producto = [$almacen->esp_libre];
            $first = head($producto);
            $name = explode(",",$first);
            $espacio->num_espacio=$first = $name[$y];
            $espacio->id_almacen=$ultimo;
            $espacio->estado="Libre";
            $espacio->save();
            $y = $y + 1;
            $num = $num + 1;
       //
        //
        }

        $num = 1;
        $y = 0;
        $limite =  $almacen->total_ocupado;

        while ($num <= $limite) {
            $espacio= new espacios_almacen;
            //print_r($num);
            $producto = [$almacen->esp_ocupado];
            $first = head($producto);
            $name = explode(",",$first);
            $espacio->num_espacio=$first = $name[$y];
            $espacio->id_almacen=$ultimo;
            $espacio->estado="Ocupado";
            $espacio->save();
            $y = $y + 1;
            $num = $num + 1;
       //
        //
        }

        return Redirect::to('almacen/general');
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
       $almacen= DB::table('almacengeneral')->where('estado','Activo')->get();
       return view("almacen.general.edit",["almacen"=>almacengeneral::findOrFail($id)],['almacen' => $almacen]);
        //
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
      $almacen=almacengeneral::findOrFail($id);
      $almacen->nombre=$request->get('nombre');
      $almacen->capacidad=$request->get('capacidad');
      $almacen->medida=$request->get('medida');
      $almacen->descripcion=$request->get('descripcion');
      $almacen->ubicacion=$request->get('ubicacion');
      $almacen->estado="Activo";
      $almacen->esp_ocupado=$request->get('ocupado');
      $almacen->esp_libre=$request->get('libre'); 
      $almacen->total_ocupado=$request->get('totalocupado');
      $almacen->total_libre=$request->get('totallibre');
      $almacen->update();
      return Redirect::to('almacen/general');
        //
  } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $almacen=almacengeneral::findOrFail($id);
        $almacen->estado="Inactivo";
        $almacen->update();
        return Redirect::to('almacen/general');
        //
    }

    public function verInformacion($id)
    {
       /*$almacen = espacios_almacen::where('id_almacen', '=', $id)->join( 'provedores as prov', 'espacios_almacen.id_provedor','=','prov.id')->join('productos as prod' ,'espacios_almacen.id_producto','=','prod.id')->firstOrFail();*/
       $almacen2 = almacengeneral::findOrFail($id);

       $almacen= DB::table('lote')->where('id_almacen', '=', $id)
       ->join( 'provedores as prov', 'lote.id_provedor','=','prov.id')
       ->join('productos as prod' ,'lote.id_producto','=','prod.id')
       ->join('calidad as cal' ,'lote.id_calidad','=','cal.id')
       ->join('forma_empaques as emp' ,'lote.id_empaque','=','emp.id')
       ->select('lote.*','prov.nombre as nombreprov','prod.nombre as nomprod','prov.apellidos as apellidos','cal.nombre as calidadnombre','emp.formaEmpaque as empnombre','lote.id as loteid')->get();


       return view("almacen.general.detalle",["almacen"=>$almacen,"almacen2"=>$almacen2]);
   }


   public function movimientos($id)
   {
       /*$almacen = espacios_almacen::where('id_almacen', '=', $id)->join( 'provedores as prov', 'espacios_almacen.id_provedor','=','prov.id')->join('productos as prod' ,'espacios_almacen.id_producto','=','prod.id')->firstOrFail();*/
  //$lote = lote::findOrFail($id);
       $almacengeneral=DB::table('almacengeneral')->where('estado','=' ,'Activo')->orwhere('total_libre','>','0')->get();
       $empleado=DB::table('empleados')->where('estado','=' ,'Activo')->get();

       $almacen= DB::table('lote')->where('lote.id', '=', $id)->where('cantidad_act','>','0')
       ->join( 'provedores as prov', 'lote.id_provedor','=','prov.id')
       ->join('productos as prod' ,'lote.id_producto','=','prod.id')
       ->join('calidad as cal' ,'lote.id_calidad','=','cal.id')
       ->join('forma_empaques as emp' ,'lote.id_empaque','=','emp.id')
       ->join('almacengeneral as alma' ,'lote.id_almacen','=','alma.id')
       ->select('lote.*','prov.nombre as nombreprov','prod.nombre as nomprod','prov.apellidos as apellidos','cal.nombre as calidadnombre','emp.formaEmpaque as empnombre','lote.id as loteid','alma.nombre as almanombre')->first();


       return view("almacen.general.movimientos",["almacen"=>$almacen,"almacengeneral"=>$almacengeneral,"empleado"=>$empleado]);
   }


   public function excel()
   {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('almacen_general', function($excel) {
          $excel->sheet('Excel sheet', function($sheet) {
            $almacen = almacengeneral::select('nombre','capacidad','medida','ubicacion','descripcion')
            ->where('estado', 'Activo')
            ->get();       
            $sheet->fromArray($almacen);
            $sheet->row(1,['Nombre','Capacidad','Unidad de Medida','Ubicación','Descripción']);
            $sheet->setOrientation('landscape');
        });
      })->export('xls');
    }

}
