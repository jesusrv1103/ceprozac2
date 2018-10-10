<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Provedor;
use CEPROZAC\Empresa;
use DB;
use Maatwebsite\Excel\Facades\Excel;
class ProvedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provedores= DB::table('provedores')->where('estado','Activo')->get();
        
        return view('Provedores.provedores.index', ['provedores' => $provedores]);
        
    }



    public function excel()
    {        

        Excel::create('provedores', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {


                $empresa = Empresa::select('nombre','rfc','direccion','telefono','email')
                ->where('estado', 'Activo')
                ->get();       
                $sheet->fromArray($empresa);

                $sheet->row(1,['Nombre Empresa','RFC','Direccion',
                    'Telefono','Email']);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Provedores.provedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provedor= new Provedor;
        
        $provedor->nombre=$request->get('nombre');
        //echo $request->get('nombre');
        $provedor->apellidos=$request->get('apellidos');

        $provedor->direccion=$request->get('direccion');
        $provedor->telefono=$request->get('telefono');
        $provedor->email=$request->get('email');

        $provedor->estado='Activo';
        $provedor->save();
        return Redirect::to('provedores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("empresas.show",["empresas"=>Empresa::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       return view("Provedores.provedores.edit",["provedores"=>Provedor::findOrFail($id)]);
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
        //$categoria=Categoria::findOrFail($id);
        $provedor=Provedor::findOrFail($id);
        $provedor->nombre=$request->get('nombre');
        $provedor->apellidos=$request->get('apellidos');
        //echo $request->get('nombre');

        $provedor->direccion=$request->get('direccion');
        $provedor->telefono=$request->get('telefono');
        $provedor->email=$request->get('email');

        $provedor->estado='Activo';
        $provedor->update();
        return Redirect::to('provedores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provedores=Provedor::findOrFail($id);
        $provedores->estado="Inactivo";
        $provedores->update();
        return Redirect::to('provedores');
    }


    public function verEmpresas($id)
    {
        $provedor=Provedor::findOrFail($id);
        $empresas= DB::table('empresas')
        ->join('provedores as p', 'empresas.provedor_id', '=', 'p.id')
        ->join('regimen_fiscal as r', 'empresas.idRegimenFiscal', '=', 'r.id')
        ->select('empresas.*','p.nombre as nombreProvedor', 'p.apellidos as apellidosProvedor', 'r.nombre as nomRegimen')
        ->where('empresas.estado','Activo')
        ->where('empresas.provedor_id','=',$id)
        ->get();
        return view("Provedores.provedores.listaEmpresas",['empresas' => $empresas,'provedor'=>$provedor]);       
    }


    public function descargarEmpresas($id,$nombre)
    {
        $nombreExcel ='Lista de Empresas de'.' '.$nombre;
        Excel::create($nombreExcel,function($excel) use ($id) {

            $excel->sheet('Excel sheet', function($sheet) use($id) {

                $mantenimiento = Empresa::join('provedores as p', 'empresas.provedor_id', '=', 'p.id')

                ->join('regimen_fiscal','empresas.idRegimenFiscal','=','regimen_fiscal.id')
                ->select('empresas.nombre','empresas.rfc','regimen_fiscal.nombre as nomRegimen','empresas.telefono','empresas.direccion','empresas.email')
                ->where('empresas.estado','Activo')
                ->where('empresas.provedor_id','=',$id)
                ->get();

                $sheet->fromArray($mantenimiento);
                $sheet->row(1,['Nombre Empresa','RFC','Regimen Fiscal','Telefono','Direccion','Correo']);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');

    }




    public function validarNombre($nombre, $apellidos)
    {

        $provedor= Provedor::
        select('id','nombre','apellidos','direccion', 'estado')
        ->where('nombre','=',$nombre)
        ->where('apellidos','=', $apellidos)
        ->get();

        return response()->json(
          $provedor->toArray());

    }



    public function activar(Request $request)
    { 
        $id =  $request->get('idProvedor');
        $provedores=Provedor::findOrFail($id);
        $provedores->estado="Activo";
        $provedores->update();
        return Redirect::to('provedores');
    }


}
