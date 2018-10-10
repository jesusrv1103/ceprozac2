<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\PrecioBascula;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class PrecioBasculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precioBascula = DB::table('precio_basculas')->where('estado','Activo')->get();
        return view('Bascula.precioBasculas.index',['precioBascula' => $precioBascula]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Bascula.precioBasculas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $precioBascula = new PrecioBascula;
      $precioBascula->tipoVehiculo=$request->get('tipoVehiculo');
      $precioBascula->precioBascula=$request->get('precioBascula');
      $precioBascula->estado='Activo';
      $precioBascula->save();

      return Redirect::to('precioBasculas');

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
      $precioBascula=PrecioBascula::findOrFail($id);
      return view('Bascula.precioBasculas.edit',['precioBascula'=>$precioBascula]);
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
        $precioBascula=PrecioBascula::findOrFail($id);
        $precioBascula->tipoVehiculo=$request->get('tipoVehiculo');
        $precioBascula->precioBascula=$request->get('precioBascula');
        $precioBascula->update();
        return Redirect::to('precioBasculas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $precioBascula=PrecioBascula::findOrFail($id);
        $precioBascula->estado="Inactivo";
        $precioBascula->update();
        return Redirect::to('precioBasculas');
    }


    public function excel()
    {        
      Excel::create('Precio Basculas', function($excel) {
        $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

            $precioBascula = PrecioBascula::select('tipoVehiculo', 'precioBascula')
            ->where('estado', 'Activo')
            ->get();       


            $sheet->fromArray($precioBascula);
            $sheet->row(1,['Tipo Vehiculo','Precio de Pesaje']);

            $sheet->setOrientation('landscape');
        });
    })->export('xls');

      
  }


}


