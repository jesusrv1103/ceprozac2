<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use CEPROZAC\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Provedor;
use CEPROZAC\Producto;
use CEPROZAC\Transporte;
use CEPROZAC\ServicioBascula;
use CEPROZAC\RecepcionCompra;
use CEPROZAC\Empleado;
use CEPROZAC\Bascula;
use CEPROZAC\fumigaciones;
use CEPROZAC\AlmacenGeneral;
use CEPROZAC\almacenagroquimicos;
use CEPROZAC\salidasagroquimicos;
use CEPROZAC\lote;

use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

use Carbon\Carbon;

use DB;
use Validator; 
use PHPExcel_Worksheet_Drawing;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection as Collection;



class fumigacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       $fumigaciones= DB::table('fumigaciones')->where('fumigaciones.estado','=','Activo')
       ->join('empleados as a', 'fumigaciones.id_fumigador', '=', 'a.id')
       ->join('productos as p', 'fumigaciones.id_producto', '=', 'p.id')
       ->join('almacengeneral as alm', 'fumigaciones.id_almacen', '=', 'alm.id')
       //->join('salidasagroquimicos as sal', 'fumigaciones.id_salida', '=', 'sal.id')
       ->select('fumigaciones.*','a.nombre as nomfum', 'a.apellidos as apellidos', 'p.nombre as produnom','alm.nombre as almnom')->get();
       return view('fumigaciones.index', ['fumigaciones' => $fumigaciones]);



        //
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $empleado=DB::table('empleados')->where('estado','=' ,'Activo')->get();
      $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();
      $provedores=DB::table('provedores')->where('estado','=' ,'Activo')->get();
      $productos=DB::table('productos')->where('estado','=' ,'Activo')->get();
      $transportes=DB::table('transportes')->where('estado','=' ,'Activo')->get();
      $servicio=DB::table('basculas')->where('estado','=' ,'Activo')->get();
      $empaque=DB::table('forma_empaques')->where('estado','=' ,'Activo')->get();
      $calidad=DB::table('calidad')->where('estado','=' ,'Activo')->get();
      $almacengeneral=DB::table('almacengeneral')->where('estado','=' ,'Activo')->orwhere('total_libre','>','0')->get();
      $almacenagroquimicos=DB::table('almacenagroquimicos')->where('estado','=' ,'Activo')->orwhere('cantidad','>','0')->get();
      $espacio=DB::table('lote')->where('nombre_lote','<>','')->join('almacengeneral as alm', 'lote.id_almacen', '=', 'alm.id') ->select('lote.*','alm.nombre as almnom')->get();

      if (empty($almacenagroquimicos) or empty($empleado) or empty($empresas) or empty($provedores) or empty($productos)  or empty($servicio)  or empty($empaque) ){
         return Redirect::to('fumigaciones');


     }

     return view("fumigaciones.create",["provedores"=>$provedores,"productos"=>$productos,"transportes"=>$transportes,"servicio"=>$servicio,"empleado"=>$empleado,"empaque"=>$empaque,"calidad"=>$calidad,"almacengeneral"=>$almacengeneral,"almacenagroquimicos"=>$almacenagroquimicos,"empresas"=>$empresas,'espacio'=>$espacio]);

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
     $num = 1;
     $y = 0;
     $limite = $request->get('total');
     $agro = "";

          $fumigacion = new fumigaciones;
     $fumigacion->horai=$request->get('inicio');
     $fumigacion->fechai=$request->get('fechai');
     $fumigacion->fechaf=$request->get('fechaf');
     $fumigacion->horaf=$request->get('final');


     $lotes= $request->get('lote');
     $div=explode("_", $lotes);
     $fumigacion->id_almacen=$div[0]; 
     $fumigacion->destino=$div[1]; 
     $fumigacion->id_producto=$div[2]; 

     $fumigacion->id_fumigador=$request->get('fumigador');
     $fumigacion->cantidad_aplicada=$request->get('scantidad');
     $fumigacion->status=$request->get('status');
     $fumigacion->observaciones=$request->get('observacionesf');
     $fumigacion->estado="Activo";
     $fumigacion->codigo= $fumigacion->destino.$fumigacion->fechai."FDP";
     $fumigacion->agroquimicos=$agro;

          while ($num <= $limite) {
         $producto = $request->get('codigo2');
         $first = head($producto);
         $name = explode(",",$first); 
         $salida = new salidasagroquimicos;
         $idagro = $first = $name[$y];
         $salida->id_material = $idagro;
         $y= $y+1;
         $agro = $agro." ".$first = $name[$y];
         $y= $y + 1;
         $descripcionagro= $name[$y];
         $y= $y + 1;
         $cantidadagro = $name[$y];
         $salida->cantidad = $cantidadagro;
         $salida->destino = "Fumigacion de Producto: ".$fumigacion->destino." ".$request->get('fechai');
         $salida->recibio = $request->get('nombre_fum');
         $salida->entrego = $request->get('entrego_qui'); 
         $salida->tipo_movimiento ="Fumigacion de Materia Prima";
         $salida->fecha=$request->get('fechai');
         $salida->estado="Activo";
         $salida->save();
         $y= $y + 1;
         $num = $num + 1;
                $ultimo = salidasagroquimicos::orderBy('id', 'desc')->first()->id;
     $fumigacion->id_salida=$ultimo;

     $fumigacion->save();

     }

     return Redirect::to('fumigaciones');
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
 $fumigaciones = fumigaciones::findOrFail($id);
 $idalm= $fumigaciones->id_almacen;
 $idpro= $fumigaciones->id_producto;
  $idsal = $fumigaciones->id_salida;
 $empleado=DB::table('empleados')->where('estado','=' ,'Activo')->get();
  $produ=DB::table('productos')->where('estado','=' ,'Activo')->get();
 $almacenagroquimicos=DB::table('almacenagroquimicos')->where('estado','=' ,'Activo')->orwhere('cantidad','>','0')->get();
 $ubicacion=almacengeneral::findOrFail($idalm);
 $salida=salidasagroquimicos::findOrFail($idsal);
  $mat=almacenagroquimicos::findOrFail($salida->id_material);


 return view('fumigaciones.edit', ['fumigaciones' => $fumigaciones,'empleado' => $empleado,'produ'=> $produ,'ubicacion'=>$ubicacion,'almacenagroquimicos'=>$almacenagroquimicos,'salida'=>$salida,'mat'=>$mat]);
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
            $fumigacion = fumigaciones::findOrFail($id);
            ///resta el stock actual al almacen de agroquimicos
            
 
            /////
            //actualiza el nuevo stock

 $num = 1;
 $y = 0;
 $limite = $request->get('total');
 $agro = "";


 $valida=$request->get('edit');
 
 if ($valida == 1){
 while ($num <= $limite) {
     $producto = $request->get('codigo2');
     $first = head($producto);
     $name = explode(",",$first); 
      $salida = salidasagroquimicos::findOrFail($fumigacion->id_salida);
      $materialaux = almacenagroquimicos::findOrFail($salida->id_material);
      $materialaux->cantidad= $materialaux->cantidad + $salida->cantidad;
      $materialaux->update();

     $idagro = $first = $name[$y];
     $salida->id_material = $idagro;
     $materialnuevo = almacenagroquimicos::findOrFail($salida->id_material);
     $y= $y+1;
     $agro = $agro." ".$first = $name[$y];
     $y= $y + 1;
     $descripcionagro= $name[$y];
     $y= $y + 1;
     $cantidadagro = $name[$y];
     $salida->cantidad = $cantidadagro;
     $materialnuevo->cantidad= $materialnuevo->cantidad - $salida->cantidad;
    
     $salida->destino = "Fumigacion de Producto: ".$fumigacion->destino." ".$request->get('fechai');
     $salida->recibio = $request->get('fumigador');
     $salida->entrego = $request->get('entrego_qui');
     $salida->tipo_movimiento ="Fumigacion de Materia Prima";
     $salida->fecha=$request->get('fechai');
     $salida->update();
     $materialnuevo->update();
     

     $y= $y + 1;
     $num = $num + 1;
 }}else{
     while ($num <= $limite) {
        if ($fumigacion->cantidad_aplicada > 0){
                  $salida = salidasagroquimicos::findOrFail($fumigacion->id_salida);
      $materialaux = almacenagroquimicos::findOrFail($salida->id_material);
      $materialaux->cantidad= $materialaux->cantidad + $salida->cantidad;
      $materialaux->update();


        }
     $producto = $request->get('codigo2');
     $first = head($producto);
     $name = explode(",",$first); 
     $salida = new salidasagroquimicos;
     $idagro = $first = $name[$y];
     $salida->id_material = $idagro;
     $y= $y+1;
     $agro = $agro." ".$first = $name[$y];
     $y= $y + 1;
     $descripcionagro= $name[$y];
     $y= $y + 1;
     $cantidadagro = $name[$y];
     $salida->cantidad = $cantidadagro;
     $salida->destino = "Fumigacion de Producto: ".$fumigacion->destino." ".$request->get('fechai');
     $salida->recibio = $request->get('fumigador');
     $salida->entrego = $request->get('entrego_qui');
     $salida->tipo_movimiento ="Fumigacion de Materia Prima";
     $salida->fecha=$request->get('fechai');
     $salida->save();
     $y= $y + 1;
     $num = $num + 1;
 }
    $ultimo = salidasagroquimicos::orderBy('id', 'desc')->first()->id;
     $fumigacion->id_salida=$ultimo;
 }
 $fumigacion->agroquimicos=$agro;
  $fumigacion->horai=$request->get('inicio');
 $fumigacion->fechai=$request->get('fechai');
 $fumigacion->fechaf=$request->get('fechaf');
 $fumigacion->horaf=$request->get('final');



 $fumigacion->id_fumigador=$request->get('fumigador');
 $fumigacion->cantidad_aplicada=$request->get('scantidad');
 $fumigacion->status=$request->get('status');
 $fumigacion->observaciones=$request->get('observacionesf');
 $fumigacion->estado="Activo";
 $fumigacion->codigo= $fumigacion->destino.$fumigacion->fechai."FDP";

 $fumigacion->update();
 $loteid=DB::table('lote')->where('id_fumigacion','=' ,$id)->first()->id;
 $lot = lote::findOrFail($loteid);
 $lot->num_fumigaciones =$lot->num_fumigaciones + 1;
 $lot->ultima_fumigacion=$request->get('fechai');
 $lot->update();
 return Redirect::to('fumigaciones');
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
      $fumigacion=fumigaciones::findOrFail($id);
      $fumigacion->estado='Inactivo';
      $fumigacion->save();
      return Redirect::to('fumigaciones');
        //
  }

  public function verInformacion($id)
  {



     $fumigaciones = fumigaciones::findOrFail($id);
     $idempleado= $fumigaciones->id_fumigador;
     $idalm= $fumigaciones->id_almacen;
     $idpro= $fumigaciones->id_producto;
     $empleado=empleado::findOrFail($idempleado);
     $produ=producto::findOrFail($idpro);
     $ubicacion=almacengeneral::findOrFail($idalm);

     return view('fumigaciones.lista', ['fumigaciones' => $fumigaciones,'empleado' => $empleado,'produ'=> $produ,'ubicacion'=>$ubicacion]);
 }

 public function invoice($id){ 
    $material= DB::table('fumigaciones')->where('id',$id)->get();
    $fumigaciones = fumigaciones::findOrFail($id);
    $idemp=$fumigaciones->id_fumigador;
    $empleado= DB::table('empleados')->where('id',$idemp)->get();

    $date = date('Y-m-d');
    $invoice = "2222";   
    $view =  \View::make('Fumigaciones.invoice', compact('date', 'invoice','fumigaciones','empleado'))->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view);
    return $pdf->stream('invoice');
}


public function registrar($id)
{
 $fumigaciones = fumigaciones::findOrFail($id);
 $idalm= $fumigaciones->id_almacen;
 $idpro= $fumigaciones->id_producto;
 $empleado=DB::table('empleados')->where('estado','=' ,'Activo')->get();
 $almacenagroquimicos=DB::table('almacenagroquimicos')->where('estado','=' ,'Activo')->orwhere('cantidad','>','0')->get();
 $produ=producto::findOrFail($idpro);
 $ubicacion=almacengeneral::findOrFail($idalm);

 return view('fumigaciones.registra', ['fumigaciones' => $fumigaciones,'empleado' => $empleado,'produ'=> $produ,'ubicacion'=>$ubicacion,'almacenagroquimicos'=>$almacenagroquimicos]);
}






}
