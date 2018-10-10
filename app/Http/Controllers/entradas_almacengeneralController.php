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
use CEPROZAC\lote;
use CEPROZAC\entradas_almacengeneral;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;


class entradas_almacengeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             $almacen = DB::table('entradas_almacengeneral')->get();//falta el where estado
     return view('almacen.general.entradas.index', ['almacen' => $almacen]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
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
        //
    }

 public function verEntradas($id2)
    {
 /*$almacen = espacios_almacen::where('id_almacen', '=', $id)->join( 'provedores as prov', 'espacios_almacen.id_provedor','=','prov.id')->join('productos as prod' ,'espacios_almacen.id_producto','=','prod.id')->firstOrFail();*/

  $almacen2 = almacengeneral::findOrFail($id2);

      $almacen= DB::table('entradas_almacengeneral')->where('entradas_almacengeneral.id_almacen', '=', $id2)
      //->where('entradas_almacengeneral.estado','=','Activo')
       ->join( 'lote as lote', 'entradas_almacengeneral.id_lote','=','lote.id')
       ->join('productos as produ', 'lote.id_producto','=','produ.id')
       ->join('calidad as cali', 'lote.id_calidad','=','cali.id')
       ->join('forma_empaques as emp', 'lote.id_empaque','=','emp.id')
       ->select('entradas_almacengeneral.*','lote.nombre_lote as nombre_lote','lote.humedad as humedad','produ.nombre as nombreprodu','cali.nombre as calinombre','emp.formaEmpaque as empnombre')->get();

   return view('almacen.general.movimientos', ['almacen' => $almacen,'almacen2'=>$almacen2]);
    }
}
