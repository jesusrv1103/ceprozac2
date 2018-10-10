<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Requests\entradasalmacenlimpiezaRequest;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\entradasalmacenlimpieza;
use CEPROZAC\Empleado;
use CEPROZAC\almacenlimpieza;
use CEPROZAC\ProvedorMateriales;
use CEPROZAC\empresas_ceprozac;
use CEPROZAC\cantidad_unidades_limp;
use CEPROZAC\unidadesmedida;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Collection as Collection; 
class entradasalmacenlimpiezaController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
     $entrada= DB::table('entradasalmacenlimpieza')->where('entradasalmacenlimpieza.estado','=','Activo')
     ->join('almacenlimpieza as a', 'entradasalmacenlimpieza.id_material', '=', 'a.id')
     ->join('empresas_ceprozac as e', 'entradasalmacenlimpieza.comprador', '=', 'e.id')
     ->join('provedor_materiales as prov', 'entradasalmacenlimpieza.provedor', '=', 'prov.id')

     ->select('entradasalmacenlimpieza.*','a.nombre as nombremat','entradasalmacenlimpieza.*','a.medida','e.nombre as emp','prov.nombre as prov')->get();
        // print_r($salida);
     return view('almacen.limpieza.entradas.index', ['entrada' => $entrada]);

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
        $provedor = DB::table('provedores_tipo_provedor')
        ->join('provedor_materiales as p', 'provedores_tipo_provedor.idProvedorMaterial', '=', 'p.id')
        ->select('p.*','p.nombre as nombre')
        ->where('provedores_tipo_provedor.idTipoProvedor','3')->get();
        $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();
        $material=DB::table('almacenlimpieza')->where('estado','=' ,'Activo')->where('cantidad','>=','0')->get();
        $unidades= DB::table('unidadesmedida')->where('estado','Activo')->get();

        $cuenta = count($material);
        

        if (empty($material)){
           $entrada= DB::table('entradasalmacenlimpieza')
           ->join('almacenlimpieza as a', 'entradasalmacenlimpieza.id_material', '=', 'a.id')
           ->select('entradasalmacenlimpieza.*','a.nombre as nombremat','entradasalmacenlimpieza.*','a.medida')->get();
           return view('almacen.limpieza.entradas.index', ['entrada' => $entrada]); 
         // return view("almacen.materiales.salidas.create")->with('message', 'No Hay Material Registrado, Favor de Dar de Alta Material Para Poder Acceder a Este Modulo');
       }else if (empty($empleado)) {
          $entrada= DB::table('entradasalmacenlimpieza')
          ->join('almacenlimpieza as a', 'entradasalmacenlimpieza.id_material', '=', 'a.id')
          ->select('entradasalmacenlimpieza.*','a.nombre as nombremat','entradasalmacenlimpieza.*','a.medida')->get();
          return view('almacen.limpieza.entradas.index', ['entrada' => $entrada]);

      }else if (empty($provedor)){
          $entrada= DB::table('entradasalmacenlimpieza')
          ->join('almacenlimpieza as a', 'entradasalmacenlimpieza.id_material', '=', 'a.id')
          ->select('entradasalmacenlimpieza.*','a.nombre as nombremat','entradasalmacenlimpieza.*','a.medida')->get();
          return view('almacen.limpieza.entradas.index', ['entrada' => $entrada]);

      }
      else{
         return view("almacen.limpieza.entradas.create",["material"=>$material,"provedor"=>$provedor],["empleado"=>$empleado,"empresas"=>$empresas,'unidades'=>$unidades]);
     }
        //
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(entradasalmacenlimpiezaRequest $formulario)
    {
       $cantidad = $formulario->get('cantidad2');


       if ($cantidad > 0){
          $validator = Validator::make(
            $formulario->all(), 
            $formulario->rules(),
            $formulario->messages());
          if ($validator->valid()){

            if ($formulario->ajax()){
                return response()->json(["valid" => true], 200);
            }
            else{
              $material= new almacenlimpieza;

              $material->nombre=$formulario->get('nombre2');
              $material->provedor=$formulario->get('provedor_id2');


        if (Input::hasFile('imagen')){ //validar la imagen, si (llamanos clase input y la funcion hash_file(si tiene algun archivo))
            $file=Input::file('imagen');//si pasa la condicion almacena la imagen
            $file->move(public_path().'/imagenes/almacenlimpieza',$file->getClientOriginalName());//lo movemos a esta ruta                        
            $material->imagen=$file->getClientOriginalName();
        }
        $material->descripcion=$formulario->get('descripcion2');
        $material->cantidad="0";
        $material->medida=$formulario->get('medida');
        $material->codigo=$formulario->get('codigo');
        $material->estado='Activo';
        $material->save();
        
    }
}

$ultimo = almacenlimpieza::orderBy('id', 'desc')->first()->id;
$ex = $formulario->get('provedor_id2');
$materiales = DB::table('provedor_materiales')
->select('provedor_materiales.nombre')
->where('provedor_materiales.id',$ex)->get();

$provedornombre = $materiales[0]->nombre;
$material2= new entradasalmacenlimpieza;
$material2->id_material=$ultimo;
$material2->cantidad=$formulario->get('cantidad2');
$material2->provedor=$provedornombre;
$material2->comprador=$formulario->get('recibio2');
$material2->entregado=$formulario->get('entregado_a');
$material2->recibe_alm=$formulario->get('recibe_alm');
$material2->observacionesc=$formulario->get('observacionesl');
$material2->factura=$formulario->get('factura2');
$material2->fecha=$formulario->get('fecha2');
$material2->p_unitario=$formulario->get('preciou2');
$material2->total= $material2->p_unitario *  $material2->cantidad;
$material2->importe= $material2->p_unitario *  $material2->cantidad;
$material2->save();

$material= DB::table('almacenlimpieza')->orderby('created_at','DESC')->take(1)->get();
$date = date('Y-m-d');
$invoice = "2222";
$view =  \View::make('almacen.limpieza.invoice', compact('date', 'invoice','material'))->render();
$pdf = \App::make('dompdf.wrapper');
$pdf->loadHTML($view);
return $pdf->stream('invoice');
           //return Redirect::to('almacen/entradas/agroquimicos');


           // print_r($cantidad);
}else{
    $num = 1;
    $y = 0;
    $limite = $formulario->get('total');
   //print_r($limite);

    while ($num <= $limite) {
        $material= new entradasalmacenlimpieza; 
        $unidad = new cantidad_unidades_limp;
            //print_r($num);
        $producto = $formulario->get('codigo2');
        $first = head($producto);
        $name = explode(",",$first);
        print_r($producto);
            //$first = $name[0];
             //$first = $name[1];
        
        $material->id_material=$first = $name[$y];
        $prod=$first = $name[$y];
        $unidad->idProducto=$first = $name[$y];
        $y = $y + 2;
        $aux =$first = $name[$y];
        $unidad->cantidad=$first = $name[$y];
        //$material->cantidad=$first = $name[$y];
        $y = $y + 1;        
        $aux2 =$first = $name[$y];
        $medida2= unidadesmedida::where('nombre','=',$aux2)->first()->id;
        ///si ya exixste//
        $comprueba2= DB::table('cantidad_unidades_limp')->where('idMedida','=',$medida2)->where('idProducto','=',$prod)->get();
        $r=count($comprueba2);
        if ($r > 0){
          $unidadaux=cantidad_unidades_limp::where('idProducto','=',$prod)->where('idMedida','=',$medida2)->first()->id;
          $unidad2=cantidad_unidades_limp::findOrFail($unidadaux);
          $unidad2->cantidad=$unidad2->cantidad + $aux;
      }
      $unidad->idMedida=$medida2;

      $concat = $aux." ".$aux2;
      $y = $y + 1;
      $yy =$first = $name[$y]; 
      $producto2 = $yy;
      $name2 = explode(" ",$producto2);
      $material->cantidad= $name2[0];

      $material->medida= $name2[1];
      $material->medidaaux=$concat;
            // print_r($first = $name[$y]); 
             //print_r($first = $name[$y]);
      $y = $y + 1;
      $material->factura=$first = $name[$y];
      $y = $y + 1;
             //print_r($first = $name[$y]);
      $material->fecha=$first = $name[$y];
      $y = $y + 1;
            // print_r($first = $name[$y]);
      $material->p_unitario=$first = $name[$y];
      $y = $y + 1;
      $material->iva=$first = $name[$y];
      $y = $y + 1;
      $material->total=$first = $name[$y];
      $material->importe=$first = $name[$y];
      $y = $y + 1;
      $material->moneda=$first = $name[$y];
      $y = $y + 1;
      $material->estado="Activo";
      $unidad->estado="Activo";
      $material->provedor=$formulario->get('prov');
      $material->comprador=$formulario->get('recibio');
      $material->entregado=$formulario->get('entregado_a');
      $material->recibe_alm=$formulario->get('recibe_alm');
      $material->observacionesc=$formulario->get('observacionesl');
      $material->save();
        if ($r > 0){
       $unidad2->update();
     }else{
       $unidad->save();
     }
      $num = $num + 1;
        //
  }
  return redirect('/almacen/entradas/limpieza');
}
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
        $unidades= DB::table('unidadesmedida')->where('estado','Activo')->get();
        $entradas=DB::table('entradasalmacenlimpieza')->where('factura','=',$id)->get();
        $entrada = entradasalmacenlimpieza::findOrFail($entradas[0]->id);
        $fac=$entrada->factura;
        $empleado=DB::table('empleados')->where('estado','=' ,'Activo')->get();
        $entradas=DB::table('entradasalmacenlimpieza')->where('factura','=',$fac)
        ->join('almacenlimpieza as a', 'entradasalmacenlimpieza.id_material', '=', 'a.id')
        ->select('entradasalmacenlimpieza.*','a.nombre as nombremat','a.id as idagro')->get();


        $material=DB::table('almacenlimpieza')->where('estado','=' ,'Activo')->where('cantidad','>=','0')->get();
        $provedor = DB::table('provedores_tipo_provedor')
        ->join('provedor_materiales as p', 'provedores_tipo_provedor.idProvedorMaterial', '=', 'p.id')
        ->select('p.*','p.nombre as nombre')
        ->where('provedores_tipo_provedor.idTipoProvedor','3')->get();
        $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();
        // 
        return view('almacen.limpieza.entradas.edit', ['entrada' => $entrada,'empleado' => $empleado,'entradas'=> $entradas,'material'=>$material,'provedor'=>$provedor,'empresas'=>$empresas,'unidades'=>$unidades]);
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
       $entrada = entradasalmacenlimpieza::findOrFail($id);
       $fac=$entrada->factura;
       $empleado=DB::table('empleados')->where('estado','=' ,'Activo')->get();
       $entradas=DB::table('entradasalmacenlimpieza')->where('factura','=',$fac)
       ->join('almacenlimpieza as a', 'entradasalmacenlimpieza.id_material', '=', 'a.id')
       ->select('entradasalmacenlimpieza.*','a.nombre as nombremat','a.id as idagro')->get();


       $material=DB::table('almacenlimpieza')->where('estado','=' ,'Activo')->where('cantidad','>=','0')->get();
       $provedor = DB::table('provedores_tipo_provedor')
       ->join('provedor_materiales as p', 'provedores_tipo_provedor.idProvedorMaterial', '=', 'p.id')
       ->select('p.*','p.nombre as nombre')
       ->where('provedores_tipo_provedor.idTipoProvedor','3')->get();
       $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();
       $unidades= DB::table('unidadesmedida')->where('estado','Activo')->get();
        // 
       return view('almacen.limpieza.entradas.edit', ['entrada' => $entrada,'empleado' => $empleado,'entradas'=> $entradas,'material'=>$material,'provedor'=>$provedor,'empresas'=>$empresas,'unidades'=>$unidades]);
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
     $entrada = entradasalmacenlimpieza::findOrFail($id);
     $fac=$entrada->factura;
     $entradas=DB::table('entradasalmacenlimpieza')->where('factura','=',$fac)->get();
     $cuenta = count($entradas);

     for ($x=0; $x < $cuenta  ; $x++) {
      $elimina = entradasalmacenlimpieza::findOrFail($entradas[$x]->id);
      $decrementa=almacenlimpieza::findOrFail($elimina->id_material);
      $decrementa->cantidad=$decrementa->cantidad- $elimina->cantidad;
      $v= [$elimina->medidaaux];
        $first = head($v);
        $name = explode(" ",$first);
        $z = count($name);
        $a="";
        for ($i=0; $i < $z; $i++) { 
          if ($i == 1) {
           $a=$name[$i];             
            # code...
         }else if($i > 1) {
          $a=$a." ".$name[$i];
        }else{
          $r=$name[0];
        }
          # code...
      }
//print_r($e[0]);
      $medida2= unidadesmedida::where('nombre','=',$a)->first()->id;
      $unidadaux=cantidad_unidades_limp::where('idProducto','=',$decrementa->id)->where('idMedida','=',$medida2)->first()->id;
      $unidad=cantidad_unidades_limp::findOrFail($unidadaux);
      $unidad->cantidad=$unidad->cantidad - $r;
      $decrementa->update();
      $elimina->delete();
            $unidad->update();
        # code...
  }
     // $salidas->delete();
  $num = 1;
  $y = 0;
  $limite = $request->get('total');

  while ($num <= $limite) { 
    $material= new entradasalmacenlimpieza;
          $unidad = new cantidad_unidades_limp;

    $producto = $request->get('codigo2');
    $first = head($producto);
    $name = explode(",",$first);
            //$first = $name[0];
             //$first = $name[1];

    $material->id_material=$first = $name[$y];
          $prod=$first = $name[$y];
      $unidad->idProducto=$first = $name[$y];
    $y = $y + 2;
    $aux =$first = $name[$y];
          $unidad->cantidad=$first = $name[$y];
        //$material->cantidad=$first = $name[$y];
    $y = $y + 1;
    $aux2 =$first = $name[$y];
      $medida2= unidadesmedida::where('nombre','=',$aux2)->first()->id;

      //si ya existe//

        $comprueba2= DB::table('cantidad_unidades_limp')->where('idMedida','=',$medida2)->where('idProducto','=',$prod)->get();
        $r=count($comprueba2);
        if ($r > 0){
          $unidadaux=cantidad_unidades_limp::where('idProducto','=',$prod)->where('idMedida','=',$medida2)->first()->id;
          $unidad2=cantidad_unidades_limp::findOrFail($unidadaux);
          $unidad2->cantidad=$unidad2->cantidad + $aux;
        }
 

      $unidad->idMedida=$medida2;
    $concat = $aux." ".$aux2;
    $y = $y + 1;
    $yy =$first = $name[$y];
    $producto2 = $yy;
    $name2 = explode(" ",$producto2);
    $material->cantidad= $name2[0];
    $material->medida= $name2[1];
    $material->medidaaux=$concat;
    $y = $y + 1;
        //print_r($first = $name[$y]);
    $material->factura=$first = $name[$y];
    $y = $y + 1;

    $material->fecha=$first = $name[$y];
    $y = $y + 1;

    $material->p_unitario=$first = $name[$y];
    $y = $y + 1;

    $material->iva=$first = $name[$y];
    $y = $y + 1;         
    $material->total=$first = $name[$y];
    $material->importe=$first = $name[$y];
    $y = $y + 1;
    $material->moneda=$first = $name[$y];
    $y = $y + 1;
    $material->entregado=$request->get('entregado_a');
    $material->recibe_alm=$request->get('recibe_alm');
    $material->observacionesc=$request->get('observacionesq');
    $material->provedor=$request->get('prov');
    $material->comprador=$request->get('recibio');
    $material->estado="Activo";
      $unidad->estado="Activo";
     if ($x > 0){
       $unidad2->update();
     }else{
       $unidad->save();
     }
    $material->save();
    $num = $num + 1;
        //
}
return redirect('/almacen/entradas/limpieza');
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
       $material=entradasalmacenlimpieza::findOrFail($id);
       $material->estado="Inactivo";
       $decrementa=almacenlimpieza::findOrFail($material->id_material);
       $decrementa->cantidad=$decrementa->cantidad- $material->cantidad;
        $v= [$material->medidaaux];
        $first = head($v);
        $name = explode(" ",$first);
        $z = count($name);
        $a="";
        for ($i=0; $i < $z; $i++) { 
          if ($i == 1) {
           $a=$name[$i];             
            # code...
         }else if($i > 1) {
          $a=$a." ".$name[$i];
        }else{
          $r=$name[0];
        }
          # code...
      }
//print_r($e[0]);
      $medida2= unidadesmedida::where('nombre','=',$a)->first()->id;
      $unidadaux=cantidad_unidades_limp::where('idProducto','=',$decrementa->id)->where('idMedida','=',$medida2)->first()->id;
      $unidad=cantidad_unidades_limp::findOrFail($unidadaux);
      $unidad->cantidad=$unidad->cantidad - $r;
      $unidad->update();
       $decrementa->update();
       $material->update();
       return Redirect::to('/almacen/entradas/limpieza');   
        //
   }


   public function excel()
   {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('entradasalmacenlimpieza', function($excel) {
          $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
            $salidas = entradasalmacenlimpieza::where('entradasalmacenlimpieza.estado','=','Activo')->join('almacenlimpieza','almacenlimpieza.id', '=', 'entradasalmacenlimpieza.id_material')->join('empleados as emp1', 'entradasalmacenlimpieza.entregado', '=', 'emp1.id')
            ->join('empleados as emp2', 'entradasalmacenlimpieza.recibe_alm', '=', 'emp2.id')
            ->join('empresas_ceprozac as e', 'entradasalmacenlimpieza.comprador', '=', 'e.id')
            ->join('provedor_materiales as prov', 'entradasalmacenlimpieza.provedor', '=', 'prov.id')
            ->select('entradasalmacenlimpieza.id', 'almacenlimpieza.nombre','entradasalmacenlimpieza.medidaaux', 'entradasalmacenlimpieza.cantidad','almacenlimpieza.medida','prov.nombre as prov', 'entradasalmacenlimpieza.factura','entradasalmacenlimpieza.p_unitario','entradasalmacenlimpieza.iva','entradasalmacenlimpieza.total','entradasalmacenlimpieza.moneda','e.nombre as emp','entradasalmacenlimpieza.fecha','emp1.nombre as empnom','emp1.apellidos as empapellidos','emp2.nombre as rec_alma','emp2.apellidos as apellidosrec','entradasalmacenlimpieza.observacionesc')
            ->get();       
            $sheet->fromArray($salidas);
            $sheet->row(1,['N°Compra','Material','Cantidad','Cantidad Total','Medida' ,'Proveedor','Numero de Factura','Precio Unitario','IVA','Subtotal','Tipo de Moneda','Comprador','Fecha de Compra',"Entrego","Apellidos","Recibe en Almacén CEPROZAC","Apellidos",'Observaciónes de la Compra']);
            $sheet->setOrientation('landscape');
        });
      })->export('xls');
    }


}
