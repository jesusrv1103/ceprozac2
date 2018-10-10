<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Bascula;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class BasculaController extends Controller
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
     $basculas= DB::table('basculas')->where('estado','Activo')->get();
     return view('Bascula.basculas.index',['basculas' => $basculas]);
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('Bascula.basculas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bascula = new Bascula;
        $bascula->nombreBascula=$request->get('nombre');
        $bascula->observacionesBascula=$request->get('observacionesBascula');
        $bascula->estado='Activo';
        $bascula->save();
        return Redirect::to('basculas');
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
        $basculas=Bascula::findOrFail($id);
        return view("Bascula.basculas.edit",["basculas"=>$basculas]);
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
        $basculas=Bascula::findOrFail($id);
        $basculas->nombreBascula=$request->get('nombre');
        $basculas->observacionesBascula=$request->get('observacionesBascula');
        $basculas->update();
        return Redirect::to('basculas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $basculas=Bascula::findOrFail($id);
        $basculas->estado="Inactivo";
        $basculas->update();
        return Redirect::to('basculas');
    }


    public function excel()
    {        
        Excel::create('Basculas', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $precioBascula =Bascula::select('nombreBascula', 'observacionesBascula')
                ->where('estado', 'Activo')
                ->get();       


                $sheet->fromArray($precioBascula);
                $sheet->row(1,['Nombre Bascula','Observaciones Bascula']);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');

        
    }

}
