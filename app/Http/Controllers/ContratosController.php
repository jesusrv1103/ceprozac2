<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use CEPROZAC\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use CEPROZAC\Helpers\Convertidor;
use CEPROZAC\Empleado;
use CEPROZAC\Contratos;
use CEPROZAC\EmpresasCeprozac;
use CEPROZAC\EmpleadoRoles;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Carbon\Carbon;



class ContratosController extends Controller
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

      $contratos= DB::table('contratos')
      ->join( 'empleados as e', 'contratos.idEmpleado','=','e.id')
      ->join('empleados', 'empleados.numero_Contrato','=','contratos.id')
      ->join('empresas_ceprozac' ,'contratos.idEmpresa','=','empresas_ceprozac.id')
      ->select('contratos.id as idContrato' ,'contratos.idEmpleado','contratos.id as idContrato' ,'contratos.idEmpleado','contratos.idEmpresa',
        'contratos.fechaInicio','contratos.fechaFin','contratos.duracionContrato','contratos.horas_Descanso','contratos.horas_Alimentacion','e.id as idEm','e.*','e.curp', 'empresas_ceprozac.nombre as nombreEmpresa', 'contratos.estado_Contrato',
        'empresas_ceprozac.representanteLegal')
      ->where('e.tipo','=','CONTRATADO')
      ->where('contratos.estado','Activo')
      ->where('e.estado','Activo')
      ->get();

      return view('Recursos_Humanos.contratos.index', ['contratos' => $contratos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles=DB::table('rol_empleados')->where('estado','=' ,'Activo')->get();
      $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();
      return view("Recursos_Humanos.contratos.create",["roles"=>$roles,"empresas"=>$empresas]);
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
      $empleado= new Empleado;
      $empleado->nombre=$request->get('nombre');
      $empleado->apellidos=$request->get('apellidos');
      $empleado->fecha_Ingreso=$request->get('fecha_Ingreso');
      $empleado->fecha_Alta_Seguro=$request->get('fecha_Alta_Seguro');
      $empleado->numero_Seguro_Social=$request->get('numero_Seguro_Social');
      $empleado->fecha_Nacimiento=$request->get('fecha_Nacimiento');

      $empleado->curp=$request->get('curp');
      $empleado->email=$request->get('email');
      $empleado->telefono=$request->get('telefono');
      $empleado->sueldo_Fijo=$request->get('sueldo_Fijo');
      $empleado->domicilio=$request->get('domicilio');
      $empleado->estado='Activo';
      $empleado->tipo='CONTRATADO';
      substr($_REQUEST['curp'], 10,1) == "H"?$empleado->sexo="Hombre":$empleado->sexo="Mujer";
      $empleado->save();
      $idEmpleado=$empleado->id;
      $contratos= new Contratos;
      $contratos->idEmpleado=$idEmpleado;
      $contratos->idEmpresa=$request->get('idEmpresa');
      $contratos->duracionContrato=$request->get('duracionContrato');
      $contratos->horas_Descanso=8;
      $contratos->horas_Alimentacion=1;
      $contratos->fechaInicio=$request->get('fechaInicio');
      $contratos->fechaFin=$request->get('fechaFin');
      $contratos->duracionContrato=$request->get('duracionContrato');
      $contratos->estado_Contrato='En curso';
      $contratos->estado='Activo';
      $contratos->save();

      $idRol= $request->get('idRol');

      $cont = 0;
      while($cont < count($idRol))
      {
        $roles= new EmpleadoRoles;
        $roles->idEmpleado=$idEmpleado;
        $roles->idRol=$idRol[$cont];
        $cont = $cont+1;
        $roles->save();
      }
      DB::commit();
      return Redirect::to('contratos');
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


      $contrato = Contratos::findOrFail($id);   
      $idEmpleado= $contrato->idEmpleado;
      $idEmpresa=$contrato->idEmpresa;
      $empleado=Empleado::findOrFail($idEmpleado);
      $roles=DB::table('rol_empleados')->where('estado','=' ,'Activo')->get();

      $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();

      $listadoRoles= EmpleadoRoles::join('empleados','empleados.id','=','empleado_roles.idEmpleado')
      ->join('rol_empleados','rol_empleados.id','=','empleado_roles.idRol')
      ->select('empleado_roles.id','rol_empleados.rol_Empleado')
      ->where('idEmpleado','=',$idEmpleado)
      ->get();

      return view("Recursos_Humanos.contratos.edit",["empleado"=>$empleado,"contrato"=>$contrato,"roles"=>$roles
        ,"empresas"=>$empresas,"listadoRoles"=>$listadoRoles]);


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

     $contratos= Contratos::findOrFail($id);
     $contratos->fechaInicio=$request->get('fechaInicio');
     $contratos->fechaFin=$request->get('fechaFin');
     $contratos->duracionContrato=$request->get('duracionContrato');
     $contratos->estado_Contrato='En curso';
     $contratos->estado='Activo';
     $contratos->update();

     $idEmpleado=$contratos->idEmpleado;

     $empleado= Empleado::findOrFail($idEmpleado);
     $empleado->nombre=$request->get('nombre');
     $empleado->apellidos=$request->get('apellidos');
     $empleado->fecha_Ingreso=$request->get('fecha_Ingreso');
     $empleado->fecha_Alta_Seguro=$request->get('fecha_Alta_Seguro');
     $empleado->numero_Seguro_Social=$request->get('numero_Seguro_Social');
     $empleado->fecha_Nacimiento=$request->get('fecha_Nacimiento');
     $empleado->curp=$request->get('curp');
     $empleado->email=$request->get('email');
     $empleado->telefono=$request->get('telefono');
     $empleado->sueldo_Fijo=$request->get('sueldo_Fijo');
     $empleado->domicilio=$request->get('domicilio');
     $empleado->estado='Activo';
     substr($_REQUEST['curp'], 10,1) == "H"?$empleado->sexo="Hombre":$empleado->sexo="Mujer";
     $empleado->update();
     DB::commit();
     return Redirect::to('contratos');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $contratos=Empleado::findOrFail($id);
      $contratos->estado="Inactivo";
      $contratos->update();
      return Redirect::to('contratos');
    }



    
    public function verInformacion($id)
    {

      $contrato = Contratos::findOrFail($id);
      $idEmpleado= $contrato->idEmpleado;
      $idEmpresa=$contrato->idEmpresa;

      $empleado=Empleado::findOrFail($idEmpleado);


      $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();

      $empresa= EmpresasCeprozac::findOrFail($idEmpresa);


      $roles= EmpleadoRoles::join('empleados','empleados.id','=','empleado_roles.idEmpleado')
      ->join('rol_empleados','rol_empleados.id','=','empleado_roles.idRol')
      ->select('rol_empleados.rol_Empleado')
      ->where('idEmpleado','=',$idEmpleado)
      ->get();
      return view("Recursos_Humanos.contratos.lista",["empleado"=>$empleado,"contrato"=>$contrato,"roles"=>$roles
        ,"empresa"=>$empresa,'empresas'=>$empresas]);
    }


    public function rolesEspecificos($id)
    {

      $roles= EmpleadoRoles::join('empleados','empleados.id','=','empleado_roles.idEmpleado')
      ->join('rol_empleados','rol_empleados.id','=','empleado_roles.idRol')
      ->select('rol_empleados.rol_Empleado', 'rol_empleados.descripcion','empleados.id as idET',
        'rol_empleados.id as idRET' ,'empleado_roles.id as idERT')
      ->where('idEmpleado','=',$id)
      ->get();

      return response()->json(
        $roles->toArray());

    }


    public function ultimo()
    {

      $roles= EmpleadoRoles::join('empleados','empleados.id','=','empleado_roles.idEmpleado')
      ->join('rol_empleados','rol_empleados.id','=','empleado_roles.idRol')
      ->select('rol_empleados.rol_Empleado', 'rol_empleados.descripcion','empleados.id as idET',
        'rol_empleados.id as idRET' ,'empleado_roles.id as idERT')
      ->orderBy('empleado_roles.created_at', 'desc')->first();

      return response()->json(
        $roles->toArray());

    }




    


    public function pdf($id)
    {
      $contrato = Contratos::findOrFail($id);
      $idEmpleado= $contrato->idEmpleado;
      $idEmpresa=$contrato->idEmpresa;
      $empleado=Empleado::findOrFail($idEmpleado);
      $empresa= EmpresasCeprozac::findOrFail($idEmpresa);
      $roles= EmpleadoRoles::join('empleados','empleados.id','=','empleado_roles.idEmpleado')
      ->join('rol_empleados','rol_empleados.id','=','empleado_roles.idRol')
      ->select('rol_empleados.rol_Empleado')
      ->where('idEmpleado','=',$id)
      ->get();

      $date = Carbon::now();

      $fecha = $date->format('d-m-Y');

      $pdf=PDF::loadView("Recursos_Humanos.contratos.invoice",["empleado"=>$empleado,"contrato"=>$contrato,"roles"=>$roles
        ,"empresa"=>$empresa,'fecha'=>$fecha]);
      return $pdf->download("archivo.pdf");
    }


    public function liquidacion($id)
    {
      $contrato = Contratos::findOrFail($id);
      $idEmpleado= $contrato->idEmpleado;
      $idEmpresa=$contrato->idEmpresa;
      $empleado=Empleado::findOrFail($idEmpleado);
      $empresa= EmpresasCeprozac::findOrFail($idEmpresa);
      $roles= EmpleadoRoles::join('empleados','empleados.id','=','empleado_roles.idEmpleado')
      ->join('rol_empleados','rol_empleados.id','=','empleado_roles.idRol')
      ->select('rol_empleados.rol_Empleado')
      ->where('idEmpleado','=',$id)
      ->get();

      $date = Carbon::now();

      $fecha = $date->format('d-m-Y');

      $pdf=PDF::loadView("Recursos_Humanos.contratos.liquidacion",["empleado"=>$empleado,"contrato"=>$contrato,"roles"=>$roles
        ,"empresa"=>$empresa,'fecha'=>$fecha]);
      return $pdf->download("liquidacion.pdf");
    }


    static function calcularMes($mes)
    {

      switch ($mes) {
        case 01:
        $mesLetra="ENERO";
        break;
        case 02:
        $mesLetra="FEBRERO";
        break;
        case 03:
        $mesLetra="MARZO";
        break;
        case 04:
        $mesLetra="ABRIL";
        break;
        case 05:
        $mesLetra="MAYO";
        break;
        case 06:
        $mesLetra="JUNIO";
        break;
        case 07:
        $mesLetra="JULIO";
        break;
        case '08':
        $mesLetra="AGOSTO";
        break;
        case '09':
        $mesLetra="SEPTIEMBRE";
        break;
        case '10':
        $mesLetra="OCTUBRE";
        break;
        case '11':
        $mesLetra="NOVIEMBRE";
        break;
        case '12':
        $mesLetra="DICIEMBRE";
        break;
        
      }
      return $mesLetra;
      
    }


    public function calcularFecha($fechaFin){

     $date = Carbon::now();
     $date->format('Y-m-d');

     $dia=substr($fechaFin,0,2);
     $mes=substr($fechaFin, 3,2);
     $ano=substr($fechaFin, 6,7);
     // $fecha =$ano."-".$mes."-".$;
     $dt = Carbon::createMidnightDate($ano, $mes, $dia);
     return $date->diffInDays($dt,false);                        


   }


   static function calcularPesos($sueldo)
   {


    $valor = Convertidor::numtoletras($sueldo);
    return $valor;

//IMPRIME UN MILLON ONCE MIL CIENTO ONCE PESOS 00/100 M.N

  }

  public function excel()
  {        

    Excel::create('Lista contratos', function($excel) {
      $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

        $empleado = Empleado::join('contratos as c', 'empleados.id','=','c.idEmpleado')
        ->select('empleados.nombre', 'empleados.apellidos', 'empleados.fecha_Ingreso', 'empleados.fecha_Alta_Seguro','empleados.numero_Seguro_Social','empleados.curp','empleados.email','empleados.telefono','empleados.sexo','empleados.sueldo_Fijo','c.fechaInicio','c.fechaFin')
        ->where('empleados.estado', 'Activo')
        ->get();       
        $sheet->fromArray($empleado);
        $sheet->row(1,['Nombre ','Apellido','Fecha Ingreso','Fecha Alta Seguro','Numero seguro Social','CURP','Correo','Telefono','Sexo','Sueldo','Fecha Inicio','Fecha Fin']);

        $sheet->setOrientation('landscape');
      });
    })->export('xls');
  }


  public function renovarContrato(Request $request){


    $contratos= new Contratos;
    $contratos->idEmpleado=$request->get('idEmpleado');
    $contratos->idEmpresa=$request->get('idEmpresa');
    $contratos->duracionContrato=$request->get('duracionContrato');
    $contratos->horas_Descanso=8;
    $contratos->horas_Alimentacion=1;
    $contratos->fechaInicio=$request->get('fechaInicio');
    $contratos->fechaFin=$request->get('fechaFin');
    $contratos->duracionContrato=$request->get('duracionContrato');
    $contratos->estado_Contrato='En curso';
    $contratos->estado='Activo';
    $contratos->save();

    $contratos= DB::table('contratos')
    ->join( 'empleados as e', 'contratos.idEmpleado','=','e.id')
    ->join('empleados', 'empleados.numero_Contrato','=','contratos.id')
    ->join('empresas_ceprozac' ,'contratos.idEmpresa','=','empresas_ceprozac.id')
    ->select('contratos.id as idContrato' ,'contratos.idEmpleado','contratos.id as idContrato' ,'contratos.idEmpleado','contratos.idEmpresa',
      'contratos.fechaInicio','contratos.fechaFin','contratos.duracionContrato','contratos.horas_Descanso','contratos.horas_Alimentacion','e.id as idEm','e.*','e.curp', 'empresas_ceprozac.nombre as nombreEmpresa', 'contratos.estado_Contrato',
      'empresas_ceprozac.representanteLegal')
    ->where('e.tipo','=','CONTRATADO')
    ->where('contratos.estado','Activo')
    ->where('e.estado','Activo')
    ->get();


    return view('Recursos_Humanos.contratos.index', ['contratos' => $contratos]);
  }



  public function historial($id){

    $empleado = Empleado::findOrFail($id);
    $historial=DB::table('contratos')
    ->join('empleados','contratos.idEmpleado','=','empleados.id')
    ->join('empresas_ceprozac','empresas_ceprozac.id','=','contratos.idEmpresa')
    ->select('empleados.id as idEmpleado','empleados.nombre', 'empleados.apellidos',
      'empresas_ceprozac.id as idEmpresa','empresas_ceprozac.nombre as nombreEmpresa','contratos.fechaInicio', 'contratos.fechaFin',
      'contratos.duracionContrato', 'contratos.estado_Contrato')
    ->where('empleados.tipo','=','CONTRATADO')
    ->where('contratos.estado','=','Activo')
    ->where('empleados.id','=',$id)
    ->orderBy('contratos.created_at')
    ->get();

    return view('Recursos_Humanos.contratos.historial',['historial'=>$historial,'empleado'=>$empleado]);

  }



  public function actualizarEstado($id){

    $contratos= Contratos::findOrFail($id);
    $contratos->estado_Contrato='Vencido';
    $contratos->update();
  }


  public  function calcularMontoLiquidacion($sueldo,$duracionContrato){

    $parteProporcionalAguinaldo =round(15/360*$sueldo*$duracionContrato,2);

    $parteProporcionalVacaciones=6/365*$sueldo*$duracionContrato;

    $parteProporcionalPrimaVacasiones=$parteProporcionalVacaciones*($duracionContrato/100);
    $primaAntiguedad =12/365*$sueldo*25;

    $total = $parteProporcionalAguinaldo+$parteProporcionalVacaciones+$parteProporcionalPrimaVacasiones+ $primaAntiguedad ;
    return  round($total,2);

  }

}
