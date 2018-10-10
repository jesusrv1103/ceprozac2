<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use CEPROZAC\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Provedor;
use CEPROZAC\Producto;
use CEPROZAC\calidad;
use CEPROZAC\Transporte;
use CEPROZAC\EmpresasCeprozac;
use CEPROZAC\ServicioBascula;
use CEPROZAC\Empleado;
use CEPROZAC\bascula;
use CEPROZAC\AlmacenGeneral;
use CEPROZAC\AlmacenAgroquimicos;
use CEPROZAC\fumigaciones;
use CEPROZAC\salidasagroquimicos;
use CEPROZAC\recepcioncompra;
use CEPROZAC\formaempaque;
use CEPROZAC\entradas_almacengeneral;
use CEPROZAC\espacios_almacen;
use CEPROZAC\lote;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;



use DB;
use Validator; 
use PHPExcel_Worksheet_Drawing;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection as Collection;

class RecepcionCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $compra= DB::table('recepcioncompra')
      ->join( 'provedores as prov', 'recepcioncompra.id_provedor','=','prov.id')
      ->join( 'empresas_ceprozac as emp', 'recepcioncompra.recibe','=','emp.id')
      ->join( 'empleados as empleados', 'recepcioncompra.entregado','=','empleados.id')
      ->join('productos as prod' ,'recepcioncompra.id_producto','=','prod.id')
      ->join('calidad as cali' ,'recepcioncompra.id_calidad','=','cali.id')
      ->join('forma_empaques as forma' ,'recepcioncompra.id_empaque','=','forma.id')
      ->join('basculas as bas' ,'recepcioncompra.id_bascula','=','bas.id')
      ->join( 'empleados as emple', 'recepcioncompra.peso','=','emple.id')
      ->join( 'almacengeneral as alma', 'recepcioncompra.ubicacion_act','=','alma.id')
      ->join( 'fumigaciones as fum', 'recepcioncompra.id_fumigacion','=','fum.id')
      ->select('recepcioncompra.*','prov.nombre as nombreprov','emp.nombre as nomempresa','empleados.nombre as nomemple','prod.nombre as nomprod','cali.nombre as nomcali','forma.formaEmpaque as nomforma','bas.nombreBascula as nombas','emple.nombre as nomepleado','alma.nombre as nomalma','fum.id as idfumi','fum.status as fumest')->get();


      return view('compras.recepcion.index', ['compra' => $compra]);

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

      if (empty($almacenagroquimicos) or empty($empleado) or empty($empresas) or empty($provedores) or empty($productos)  or empty($servicio)  or empty($empaque) ){
       return Redirect::to('compras/recepcion');


     }

     return view("compras.recepcion.create",["provedores"=>$provedores,"productos"=>$productos,"transportes"=>$transportes,"servicio"=>$servicio,"empleado"=>$empleado,"empaque"=>$empaque,"calidad"=>$calidad,"almacengeneral"=>$almacengeneral,"almacenagroquimicos"=>$almacenagroquimicos,"empresas"=>$empresas]);
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

           $lote = new lote;
     $lote->id_producto =$request->get('producto');
     $lote->id_calidad =$request->get('calidad'); 
     $lote->id_provedor=$request->get('provedor');
     $lote->nombre_lote=$request->get('codificacion');
     $lote->cantidad_act=$request->get('recibidos');
     $lote->medida="Kilogramos";
      $lote->fecha_entrada= $request->get('fecha');
                 $almacenid = $request->get('almacen');
     $divide=explode("_", $almacenid); 
    $lote->id_almacen=$divide[0]; 
      $lote->num_espacio=$request->get('asignado');
         $lote->observaciones=$request->get('observacionesc');
           $lote->humedad=$request->get('humedad');
            $lote->id_empaque=$request->get('empaque');
             $lote->estado="Activo";
             $lote->codigo =$lote->id_producto.$lote->id_calidad. $lote->id_provedor.$lote->cantidad_act.$lote->nombre_lote.$lote->fecha_entrada;
             $lote->save();


 $fumigacionstatus=$request->get('status');
///si la fumigacion esta en proceso
if($fumigacionstatus == "En Proceso"){ 
        $num = 1;
      $y = 0;
      $limite = $request->get('total');
      $agro = "";
      while ($num <= $limite) {
        //registro de fumigacion
                $fumigacion = new fumigaciones;
      $fumigacion->horai=$request->get('inicio');
      $fumigacion->fechai=$request->get('fechai');
      $fumigacion->fechaf=$request->get('fechaf');
      $fumigacion->horaf=$request->get('final');
      $fumigacion->destino=$request->get('codificacion');
      $fumigacion->plaga_combate=$request->get('plaga');
           $almacenid = $request->get('almacen');
     $divide=explode("_", $almacenid); 
     $fumigacion->id_almacen=$divide[0];  
      $fumigacion->id_producto=$request->get('producto');

      $fumigacion->id_fumigador=$request->get('fumigador');
      $fumigacion->cantidad_aplicada=$request->get('scantidad');
      $fumigacion->status=$request->get('status');
      $fumigacion->observaciones=$request->get('observacionesf');
      $fumigacion->estado="Activo";
      $fumigacion->codigo= $fumigacion->destino."-".$fumigacion->fechai."-FDMP";
      ////salida de almacen
       $producto = $request->get('codigo2');
       $first = head($producto);
       $name = explode(",",$first); 
       $salida = new salidasagroquimicos;
       $idagro = $first = $name[$y];
       $salida->id_material = $idagro;
       $y= $y + 1;
       $nombreaux=$first = $name[$y];
       $agro = $agro.",".$nombreaux;
       $y= $y + 1;
       $descripcionagro= $name[$y];
       $y= $y + 1;
       $cantidadagro = $name[$y];
       $salida->cantidad = $cantidadagro;
       $salida->destino = "Fumigacion de Materia Prima Embarque: ".$request->get('codificacion')." ".$request->get('fechai');
       $salida->recibio = $request->get('nombre_fum');
       $salida->entrego = $request->get('entrego_qui');
       $salida->tipo_movimiento ="Fumigacion de Materia Prima";
       $salida->fecha=$request->get('fechai');
       $salida->estado="Activo";
$salida->save();
       $y= $y + 1;
       $num = $num + 1;
            $fumigacion->agroquimicos=$nombreaux;
     $ultimo = salidasagroquimicos::orderBy('id', 'desc')->first()->id;
     $fumigacion->id_salida=$ultimo;
     $fumigacion->save();
     }
 //si la fumigacion esta pendiente, no hay salida de almacen
   }else{
          $fumigacion = new fumigaciones;
      $fumigacion->horai=$request->get('inicio');
      $fumigacion->fechai=$request->get('fechai');
      $fumigacion->fechaf=$request->get('fechaf');
      $fumigacion->horaf=$request->get('final');
      $fumigacion->destino=$request->get('codificacion');
       $fumigacion->plaga_combate=$request->get('plaga');
           $almacenid = $request->get('almacen');
     $divide=explode("_", $almacenid);
     $fumigacion->id_almacen=$divide[0];  
      $fumigacion->id_producto=$request->get('producto');

      $fumigacion->id_fumigador=$request->get('fumigador');
      $fumigacion->cantidad_aplicada=$request->get('scantidad');
      $fumigacion->status=$request->get('status');
      $fumigacion->observaciones=$request->get('observacionesf');
      $fumigacion->estado="Activo";
      $fumigacion->codigo= $fumigacion->destino.$fumigacion->fechai."FDMP";
     $fumigacion->save();
   }
     

     $ultimo = fumigaciones::orderBy('id', 'desc')->first()->id;
     $material= new recepcioncompra;
    $ultimolote = lote::orderBy('id', 'desc')->first();
     $material->nombre=$request->get('codificacion');
     $material->fecha_compra=$request->get('fecha');
     $material->id_provedor=$request->get('provedor');
     $arreglo = $request->get('transportes2');  
     $cadena_equipo = implode(",", $arreglo);
     $material->transporte=$cadena_equipo;
     $material->num_transportes=$request->get('transporte_num');
     $material->recibe=$request->get('empresa');
     $material->entregado=$request->get('recibe_em');
     $material->observacionesc=$request->get('observacionesc');
     $material->total_compra=$request->get('precio');
     $material->id_producto=$request->get('producto');
     $material->id_calidad=$request->get('calidad');          
     $material->id_empaque=$request->get('empaque');
     $material->humedad=$request->get('humedad');
     $material->pacas=$request->get('num_pacas');
     $material->pacas_rev=$request->get('pacas_rev');
      $material->granel=$request->get('granel');
     $material->observacionesm=$request->get('observacionesm');
     $material->id_bascula=$request->get('bascula');
     $material->ticket=$request->get('numeroticket');

     $material->peso=$request->get('pesaje');
     $material->kg_recibidos=$request->get('recibidos');
     $material->kg_enviados=$request->get('enviados');
     $material->diferencia=$request->get('diferencia');
     $material->observacionesb=$request->get('observacionesb');
     $almacenid = $request->get('almacen');
     $divide=explode("_", $almacenid);
     $material->ubicacion_act=$divide[0];                               
     $material->espacio_asignado=$request->get('asignado');
     $material->observacionesu=$request->get('observacionesu');
     $material->id_fumigacion=$ultimo;
     $material->codigo=$lote->id_producto.$lote->id_calidad. $lote->id_provedor.$lote->cantidad_act.$lote->nombre_lote.$lote->fecha_entrada;
      if ($fumigacionstatus == "En Proceso"){
               $ultimolote->ultima_fumigacion=$request->get('fechai');
               $ultimolote->num_fumigaciones=1;
          }
     $ultimolote->num_fumigaciones="0";
     $ultimolote->id_fumigacion = $ultimo;
     $ultimolote->update();
     $material->save();





     $aux = 0;
     $num=1;
     $h=$material->espacio_asignado;
     $lim= substr_count($h,",");
     $limi = $lim +1;


     while ($num <= $limi) {
       $producto = [$material->espacio_asignado];
       $first = head($producto);
       $name = explode(",",$first); 
       $entrada = new entradas_almacengeneral;
       $entrada->id_almacen = $divide[0];
       //$entrada->id_espacio = $first = $name[$aux]; se elimino este campo
       $entrada->id_lote = $ultimolote->id;
       $entrada->espacio_asignado = $request->get('asignado');
       $idalm = $divide[0];
       $idesp = $first = $name[$aux];
       //$espacio=espacios_almacen::where('id_almacen', $divide[0])->findOrFail($entrada->id_espacio);


       $espacio =  new espacios_almacen;
       $espacio->num_espacio=$idesp;
       $espacio->id_almacen=$idalm;
   
       $aux= $aux+1;
       $entrada->origen= "Recepción de Compra de Materia Prima";
       $entrada->fecha= $request->get('fecha');
       $entrada->kg_entrada= $request->get('recibidos');
        $entrada->medida= "Kilogramos";
       $entrada->id_producto= $request->get('producto');
       $entrada->id_provedor= $request->get('provedor');
       $entrada->entrego= $request->get('recibe_em');
       $entrada->recibe_alm= $request->get('recibe_em');
       $entrada->observacionesc= $request->get('observacionesu');
          $espacio->ocupado =  $entrada->kg_entrada;
          $espacio->id_producto = $entrada->id_producto;
          $espacio->id_provedor = $entrada->id_provedor;
          $espacio->descripcion =  $entrada->observacionesc;
          $espacio->fumigacion_status = $request->get('status');
          if ($espacio->fumigacion_status == "En Proceso"){
          $espacio->ultima_fumigacion = $request->get('fechai');
          }
          $espacio->medida = "Kilogramos";
           $espacio->estado = "Ocupado";
           $espacio->fecha_entrada = $request->get('fecha');
           $espacio->nombre_lote = $request->get('codificacion');
          $espacio->save();
$entrada->save();

//$almacen=almacengeneral::findOrFail($idalm);
          //     $almacen->esp_ocupado=$request->get('ocupado');
      //  $almacen->esp_libre=$request->get('libre'); 
        // $almacen->total_ocupado=$request->get('totalocupado');
          //$almacen->total_libre=$request->get('totallibre');
          //$almacen->update();
       $num = $num + 1;

     }
           
     $ultimoid = recepcioncompra::orderBy('id', 'desc')->first()->id;
    //  $compra= DB::table('recepcioncompra')->orderby('created_at','DESC')->take(1)->get();

      $compra = RecepcionCompra::findOrFail($ultimoid);
      $id_provedor= $compra->id_provedor;
      $recibe= $compra->recibe;
      $entregado= $compra->entregado;
      $producto=$compra->id_producto;
      $calidad=$compra->id_calidad;
      $id_empaque=$compra->id_empaque;
      $id_bascula=$compra->id_bascula;
      $peso=$compra->peso;
      $ubicacion_act=$compra->ubicacion_act;
      $id_fumigacion=$compra->id_fumigacion;


      $provedor=Provedor::findOrFail($id_provedor);
      $emp_recibe=EmpresasCeprozac::findOrFail($recibe);
      $entrega=empleado::findOrFail($entregado);
      $produ=producto::findOrFail($producto);
      $cali=calidad::findOrFail($calidad);
      $empaque=formaempaque::findOrFail($id_empaque);
      $bascula=bascula::findOrFail($id_bascula);
      $pesaje=empleado::findOrFail($peso);
      $ubicacion=almacengeneral::findOrFail($ubicacion_act);
      $fumigacion=fumigaciones::findOrFail($id_fumigacion);
      $id_fumigador=$fumigacion->id_fumigador;
      $fumigador=empleado::findOrFail($id_fumigador);

     return view("Compras.Recepcion.lista",["provedor"=>$provedor,"emp_recibe"=>$emp_recibe,"entrega"=>$entrega,"produ"=>$produ,"cali"=>$cali,"empaque"=>$empaque,"bascula"=>$bascula,"pesaje"=>$pesaje,"ubicacion"=>$ubicacion,"fumigacion"=>$fumigacion,"compra"=>$compra,"fumigador"=>$fumigador]);

   }

   public function invoice($id){ 
    $material= DB::table('recepcioncompra')->where('id',$id)->get();
    $date = date('Y-m-d');
    $invoice = "2222";   
    $view =  \View::make('Compras.Recepcion.invoice', compact('date', 'invoice','material'))->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view);
    return $pdf->stream('invoice');
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

      $compra = RecepcionCompra::findOrFail($id);
      $id_provedor= $compra->id_provedor;
      $recibe= $compra->recibe;
      $entregado= $compra->entregado;
      $producto=$compra->id_producto;
      $calidad=$compra->id_calidad;
      $id_empaque=$compra->id_empaque;
      $id_bascula=$compra->id_bascula;
      $peso=$compra->peso;
      $ubicacion_act=$compra->ubicacion_act;
      $id_fumigacion=$compra->id_fumigacion;


      $provedor=Provedor::findOrFail($id_provedor);
      $emp_recibe=EmpresasCeprozac::findOrFail($recibe);
      $entrega=empleado::findOrFail($entregado);
      $produ=producto::findOrFail($producto);
      $cali=calidad::findOrFail($calidad);
      $empaque=formaempaque::findOrFail($id_empaque);
      $bascula=bascula::findOrFail($id_bascula);
      $pesaje=empleado::findOrFail($peso);
      $ubicacion=almacengeneral::findOrFail($ubicacion_act);
      $fumigacion=fumigaciones::findOrFail($id_fumigacion);
      $id_fumigador=$fumigacion->id_fumigador;
      $fumigador=empleado::findOrFail($id_fumigador);

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


      return view("Compras.Recepcion.edit",["compra"=>$compra,"provedor"=>$provedor,"emp_recibe"=>$emp_recibe,"entrega"=>$entrega,"produ"=>$produ,"cali"=>$cali,"empaque"=>$empaque,"bascula"=>$bascula,"pesaje"=>$pesaje,"ubicacion"=>$ubicacion,"fumigacion"=>$fumigacion,"compra"=>$compra,"fumigador"=>$fumigador],["provedores"=>$provedores,"productos"=>$productos,"transportes"=>$transportes,"servicio"=>$servicio,"empleado"=>$empleado,"empaque"=>$empaque,"calidad"=>$calidad,"almacengeneral"=>$almacengeneral,"almacenagroquimicos"=>$almacenagroquimicos,"empresas"=>$empresas]);
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
      $compra=RecepcionCompra::findOrFail($id);
      $compra->delete();
      return Redirect::to('compras/recepcion');

        //
    }

    public function verInformacion($id)
    {

      $compra = RecepcionCompra::findOrFail($id);
      $id_provedor= $compra->id_provedor;
      $recibe= $compra->recibe;
      $entregado= $compra->entregado;
      $producto=$compra->id_producto;
      $calidad=$compra->id_calidad;
      $id_empaque=$compra->id_empaque;
      $id_bascula=$compra->id_bascula;
      $peso=$compra->peso;
      $ubicacion_act=$compra->ubicacion_act;
      $id_fumigacion=$compra->id_fumigacion;


      $provedor=Provedor::findOrFail($id_provedor);
      $emp_recibe=EmpresasCeprozac::findOrFail($recibe);
      $entrega=empleado::findOrFail($entregado);
      $produ=producto::findOrFail($producto);
      $cali=calidad::findOrFail($calidad);
      $empaque=formaempaque::findOrFail($id_empaque);
      $bascula=bascula::findOrFail($id_bascula);
      $pesaje=empleado::findOrFail($peso);
      $ubicacion=almacengeneral::findOrFail($ubicacion_act);
      $fumigacion=fumigaciones::findOrFail($id_fumigacion);
      $id_fumigador=$fumigacion->id_fumigador;
      $fumigador=empleado::findOrFail($id_fumigador);

      return view("Compras.Recepcion.lista",["provedor"=>$provedor,"emp_recibe"=>$emp_recibe,"entrega"=>$entrega,"produ"=>$produ,"cali"=>$cali,"empaque"=>$empaque,"bascula"=>$bascula,"pesaje"=>$pesaje,"ubicacion"=>$ubicacion,"fumigacion"=>$fumigacion,"compra"=>$compra,"fumigador"=>$fumigador]);
    }

    public function excel()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('recepcioncompra', function($excel) {
          $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
            $compras = RecepcionCompra::join('provedores as prov', 'recepcioncompra.id_provedor','=','prov.id')
            ->join('empresas as emp', 'recepcioncompra.recibe','=','emp.id')
            ->join('empleados as empleados', 'recepcioncompra.entregado','=','empleados.id')
            ->join('productos as prod' ,'recepcioncompra.id_producto','=','prod.id')
            ->join('calidad as cali' ,'recepcioncompra.id_calidad','=','cali.id')
            ->join('forma_empaques as forma' ,'recepcioncompra.id_empaque','=','forma.id')
            ->join('basculas as bas' ,'recepcioncompra.id_bascula','=','bas.id')
            ->join('empleados as emple', 'recepcioncompra.peso','=','emple.id')
            ->join('almacengeneral as alma', 'recepcioncompra.ubicacion_act','=','alma.id')
            ->join('fumigaciones as fum', 'recepcioncompra.id_fumigacion','=','fum.id')
            ->select('recepcioncompra.id','recepcioncompra.nombre','recepcioncompra.fecha_compra','prov.nombre as provnombre','recepcioncompra.transporte','recepcioncompra.num_transportes','emp.nombre as empnombre','empleados.nombre as emplnombre','recepcioncompra.observacionesc','recepcioncompra.total_compra','prod.nombre as prodnombre','cali.nombre as calinombre','forma.formaEmpaque','recepcioncompra.humedad','recepcioncompra.pacas','recepcioncompra.pacas_rev','recepcioncompra.observacionesm','bas.nombreBascula','recepcioncompra.ticket','emple.nombre as empleenombre','recepcioncompra.kg_recibidos','recepcioncompra.kg_enviados','recepcioncompra.diferencia','recepcioncompra.observacionesb','alma.nombre as almanombre','recepcioncompra.espacio_asignado','recepcioncompra.observacionesu','fum.id as fumid')->get();
            $sheet->fromArray($compras);
            $sheet->row(1,['N° Compra','Nombre de Lote','Fecha de Compra' ,'Provedor','Transporte/Placas','N°Transportes','Empresa','Recibe Empleado','Observaciónes de Compra','Precio Total de Compra','Producto' ,'Calidad','Empaque','%Humedad','Total de Pacas','Pacas a Revisar','Observaciónes de Muestreo','Bascula','Ticket' ,'Realizo Pesaje','KG recibidos','KG Enviados','Diferencia','Observaciones Pesaje','Ubicación Actual','Espacio Asignado','Observaciones' ,'N° Fumigación']);
            $sheet->setOrientation('landscape');
          });
        })->export('xls');
      }
    }
