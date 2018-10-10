<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;

use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Empresa;
use DB;
use CEPROZAC\Cuentas_Banco_Provedores;
use Maatwebsite\Excel\Facades\Excel;

class Cuentas_Banco_ProvedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function __construct()
    {
      $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function create1($id)
  {
    $empresas=Empresa::findOrFail($id);
    $bancos= DB::table('bancos')->where('estado','Activo')->get();
    return view('Provedores.cuentas_bancos.create',['bancos' => $bancos,'empresas'=>$empresas]);
  }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      DB::beginTransaction();
      $cuentas = new Cuentas_Banco_Provedores;
      $cuentas->idEmpresa=$request->get('idEmpresa');
      $cuentas->idBanco=$request->get('idBanco');
      $cuentas->cve_interbancaria=$request->get('cve_Interbancaria');
      $cuentas->num_cuenta=$request->get('num_cuenta');
      $cuentas->num_cuenta=$request->get('num_cuenta');
      $cuentas->estado='Activo';
      $cuentas->save();
      $id=$cuentas->idEmpresa;
      $empresas=Empresa::findOrFail($id);
      $cuentas= DB::table('cuentas_banco_provedores')
      ->join('bancos','bancos.id','=','cuentas_banco_provedores.idBanco')
      ->select('cuentas_banco_provedores.*','bancos.nombre as nomBanco')
      ->where('idEmpresa','=',$id)
      ->where('cuentas_banco_provedores.estado','Activo')
      ->get();

      DB::commit();
      return view('Provedores.empresas.listacuentas',['empresas'=>$empresas,'cuentas'=>$cuentas]);
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
      $cuentas=Cuentas_Banco_Provedores::findOrFail($id);
      $bancos= DB::table('bancos')->where('estado','Activo')->get();
      return view('Provedores.cuentas_bancos.edit',['bancos' => $bancos,'cuentas'=>$cuentas]);

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
     DB::beginTransaction();
     $cuentas=Cuentas_Banco_Provedores::findOrFail($id);
     $cuentas->idEmpresa=$request->get('idEmpresa');
     $cuentas->idBanco=$request->get('idBanco');
     $cuentas->cve_interbancaria=$request->get('cve_Interbancaria');
     $cuentas->num_cuenta=$request->get('num_cuenta');
     $cuentas->num_cuenta=$request->get('num_cuenta');

     $cuentas->update();
     $id=$cuentas->idEmpresa;
     $empresas=Empresa::findOrFail($id);

     $cuentas= DB::table('cuentas_banco_provedores')
     ->join('bancos','bancos.id','=','cuentas_banco_provedores.idBanco')
     ->select('cuentas_banco_provedores.*','bancos.nombre as nomBanco')
     ->where('idEmpresa','=',$id)
     ->where('cuentas_banco_provedores.estado','Activo')
     ->get();

     DB::commit();
     return view('Provedores.empresas.listacuentas',['empresas'=>$empresas,'cuentas'=>$cuentas]);

   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     DB::beginTransaction();
     $cuentaProvedores=Cuentas_Banco_Provedores::findOrFail($id);
     $cuentaProvedores->estado="Inactivo";
     $cuentaProvedores->update();
     $id=$cuentaProvedores->idEmpresa;
     $empresas=Empresa::findOrFail($id);

     $cuentas= DB::table('cuentas_banco_provedores')
     ->join('bancos','bancos.id','=','cuentas_banco_provedores.idBanco')
     ->select('cuentas_banco_provedores.*','bancos.nombre as nomBanco')
     ->where('idEmpresa','=',$id)
     ->where('cuentas_banco_provedores.estado','Activo')
     ->get();

     DB::commit();
     return view('Provedores.empresas.listacuentas',['empresas'=>$empresas,'cuentas'=>$cuentas]);

   }



   public function descargarCuentas($id,$nombre)
   {

    $nombreExcel ='Lista de cuentas de '.' '.$nombre;
    Excel::create($nombreExcel,function($excel) use ($id) {

      $excel->sheet('Excel sheet', function($sheet) use($id) {

        $cuentas= Cuentas_Banco_Provedores::
        join('bancos','bancos.id','=','cuentas_banco_provedores.idBanco')
        ->select('bancos.nombre as nomBanco','cuentas_banco_provedores.cve_interbancaria','cuentas_banco_provedores.num_cuenta'
          )
        ->where('idEmpresa','=',$id)
        ->where('cuentas_banco_provedores.estado','Activo')
        ->get();
        $sheet->fromArray($cuentas);
        $sheet->row(1,['Banco','Clave Interbancaria','Numero de cuenta' ]);
        $sheet->setOrientation('landscape');
      });
    })->export('xls');

  }


  public function validarNumCuenta_Cve_Interbancaria($num_cuenta_or_cve_interbancaria)
  {

    $cuentas_bancarias= Cuentas_Banco_Provedores::
    select('id','num_cuenta', 'estado','cve_interbancaria')

    ->where('num_cuenta','=',$num_cuenta_or_cve_interbancaria)
    ->orwhere('cve_interbancaria','=',$num_cuenta_or_cve_interbancaria)

    ->get();

    return response()->json(
      $cuentas_bancarias->toArray());

  }



  public function activar(Request $request)
  { 

    $idCuenta =  $request->get('idCuenta');
    $cuentas_bancarias=Cuentas_Banco_Provedores::findOrFail($idCuenta);
    $cuentas_bancarias->estado="Activo";
    $cuentas_bancarias->update();

    $id=$cuentas_bancarias->idEmpresa;
    $empresas=Empresa::findOrFail($id);

    $cuentas= DB::table('cuentas_banco_provedores')
    ->join('bancos','bancos.id','=','cuentas_banco_provedores.idBanco')
    ->select('cuentas_banco_provedores.*','bancos.nombre as nomBanco')
    ->where('idEmpresa','=',$id)
    ->where('cuentas_banco_provedores.estado','Activo')
    ->get();

    DB::commit();
    return view('Provedores.empresas.listacuentas',['empresas'=>$empresas,'cuentas'=>$cuentas]);
  }

}
