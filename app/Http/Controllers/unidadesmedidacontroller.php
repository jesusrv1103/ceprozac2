<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use CEPROZAC\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Unidades_medida;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Validator; 

class unidadesmedidacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $unidades= DB::table('unidades_medidas')
      ->join('nombre_unidades_medidas', 'unidades_medidas.idUnidadMedida','=','nombre_unidades_medidas.id')
      ->select('unidades_medidas.nombre','unidades_medidas.cantidad', 'unidades_medidas.id as idUnidadMedida', 'nombre_unidades_medidas.*')
      ->where('unidades_medidas.estado','Activo')->get();

      return view('unidades_medida.index', ['unidades' => $unidades]);

        //

    } 


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $nombreUnidadesMedida =DB::table('nombre_unidades_medidas')->get();


      return view('unidades_medida.create',['nombreUnidadesMedida'=>$nombreUnidadesMedida]);
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
      $unidad = new Unidades_medida;
      $unidad->nombre=$request->get('nombre');
      $unidad->cantidad=$request->get('cantidad');
      $unidad->idUnidadMedida=$request->get('medida');
      $unidad->estado="Activo";
      $unidad->save();
      return Redirect::to('unidades_medida');
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
      $nombreUnidadesMedida =DB::table('nombre_unidades_medidas')->get();

      $unidades = Unidades_medida::findOrFail($id);




      return view('unidades_medida.edit', ['nombreUnidadesMedida'=>$nombreUnidadesMedida,'unidades' => $unidades]);
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
      $unidad = Unidades_medida::findOrFail($id);
      $unidad->nombre=$request->get('nombre');
      $unidad->cantidad=$request->get('cantidad');
      $unidad->idUnidadMedida=$request->get('medida');
      $unidad->estado="Activo";
      $unidad->update();
      return Redirect::to('unidades_medida');
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
     $unidad = Unidades_medida::findOrFail($id);
     $unidad->estado="Inactivo";
     $unidad->update();
     return Redirect::to('unidades_medida');
        //
   }

   public function excel()
   {        

    Excel::create('unidadesmedida', function($excel) {
      $excel->sheet('Excel sheet', function($sheet) {
        $unidadesmedida = Unidades_medida::
        join('nombre_unidades_medidas','unidades_medidas.idUnidadMedida','=','nombre_unidades_medidas.id')
        ->select('nombre','cantidad','nombreUnidadMedida')
        ->where('estado', 'Activo')
        ->get();       
        $sheet->fromArray($unidadesmedida);
        $sheet->row(1,['Nombre','Cantidad Equivalente','Unidad de Medida']);
        $sheet->setOrientation('landscape');
      });
    })->export('xls');
  }
}
