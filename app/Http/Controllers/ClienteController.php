<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Cliente;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use CEPROZAC\Http\Requests\ClienteFormRequest;



/**
use Illuminate\Support\MessageBag;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
*/


class ClienteController extends Controller
{



 public function __construct()
 {
  $this->middleware('guest', ['except' => 'getLogout']);
}
    /**
    use DispatchesJobs, ValidatesRequests;
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cliente= DB::table('cliente')
      ->join('regimen_fiscal','regimen_fiscal.id','=','cliente.id_Regimen_Fiscal')
      ->select('cliente.*','regimen_fiscal.nombre as RegimenFiscal')
      ->where('cliente.estado','Activo')->get();
      return view('clientes.index', ['cliente' => $cliente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $regimen_fiscal = DB::table('regimen_fiscal')->where('estado','=','Activo')->get();
             return view('clientes.create', ['regimen_fiscal'=>$regimen_fiscal]);   //
           }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(ClienteFormRequest $formulario)
    {

/**
                   $cliente= new Cliente;
             $cliente->nombre=$request->get('nombre');
    $cliente->rfc=$request->get('rfc');
    $cliente->fiscal=$request->get('fiscal');
    $cliente->telefono=$request->get('telefono');
    $cliente->email=$request->get('email');
    $cliente->direccion_fact=$request->get('direccion_fact');
    $cliente->direccion_entr=$request->get('direccion_entr');
    $cliente->cantidad_venta=$request->get('cantidad_venta');
    $cliente->volumen_venta=$request->get('volumen_venta');
    $cliente->saldocliente=$request-

     */

    $cliente= new Cliente;
    $validator = Validator::make(
      $formulario->all(), 
      $formulario->rules(),
      $formulario->messages()
      );
    if ($validator->valid()){

      if ($formulario->ajax()){
        return response()->json(["valid" => true], 200);
      }
      else{
      }
    }


    $cliente->nombre=$request->get('nombre');
    $cliente->rfc="hbydtf7tfs7t";
    $cliente->fiscal="fiscal";
    $cliente->telefono="343445445";
    $cliente->email=$request->get('email');
    $cliente->direccion_fact="ppe";
    $cliente->direccion_entr="zacatecas";
    $cliente->cantidad_venta="44";
    $cliente->volumen_venta="kilos";
    $cliente->saldocliente="565";
    $cliente->estado='Activo';

    $cliente->save();
    return Redirect::to('clientesd')->with('message', 'Enhorabuena formulario enviado correctamente');
  }

  public function validarMiFormulario(ClienteFormRequest $formulario ){
    $validator = Validator::make(
      $formulario->all(), 
      $formulario->rules(),
      $formulario->messages());
    if ($validator->valid()){

      if ($formulario->ajax()){
        return response()->json(["valid" => true], 200);
      }
      else{
        $cliente= new Cliente;
        $cliente->nombre=$formulario->get('nombre');
        $cliente->rfc=$formulario->get('rfc');
        $cliente->id_Regimen_Fiscal=$formulario->get('id_Regimen_Fiscal');
        $cliente->telefono=$formulario->get('telefono');
        $cliente->email=$formulario->get('email');
        $cliente->codigo_Postal=$formulario->get('codigo_Postal');
        $cliente->contacto=$formulario->get('contacto');
        $cliente->direccion_fact=$formulario->get('direccion_fact');
        $cliente->direccion_entr=$formulario->get('direccion_entr');
        $cliente->cantidad_venta=$formulario->get('cantidad_venta');
        $cliente->volumen_venta=$formulario->get('volumen_venta');
        $cliente->saldocliente=$formulario->get('saldocliente');
        $cliente->estado='Activo';

        $cliente->save();
        return redirect('clientes')
        ->with('message', 'Cliente Registrado Correctamente');
      }
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     return view("clientes.show",["clientes"=>Cliente::findOrFail($id)]);
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
      $regimenes = DB::table('regimen_fiscal')->where('estado','=','Activo')->get();
      return view("clientes.edit",["clientes"=>Cliente::findOrFail($id), 'regimenes'=>$regimenes]);
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
      $cliente=Cliente::findOrFail($id);

      $cliente->nombre=$request->get('nombre');
      $cliente->rfc=$request->get('rfc');
      $cliente->id_Regimen_Fiscal=$request->get('id_Regimen_Fiscal');
      $cliente->telefono=$request->get('telefono');
      $cliente->email=$request->get('email');
      $cliente->codigo_Postal=$request->get('codigo_Postal');
      $cliente->contacto=$request->get('contacto');
      $cliente->direccion_fact=$request->get('direccion_fact');
      $cliente->direccion_entr=$request->get('direccion_entr');
      $cliente->cantidad_venta=$request->get('cantidad_venta');
      $cliente->volumen_venta=$request->get('volumen_venta');
      $cliente->saldocliente=$request->get('saldocliente');
      $cliente->estado='Activo';
      $cliente->save();
      return Redirect::to('clientes');
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
      $cliente=Cliente::findOrFail($id);
      $cliente->estado='Inactivo';
      $cliente->save();
      return Redirect::to('clientes');
        //
    }

    public function excel()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('clientes', function($excel) {
          $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
            $clientes = Cliente::
            join('regimen_fiscal', 'regimen_fiscal.id','=','cliente.id_Regimen_Fiscal')
            ->select('cliente.nombre','cliente.rfc','cliente.contacto','regimen_fiscal.nombre as  RegimenFiscal', 'cliente.telefono', 'cliente.email','cliente.codigo_Postal', 'cliente.direccion_fact', 'cliente.direccion_entr', 'cantidad_venta','cliente.volumen_venta', 'cliente.email', 'cliente.saldocliente','cliente.codigo_Postal')
            ->where('cliente.estado', 'Activo')
            ->get();       
            $sheet->fromArray($clientes);
            $sheet->row(1,['Nombre','RFC','Contacto', 'Regimen Fiscal' ,'Teléfono','Email','Codigo Postal','Dirección de Facturación','Dirección de Entrega de Embarque','Asignación de Cantidad de Venta por Año',' Asignación de Volumen de Venta por Año','Saldo Cliente $']);
            $sheet->setOrientation('landscape');
            

          });
        })->export('xls');
      }

      public function validarRFC($rfc)
      {

        $cliente= cliente::
        select('id','rfc','nombre', 'estado')
        ->where('rfc','=',$rfc)
        ->get();

        return response()->json(
          $cliente->toArray());

      }



      public function activar(Request $request)
      { 
        $id =  $request->get('idCliente');
        $cliente=cliente::findOrFail($id);
        $cliente->estado="Activo";
        $cliente->update();
        return Redirect::to('clientes');
      }

    }