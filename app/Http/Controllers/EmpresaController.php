<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Empresa;
use CEPROZAC\Provedor;
use DB;
use Maatwebsite\Excel\Facades\Excel;
class EmpresaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {

      $empresas= DB::table('empresas')
      ->join('provedores as p', 'empresas.provedor_id', '=', 'p.id')
      ->join('regimen_fiscal as r', 'empresas.idRegimenFiscal', '=', 'r.id')
      ->select('empresas.*','p.nombre as nombreProvedor', 'p.apellidos as apellidosProvedor',
        'r.nombre as nombreRegimen')
      ->where('empresas.estado','Activo')->get();
      return view('Provedores.empresas.index', ['empresas' => $empresas]);

  }
  /*

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bancos=DB::table('bancos')->where('estado','=','Activo')->get();
        $provedores=DB::table('provedores')->where('estado','=','Activo')->get();
        $regimenFiscal=DB::table('regimen_fiscal')->where('estado','=','Activo')->get();
        return view("Provedores.empresas.create",["provedores"=>$provedores,"bancos"=>$bancos,'regimenFiscal'=>$regimenFiscal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresa= new Empresa;
        $empresa->nombre=$request->get('nombre');
        $empresa->rfc=$request->get('rfc');
        $empresa->telefono=$request->get('telefono');
        $empresa->direccion=$request->get('direccion');
        $empresa->email=$request->get('email');
        $empresa->estado='Activo';
        $empresa->provedor_id=$request->get('provedor_id');
        $empresa->idRegimenFiscal=$request->get('idRegimenFiscal');
        $empresa->save();
        return Redirect::to('empresas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresas=Empresa::findOrFail($id);
        $provedores=DB::table('provedores')->where('estado','=','Activo')->get();
        $bancos=DB::table('bancos')->where('estado','=','Activo')->get();
        $regimenFiscal=DB::table('regimen_fiscal')->where('estado','=','Activo')->get();
        return view("Provedores.empresas.edit",["provedores"=>$provedores,"empresas"=>$empresas,"bancos"=>$bancos,'regimenFiscal'=>$regimenFiscal]);
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
        $empresas=Empresa::findOrFail($id);
        $empresas->nombre=$request->get('nombre');
        $empresas->rfc=$request->get('rfc');

        $empresas->telefono=$request->get('telefono');
        $empresas->direccion=$request->get('direccion');
        $empresas->email=$request->get('email');
        $empresas->estado='Activo';
        $empresas->provedor_id=$request->get('provedor_id');
        $empresas->idRegimenFiscal=$request->get('idRegimenFiscal');
        $empresas->Update();
        return Redirect::to('empresas');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresas=Empresa::findOrFail($id);
        $empresas->estado="Inactivo";
        $empresas->update();
        return Redirect::to('empresas');
    }


    public function excel()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Lista empresas', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $empresas = Empresa::join('provedores as p', 'empresas.provedor_id', '=', 'p.id')
                ->join('regimen_fiscal','empresas.idRegimenFiscal','=','regimen_fiscal.id')
                ->select('empresas.nombre as nomEmpresa','p.nombre as nombreProvedor','empresas.rfc','regimen_fiscal.nombre as nomRegimen','empresas.telefono as telEmpresa','empresas.direccion','empresas.email')
                ->where('empresas.estado','Activo')->get();     
                

                $sheet->fromArray($empresas);
                $sheet->row(1,['Nombre Empresa','Nombre Proveedor','RFC','Regimen Fiscal','Telefono','Direccion','Correo']);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }


    public  function verCuentas($id)
    {
        $empresas=Empresa::findOrFail($id);
        $cuentas= DB::table('cuentas_banco_provedores')
        ->join('bancos','bancos.id','=','cuentas_banco_provedores.idBanco')
        ->select('cuentas_banco_provedores.*','bancos.nombre as nomBanco')
        ->where('idEmpresa','=',$id)
        ->where('cuentas_banco_provedores.estado','Activo')
        ->get();
        return view('Provedores.empresas.listacuentas',['empresas'=>$empresas,'cuentas'=>$cuentas]);
    }



    public function validarRFC($rfc)
    {

        $empresas= Empresa::
        select('id','rfc','nombre', 'estado')
        ->where('rfc','=',$rfc)
        ->get();

        return response()->json(
          $empresas->toArray());

    }



    public function activar(Request $request)
    { 
        $id =  $request->get('idEmpresa');
        $empresas=Empresa::findOrFail($id);
        $empresas->estado="Activo";
        $empresas->update();
        return Redirect::to('empresas');
    }

}
