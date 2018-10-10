<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Calidad;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 

class CalidadController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
     $calidades= DB::table('calidad')->where('estado','Activo')->get();
     return view('Productos.calidad.index',['calidades' => $calidades]);
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return  view('Productos.calidad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $calidad = new Calidad;
        $calidad->nombre=$request->get('nombre');
        $calidad->descripcion=$request->get('descripcion');
        $calidad->estado='Activo';
        $calidad->save();
        return Redirect::to('calidad');
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
        $calidad=Calidad::findOrFail($id);
        return view("Productos.calidad.edit",["calidad"=>$calidad]);
        
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
        $calidad=Calidad::findOrFail($id);
        $calidad->nombre=$request->get('nombre');
        $calidad->descripcion=$request->get('descripcion');
        $calidad->update();
        return Redirect::to('calidad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $calidad=Calidad::findOrFail($id);
       $calidad->estado="Inactivo";
       $calidad->update();
       return Redirect::to('calidad');
   }


   public function excel()
   {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Calidad Productos', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $calidad = Calidad::select('nombre', 'descripcion')
                ->where('estado', 'Activo')
                ->get();       
                
                
                $sheet->fromArray($calidad);
                $sheet->row(1,['Calidad','Descripcion']);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

}
