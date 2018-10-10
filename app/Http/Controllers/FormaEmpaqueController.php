<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;

use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\FormaEmpaque;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class FormaEmpaqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $empaques= DB::table('forma_empaques')->where('estado','Activo')->get();
        return view('Productos.empaques.index',['empaques'=>$empaques]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Productos.empaques.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empaques = new FormaEmpaque;
        $empaques->formaEmpaque=$request->get('formaEmpaque');
        $empaques->descripcion=$request->get('descripcion');
        $empaques->estado='Activo';
        $empaques->save();
        return Redirect::to('empaques');
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

        $empaque=FormaEmpaque::findOrFail($id);  
        return view("Productos.empaques.edit",["empaque"=>$empaque]);
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
        $empaque=FormaEmpaque::findOrFail($id);
        $empaque->formaEmpaque=$request->get('formaEmpaque');
        $empaque->descripcion=$request->get('descripcion'); 
        $empaque->update();
        return Redirect::to('empaques');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empaque=FormaEmpaque::findOrFail($id);
        $empaque->estado="Inactivo";
        $empaque->update();
        return Redirect::to('empaques');
    }

    public function excel()
    {
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Formato de Empaques', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $empaque = FormaEmpaque::select('formaEmpaque', 'descripcion')
                ->where('estado', 'Activo')
                ->get();       
                
                
                $sheet->fromArray($empaque);
                $sheet->row(1,['Forma de Empaque','Descripcion']);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

    
}
