<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;

use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\EmpresasCeprozac;
use CEPROZAC\CuentasEmpresasCEPROZAC;

use DB;
use Maatwebsite\Excel\Facades\Excel;


class CuentasEmpresasCEPROZACController extends Controller
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
      $cuentas= DB::table('cuentas_empresas_ceprozac')->where('estado','Activo')->get();
      return view('EmpresasCeprozac.cuentasBancarias.index',['cuentas' => $cuentas]);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create1($id)
    {
       $empresas=EmpresasCeprozac::findOrFail($id);
       $bancos= DB::table('bancos')->where('estado','Activo')->get();
       return view('EmpresasCeprozac.cuentasBancarias.create',['bancos' => $bancos,'empresas'=>$empresas]);
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
       $cuentas = new CuentasEmpresasCEPROZAC;
       $cuentas->idEmpresa=$request->get('idEmpresa');
       $cuentas->idBanco=$request->get('idBanco');
       $cuentas->cve_interbancaria=$request->get('cve_Interbancaria');
       $cuentas->num_cuenta=$request->get('num_cuenta');
       $cuentas->num_cuenta=$request->get('num_cuenta');
       $cuentas->saldo=$request->get('saldo');
       $cuentas->estado='Activo';
       $cuentas->save();
       $id=$cuentas->idEmpresa;
       $empresas=EmpresasCeprozac::findOrFail($id);
       $cuentas= DB::table('cuentas_empresas_ceprozac')
       ->join('bancos','bancos.id','=','cuentas_empresas_ceprozac.idBanco')
       ->select('cuentas_empresas_ceprozac.*','bancos.nombre as nomBanco')
       ->where('idEmpresa','=',$id)
       ->where('cuentas_empresas_ceprozac.estado','Activo')
       ->get();
       DB::commit();
       return view('EmpresasCeprozac.empresas.listaCuentas',['empresas'=>$empresas,'cuentas'=>$cuentas]);

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
      $cuentas=CuentasEmpresasCEPROZAC::findOrFail($id);
      $bancos= DB::table('bancos')->where('estado','Activo')->get();
      return view("EmpresasCeprozac.cuentasBancarias.edit",["cuentas"=>$cuentas,"bancos"=>$bancos]);
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
       $cuentas=CuentasEmpresasCEPROZAC::findOrFail($id);
       $cuentas->idEmpresa=$request->get('idEmpresa');
       $cuentas->idBanco=$request->get('idBanco');
       $cuentas->cve_interbancaria=$request->get('cve_Interbancaria');
       $cuentas->num_cuenta=$request->get('num_cuenta');
       $cuentas->num_cuenta=$request->get('num_cuenta');
       $cuentas->saldo=$request->get('saldo');
       $cuentas->update();
       $id=$cuentas->idEmpresa;
       $empresas=EmpresasCeprozac::findOrFail($id);
       $cuentas= DB::table('cuentas_empresas_ceprozac')
       ->join('bancos','bancos.id','=','cuentas_empresas_ceprozac.idBanco')
       ->select('cuentas_empresas_ceprozac.*','bancos.nombre as nomBanco')
       ->where('idEmpresa','=',$id)
       ->where('cuentas_empresas_ceprozac.estado','Activo')
       ->get();
       DB::commit();
       return view('EmpresasCeprozac.empresas.listaCuentas',['empresas'=>$empresas,'cuentas'=>$cuentas]);
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
       $cuentaEmpresa=CuentasEmpresasCEPROZAC::findOrFail($id);
       $cuentaEmpresa->estado="Inactivo";
       $cuentaEmpresa->update();
       $idEmpresa=$cuentaEmpresa->idEmpresa;
       $empresas=EmpresasCeprozac::findOrFail($idEmpresa);
       $cuentas= DB::table('cuentas_empresas_ceprozac')
       ->join('bancos','bancos.id','=','cuentas_empresas_ceprozac.idBanco')
       ->select('cuentas_empresas_ceprozac.*','bancos.nombre as nomBanco')
       ->where('idEmpresa','=',$idEmpresa)
       ->where('cuentas_empresas_ceprozac.estado','Activo')
       ->get();


       DB::commit();

       return view('EmpresasCeprozac.empresas.listaCuentas',['empresas'=>$empresas,'cuentas'=>$cuentas]);
   }


   public function descargarCuentas($id,$nombre)
   {

    $nombreExcel ='Lista de cuentas de '.' '.$nombre;
    Excel::create($nombreExcel,function($excel) use ($id) {

      $excel->sheet('Excel sheet', function($sheet) use($id) {

        $cuentas= CuentasEmpresasCEPROZAC::
        join('bancos','bancos.id','=','cuentas_empresas_ceprozac.idBanco')
        ->select('bancos.nombre as nomBanco','cuentas_empresas_ceprozac.cve_interbancaria','cuentas_empresas_ceprozac.num_cuenta'
          ,'cuentas_empresas_ceprozac.saldo')
        ->where('idEmpresa','=',$id)
        ->where('cuentas_empresas_ceprozac.estado','Activo')
        ->get();
        $sheet->fromArray($cuentas);
        $sheet->row(1,['Banco','Clave Interbancaria','Numero de cuenta','Saldo' ]);
        $sheet->setOrientation('landscape');
    });
  })->export('xls');

}


public function validarNumCuenta_Cve_Interbancaria($num_cuenta_or_cve_interbancaria)
{

    $cuentas_bancarias= CuentasEmpresasCEPROZAC::
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
    $cuentas_bancarias=CuentasEmpresasCEPROZAC::findOrFail($idCuenta);
    $cuentas_bancarias->estado="Activo";
    $cuentas_bancarias->update();

    $id=$cuentas_bancarias->idEmpresa;
    $empresas=EmpresasCeprozac::findOrFail($id);

    $cuentas= DB::table('cuentas_empresas_ceprozac')
    ->join('bancos','bancos.id','=','cuentas_empresas_ceprozac.idBanco')
    ->select('cuentas_empresas_ceprozac.*','bancos.nombre as nomBanco')
    ->where('idEmpresa','=',$id)
    ->where('cuentas_empresas_ceprozac.estado','Activo')
    ->get();

    DB::commit();
    return view('EmpresasCeprozac.empresas.listaCuentas',['empresas'=>$empresas,'cuentas'=>$cuentas]);
}
}


