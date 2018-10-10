<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;

use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\TipoProvedor;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;
class TipoProvedoresController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
   {

    $tipo_provedor= DB::table('tipo_provedor')->where('estado','Activo')->get();
    return view('Provedores.Tipo_Provedor.index',['tipo_provedor' => $tipo_provedor]);

}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return  view('Provedores.Tipo_Provedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tipoProvedor = new TipoProvedor;
        $tipoProvedor->nombre=$request->get('nombre');
        $tipoProvedor->descripcion=$request->get('descripcion');
        $tipoProvedor->estado='Activo';
        $tipoProvedor->save();
        return Redirect::to('tipoProvedores');
        
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
        $tipo=TipoProvedor::findOrFail($id);
        return view("Provedores.Tipo_Provedor.edit",["tipo"=>$tipo]);
        
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
        $tipoProvedor=TipoProvedor::findOrFail($id);
        $tipoProvedor->nombre=$request->get('nombre');
        $tipoProvedor->descripcion=$request->get('descripcion');
        $tipoProvedor->update();
        return Redirect::to('tipoProvedores');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoProvedor=TipoProvedor::findOrFail($id);
        $tipoProvedor->delete();
        return Redirect::to('tipoProvedores');
    }


    public function excel()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Tipo de Proveedores', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $roles = TipoProvedor::select('nombre', 'descripcion')
                ->where('estado', 'Activo')
                ->get();       
                
                
                $sheet->fromArray($roles);
                $sheet->row(1,['Tipo Proveedor','Descripcion']);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }
}
