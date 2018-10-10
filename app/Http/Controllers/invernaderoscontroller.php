<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use CEPROZAC\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use CEPROZAC\invernaderos;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Validator; 
class invernaderoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
              $invernadero= DB::table('invernaderos')->where('estado','Activo')->get();

      return view('invernaderos.index', ['invernadero' => $invernadero]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invernaderos.create');
        //
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
        $invernadero = new invernaderos;
        $invernadero->nombre=$request->get('nombre');
        $invernadero->ubicacion=$request->get('ubicacion');
        $invernadero->num_modulos=$request->get('modulos');
        $invernadero->estado="Activo";
        $invernadero->save();
         return Redirect::to('invernaderos');
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
        $invernadero = invernaderos::findOrFail($id);
        return view('invernaderos.edit', ['invernadero' => $invernadero]);
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
         $invernadero = invernaderos::findOrFail($id);
                 $invernadero->nombre=$request->get('nombre');
        $invernadero->ubicacion=$request->get('ubicacion');
        $invernadero->num_modulos=$request->get('modulos');
        $invernadero->update();
         return Redirect::to('invernaderos');

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
        $invernadero = invernaderos::findOrFail($id);
        $invernadero->estado="Inactivo";
                $invernadero->update();
         return Redirect::to('invernaderos');
        //
    }

        public function excel()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('invernaderos', function($excel) {
          $excel->sheet('Excel sheet', function($sheet) {
            $invernadero = invernaderos::select('nombre','ubicacion','num_modulos')
            ->where('estado', 'Activo')
            ->get();       
            $sheet->fromArray($invernadero);
            $sheet->row(1,['Nombre del Invernadero','Ubicación','Número de Módulos']);
            $sheet->setOrientation('landscape');
          });
        })->export('xls');
      }
}
