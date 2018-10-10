<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Requests;

use CEPROZAC\AlmacenAgroquimicos;
use CEPROZAC\Http\Requests\almacenagroquimicosRequest;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\EntradasAgroquimicos; 
use CEPROZAC\ProvedorMateriales;
use CEPROZAC\empresas_ceprozac;
use CEPROZAC\cantidad_unidades_agro;
use CEPROZAC\Unidades_medida;
use CEPROZAC\DetallesEntradasAgroquimicos;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use CEPROZAC\Http\Requests\modalentradaagro;

class almacenagroquimicosController extends Controller
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
     $material = DB::table('almacenagroquimicos')
     ->join('unidades_medidas', 'almacenagroquimicos.idUnidadMedida', '=','unidades_medidas.id')
     ->select('unidades_medidas.id')
     ->join('nombre_unidades_medidas','unidades_medidas.idUnidadMedida','=', 'nombre_unidades_medidas.id')
     ->select('almacenagroquimicos.id as idAgroquimico','almacenagroquimicos.nombre',
      'almacenagroquimicos.codigo','almacenagroquimicos.imagen','almacenagroquimicos.descripcion', 
      'almacenagroquimicos.cantidad', 'almacenagroquimicos.stock_minimo','almacenagroquimicos.idUnidadMedida', 
      'unidades_medidas.nombre as nombreUnidadMedida', 
      'unidades_medidas.cantidad as cantidadUnidadMedida', 'nombre_unidades_medidas.nombreUnidadMedida as unidad_medida')
     ->where('almacenagroquimicos.estado','=','Activo')
     ->get();


     $provedores= DB::table('provedores_tipo_provedor')
     ->join('provedor_materiales', 'provedores_tipo_provedor.idProvedorMaterial','=','provedor_materiales.id')

     ->join('tipo_provedor','provedores_tipo_provedor.idTipoProvedor','=' ,'tipo_provedor.id')
     ->select('provedor_materiales.*', 'tipo_provedor.nombre as tipo')
     ->where('provedores_tipo_provedor.idTipoProvedor','=','2')
     ->where('provedor_materiales.estado','=','Activo')
     ->get();

     $empleado = DB::table('empleados')->where('estado','Activo')->get();
     $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();

     $unidades  = DB::table('unidades_medidas')
     ->join('nombre_unidades_medidas', 'unidades_medidas.idUnidadMedida', '=', 'nombre_unidades_medidas.id')
     ->select('unidades_medidas.*', 'nombre_unidades_medidas.*')
     ->where('estado', '=', 'Activo')
     ->get();

     return view('almacen.agroquimicos.index', ['material' => $material,'provedores' => $provedores, 'empleado' => $empleado,"empresas"=>$empresas,'unidades'=>$unidades]);

   }


   public function calcularCantidadAlmacen($id){

     $material=almacenagroquimicos::findOrFail($id);
     $idUnidadMedida = $material->idUnidadMedida;
     $unidad_medida  = $this->propiedadesUnidadMedida($idUnidadMedida);
     $cantidadAlmacen=$material->cantidad;
     $diferenciadorUnidadMedida= $unidad_medida->nombreUnidadMedida;
     $capacidadUnidadMedida= $unidad_medida->cantidad;

     if($diferenciadorUnidadMedida == "KILOGRAMOS")
     {
      $cantidadUnidadesCompletas= floor($cantidadAlmacen /1000 / $capacidadUnidadMedida);

      return $cantidadUnidadesCompletas;
    }
    elseif($diferenciadorUnidadMedida == "LITROS")  
    {
      $cantidadUnidadesCompletas= floor($cantidadAlmacen /1000 / $capacidadUnidadMedida);
      return $cantidadUnidadesCompletas;

    } 
    elseif($diferenciadorUnidadMedida =="UNIDADES")
    {
     return $cantidadUnidadesCompletas=floor($cantidadAlmacen /$capacidadUnidadMedida); 
   }

   elseif($diferenciadorUnidadMedida =="METROS") {
    return  $cantidadUnidadesCompletas=floor($cantidadAlmacen /100/$capacidadUnidadMedida); 
  }

  elseif($diferenciadorUnidadMedida =="GRAMOS") {
    return  $cantidadUnidadesCompletas=floor($cantidadAlmacen /$capacidadUnidadMedida); 
  }

  elseif($diferenciadorUnidadMedida =="CENTIMETROS") {
    return  $cantidadUnidadesCompletas=floor($cantidadAlmacen /$capacidadUnidadMedida); 
  }

  elseif($diferenciadorUnidadMedida =="MILILITROS") {
    return  $cantidadUnidadesCompletas=floor($cantidadAlmacen /$capacidadUnidadMedida); 
  }
}





public function calcularCantidadUnidadCentral($id){

 $material=almacenagroquimicos::findOrFail($id);
 $idUnidadMedida = $material->idUnidadMedida;
 $unidad_medida  =  $this->propiedadesUnidadMedida($idUnidadMedida);
 $cantidadAlmacen=$material->cantidad;
 $diferenciadorUnidadMedida= $unidad_medida->nombreUnidadMedida;
 $capacidadUnidadMedida= $unidad_medida->cantidad;

 if($diferenciadorUnidadMedida == "KILOGRAMOS")
 {


  $cantidadUnidadesCompletas= ((floor($cantidadAlmacen /1000 / $capacidadUnidadMedida))*$capacidadUnidadMedida)*1000;

  $cantidadUnidadCentral =floor( ($cantidadAlmacen - $cantidadUnidadesCompletas)/1000);

  return $cantidadUnidadCentral;
}
elseif($diferenciadorUnidadMedida =="LITROS")  
{

  $cantidadUnidadesCompletas= ((floor($cantidadAlmacen /1000 / $capacidadUnidadMedida))*$capacidadUnidadMedida)*1000;
  $cantidadUnidadCentral =floor( ($cantidadAlmacen - $cantidadUnidadesCompletas)/1000);

  return $cantidadUnidadCentral;
} 
elseif($diferenciadorUnidadMedida =="UNIDADES")
{
 return $cantidadUnidadesCompletas=0; 
}

elseif($diferenciadorUnidadMedida =="METROS") {

  $cantidadUnidadesCompletas= ((floor($cantidadAlmacen /100 / $capacidadUnidadMedida))*$capacidadUnidadMedida)*100;
  $cantidadUnidadCentral =floor( ($cantidadAlmacen - $cantidadUnidadesCompletas)/100);
  return  $cantidadUnidadCentral;
}


}
public function calcularCantidadUnidadInferior($id){


 $material=almacenagroquimicos::findOrFail($id);
 $idUnidadMedida = $material->idUnidadMedida;
 $unidad_medida  = $this->propiedadesUnidadMedida($idUnidadMedida);
 $cantidadAlmacen=$material->cantidad;
 $diferenciadorUnidadMedida= $unidad_medida->nombreUnidadMedida;
 $capacidadUnidadMedida= $unidad_medida->cantidad;

 if($diferenciadorUnidadMedida == "KILOGRAMOS")
 {

   $cantidadUnidadesCompletas= ((floor($cantidadAlmacen /1000 / $capacidadUnidadMedida))*$capacidadUnidadMedida)*1000;
   $cantidadUnidadCentral =floor( ($cantidadAlmacen - $cantidadUnidadesCompletas)/1000) *1000;
   $cantidadUnidadInferior =$cantidadAlmacen -($cantidadUnidadesCompletas+$cantidadUnidadCentral);

   return $cantidadUnidadInferior;
 }
 elseif($diferenciadorUnidadMedida =="LITROS")  
 {

   $cantidadUnidadesCompletas= ((floor($cantidadAlmacen /1000 / $capacidadUnidadMedida))*$capacidadUnidadMedida)*1000;
   $cantidadUnidadCentral =floor( ($cantidadAlmacen - $cantidadUnidadesCompletas)/1000) *1000;
   $cantidadUnidadInferior =$cantidadAlmacen -($cantidadUnidadesCompletas+$cantidadUnidadCentral);
   return $cantidadUnidadInferior;
 } 
 elseif($diferenciadorUnidadMedida =="UNIDADES")
 {
  $cantidadUnidadesCompletas=floor($cantidadAlmacen /$capacidadUnidadMedida); 
  return $cantidadUnidadesCompletas=$cantidadAlmacen -($cantidadUnidadesCompletas*$capacidadUnidadMedida); 
} elseif($diferenciadorUnidadMedida =="METROS") {

  $cantidadUnidadesCompletas=floor($cantidadAlmacen /$capacidadUnidadMedida); 
  return $cantidadUnidadesCompletas=$cantidadAlmacen -($cantidadUnidadesCompletas*$capacidadUnidadMedida); 

} elseif($diferenciadorUnidadMedida =="GRAMOS") {

 $cantidadUnidadesCompletas=floor($cantidadAlmacen /$capacidadUnidadMedida); 
 return $cantidadUnidadesCompletas=$cantidadAlmacen -($cantidadUnidadesCompletas*$capacidadUnidadMedida); 

} elseif($diferenciadorUnidadMedida =="MILILITROS") {


  $cantidadUnidadesCompletas=floor($cantidadAlmacen /$capacidadUnidadMedida); 
  return $cantidadUnidadesCompletas=$cantidadAlmacen -($cantidadUnidadesCompletas*$capacidadUnidadMedida); 

} elseif($diferenciadorUnidadMedida =="CENTIMETROS") {

 $cantidadUnidadesCompletas=floor($cantidadAlmacen /$capacidadUnidadMedida); 
 return $cantidadUnidadesCompletas=$cantidadAlmacen -($cantidadUnidadesCompletas*$capacidadUnidadMedida); 
}



}




public function labelUnidadMedidaMinima($id){

  $material=almacenagroquimicos::findOrFail($id);
  $idUnidadMedida = $material->idUnidadMedida;
  $unidad_medida  = $this->propiedadesUnidadMedida($idUnidadMedida);
  $cantidadAlmacen=$material->cantidad;
  $diferenciadorUnidadMedida= $unidad_medida->nombreUnidadMedida;
  $capacidadUnidadMedida= $unidad_medida->cantidad;

  if($diferenciadorUnidadMedida == "KILOGRAMOS")
  {

   return "GRAMOS";
 }
 elseif($diferenciadorUnidadMedida =="LITROS")  
 {

   return "MILILITROS";
 } 
 elseif($diferenciadorUnidadMedida =="UNIDADES")
 {
   return "UNIDADES"; 
 }

 elseif($diferenciadorUnidadMedida =="METROS") {
  return  "CENTIMETROS"; 

}  elseif($diferenciadorUnidadMedida =="CENTIMETROS") {
  return  "CENTIMETROS";

} elseif($diferenciadorUnidadMedida =="GRAMOS") {
  return  "GRAMOS";
}
elseif($diferenciadorUnidadMedida =="MILILITROS") {
  return  "MILILITROS";
}

}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $provedor = DB::table('provedores_tipo_provedor')
      ->join('provedor_materiales as p', 'provedores_tipo_provedor.idProvedorMaterial', '=', 'p.id')
      ->select('provedores_tipo_provedor.*','p.nombre as nombre')
      ->where('provedores_tipo_provedor.idTipoProvedor','2')->get();



      $unidades  = DB::table('unidades_medidas')
      ->join('nombre_unidades_medidas', 'unidades_medidas.idUnidadMedida', '=', 'nombre_unidades_medidas.id')
      ->select('unidades_medidas.id as idContenedorUnidadMedida','unidades_medidas.nombre','unidades_medidas.cantidad', 'unidades_medidas.idUnidadMedida', 'nombre_unidades_medidas.*')
      ->where('estado', '=', 'Activo')
      ->get();
        //$provedor= DB::table('provedor_materiales')->where('estado','Activo')->where('tipo','like','%Agroquimicos%')->get(); 
      return view('almacen.agroquimicos.create',['provedor' => $provedor,'unidades'=>$unidades]);



        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
      $unidades=$this->propiedadesUnidadMedida($request->get("idUnidadMedida"));
      $unidadDeMedida=$unidades->nombreUnidadMedida;
      $capacidadUnidadMedida= $unidades->cantidad;
      $totalUnidadesCompletas= $capacidadUnidadMedida* $unidadesCompletas = $request->get('unidadesCompletas');
      $unidadCentral = $request->get('unidadCentral');
      $unidadesMedida =$request->get('unidadDeMedida');
      $stockReal = $request->get('stock_min');
      $stockMinimo = $cantidadAlmacen= $this->calcularStockMinimoReal($unidadDeMedida,$stockReal);
      $cantidadAlmacen= $this->calcularEquivalencia($unidadDeMedida,$totalUnidadesCompletas, $unidadCentral,$unidadesMedida);
      $material= new almacenagroquimicos;
      $material->nombre=$request->get('nombre');

        if (Input::hasFile('imagen')){ //validar la imagen, si (llamanos clase input y la funcion hash_file(si tiene algun archivo))
            $file=Input::file('imagen');//si pasa la condicion almacena la imagen
            $file->move(public_path().'/imagenes/almacenagroquimicos',$file->getClientOriginalName());//lo movemos a esta ruta                        
            $material->imagen=$file->getClientOriginalName();
          }
          $material->descripcion=$request->get('descripcion');
          $material->cantidad=$cantidadAlmacen;
          $material->idUnidadMedida=$request->get('idUnidadMedida');
          $material->codigo=$request->get('codigo');
          $material->stock_minimo=$stockMinimo;
          $material->estado='Activo';
          $material->save();
          return Redirect::to('detalle/agroquimicos');

        }

        public function invoice($id){ 
          $material= DB::table('almacenagroquimicos')->where('id',$id)->get();
         //$material   = AlmacenMaterial:: findOrFail($id);
          $date = date('Y-m-d');
          $invoice = "2222";
       // print_r($materiales);    
          $view =  \View::make('almacen.agroquimicos.invoice', compact('date', 'invoice','material'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('invoice');
        }

        public function detalle(){ 
          $material= DB::table('almacenagroquimicos')->orderby('created_at','DESC')->take(1)->get();
          $provedor= DB::table('provedor_materiales')->where('estado','Activo')->get();

          return view('almacen.agroquimicos.detalle',["material"=>$material,"provedor"=>$provedor]);

        }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $unidadesMedidas  = DB::table('unidades_medidas')
      ->join('nombre_unidades_medidas', 'unidades_medidas.idUnidadMedida', '=', 'nombre_unidades_medidas.id')
      ->select('unidades_medidas.id as idContenedorUnidadMedida','unidades_medidas.nombre','unidades_medidas.cantidad', 'unidades_medidas.idUnidadMedida', 'nombre_unidades_medidas.*')
      ->where('estado', '=', 'Activo')
      ->get();


      $material = almacenagroquimicos::findOrFail($id);
      $cantidad = $material->cantidad;
      $idUnidadMedida = $material->idUnidadMedida;
      $idAgroquimico = $material->id;

      $unidades=$this->propiedadesUnidadMedida($idUnidadMedida);
      $unidadDeMedida=$unidades->nombreUnidadMedida;
      $capacidadUnidadMedida= $unidades->cantidad;
      $unidad_medida = $unidades->nombreUnidadMedida;
      if($unidad_medida == "KILOGRAMOS"  || $unidad_medida == "LITROS"  ||  $unidad_medida == "METROS"){
        $unidadesCompletas= $this->calcularCantidadAlmacen($idAgroquimico);
        $unidadCentral= $this->calcularCantidadUnidadCentral($idAgroquimico);
        $unidadInferior=$this->calcularCantidadUnidadInferior($idAgroquimico);
      }
      else {

        $unidadesCompletas= $this->calcularCantidadAlmacen($idAgroquimico);
        $unidadCentral= $this->calcularCantidadUnidadCentral($idAgroquimico);
        $unidadInferior=$this->calcularCantidadUnidadInferior($idAgroquimico);
      }

      return view("almacen.agroquimicos.edit",["material"=>$material,"unidadesMedidas" => $unidadesMedidas, 
        "unidadesCompletas"=>$unidadesCompletas, "unidadCentral" =>$unidadCentral, 
        "unidadInferior" =>$unidadInferior,"unidad_medida"=>$unidad_medida]);
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


     $material=almacenagroquimicos::findOrFail($id);
     $unidades=$this->propiedadesUnidadMedida($request->get("idUnidadMedida"));
     $unidadDeMedida=$unidades->nombreUnidadMedida;
     $capacidadUnidadMedida= $unidades->cantidad;
     $totalUnidadesCompletas= $capacidadUnidadMedida* $unidadesCompletas = $request->get('unidadesCompletas');
     $unidadCentral = $request->get('unidadCentral');
     $unidadesMedida =$request->get('unidadDeMedida');
     $stockReal = $request->get('stock_min');
     $stockMinimo = $cantidadAlmacen= $this->calcularStockMinimoReal($unidadDeMedida,$stockReal);
     $cantidadAlmacen= $this->calcularEquivalencia($unidadDeMedida,$totalUnidadesCompletas, $unidadCentral,$unidadesMedida);

     $material->nombre=$request->get('nombre');

        if (Input::hasFile('imagen')){ //validar la imagen, si (llamanos clase input y la funcion hash_file(si tiene algun archivo))
            $file=Input::file('imagen');//si pasa la condicion almacena la imagen
            $file->move(public_path().'/imagenes/almacenagroquimicos',$file->getClientOriginalName());//lo movemos a esta ruta                        
            $material->imagen=$file->getClientOriginalName();
          }
          $material->descripcion=$request->get('descripcion');
          $material->cantidad=$cantidadAlmacen;
          $material->idUnidadMedida=$request->get('idUnidadMedida');
          $material->codigo=$request->get('codigo');
          $material->stock_minimo=$stockMinimo;
          $material->estado='Activo';
          $material->update();
          return Redirect::to('detalle/agroquimicos');
        }


        public function destroy($id)
        {
          $material=almacenagroquimicos::findOrFail($id);
          $material->estado='Inactivo';
          $material->save();
          return Redirect::to('almacenes/agroquimicos');
        //
        }

        public function excel()
        {        

          Excel::create('almacenagroquimicos', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
              $material = almacenagroquimicos::join('provedor_materiales','provedor_materiales.id', '=', 'almacenagroquimicos.provedor')
              ->select('almacenagroquimicos.id','almacenagroquimicos.nombre','provedor_materiales.nombre as nom','almacenagroquimicos.descripcion','almacenagroquimicos.cantidad','almacenagroquimicos.medida')
              ->where('almacenagroquimicos.estado', 'Activo')
              ->get();          
              $sheet->fromArray($material);
              $sheet->row(1,['ID','Nombre','Proveedor','Descripción' ,'Cantidad','Medida']);
              $sheet->setOrientation('landscape');
            });
          })->export('xls');
        }




        public function stock(modalentradaagro $formulario, $id) 
        {
         $validator = Validator::make(
          $formulario->all(), 
          $formulario->rules(),
          $formulario->messages());
         if ($validator->valid()){

          if ($formulario->ajax()){
            return response()->json(["valid" => true], 200);
          }
          else{
            $material=almacenagroquimicos::findOrFail($id);
            $idUnidadMedida =$material->idUnidadMedida;
            $unidades=$this->propiedadesUnidadMedida($idUnidadMedida);
            $unidadDeMedida=$unidades->nombreUnidadMedida;
            $capacidadUnidadMedida= $unidades->cantidad;
            $totalUnidadesCompletas= $capacidadUnidadMedida* $unidadesCompletas = $formulario->get('cantidad');
            $cantidadAlmacen= $this->calcularEquivalencia($unidadDeMedida,$totalUnidadesCompletas, 0,0);

            DB::beginTransaction();
            $material2= new entradasagroquimicos;
            $material2->provedor=$formulario->get('provedor');
            $material2->fecha=$formulario->get('fecha2'.$id);
            $material2->factura=$formulario->get('factura'.$id);
            $material2->comprador=$formulario->get('recibio'.$id);
            $material2->moneda=$formulario->get('moneda'.$id);
            $material2->entregado=$formulario->get('entregado_a'.$id);
            $material2->recibe_alm=$formulario->get('recibe_alm'.$id);
            $material2->observacionesc=$formulario->get('observaciones'.$id); 
            $material2->estado="Activo";
            $material2->save();
            $idEntradaAgroquimico=$material2->id;
            $detalleMaterial= new DetallesEntradasAgroquimicos;
            $detalleMaterial->idEntradaAgroquimicos =$idEntradaAgroquimico;
            $detalleMaterial->id_material = $id;
            $detalleMaterial->cantidad= $cantidadAlmacen;
            $detalleMaterial->p_unitario=$formulario->precioUnitario;
            $detalleMaterial->iva=$formulario->iva;
            $detalleMaterial->ieps=$formulario->ieps;
            $detalleMaterial->save();
            $this->actualizarStock($id, $cantidadAlmacen);
            DB::commit();
            return Redirect::to('almacenes/agroquimicos');
          }
        }
      }



      public function calcularEquivalencia($unidadDeMedida,$unidadesCompletas,$unidadCentral,$unidadesMedida){

        if($unidadDeMedida == "LITROS"){
          $total=$unidadesCompletas*1000+ $unidadCentral * 1000 +$unidadesMedida  ;
          return $total;
        }

        elseif ($unidadDeMedida =="KILOGRAMOS") {

         $total=$unidadesCompletas*1000+ $unidadCentral * 1000 +$unidadesMedida  ;
         return $total;
       }

       elseif ($unidadDeMedida=="METROS") {
         $total=$unidadesCompletas*100+ $unidadCentral * 100 +$unidadesMedida  ;
         return $total;
       }
       elseif($unidadDeMedida=="UNIDADES"){
        $total = $unidadesCompletas + $unidadCentral;
        return $total;
      } elseif($unidadDeMedida=="GRAMOS"){
        $total = $unidadesCompletas + $unidadCentral;
        return $total;
      } elseif($unidadDeMedida=="MILILITROS"){
        $total = $unidadesCompletas + $unidadCentral;
        return $total;
      } elseif($unidadDeMedida=="CENTIMETROS"){
        $total = $unidadesCompletas + $unidadCentral;
        return $total;
      } 

    }


    public  function calcularStockMinimoReal($unidadDeMedida,$stock){
      if($unidadDeMedida == "LITROS"){
        $total=$stock*1000 ;
        return $total;
      }

      elseif ($unidadDeMedida =="KILOGRAMOS") {

        $total=$stock*1000;
        return $total;
      }

      elseif ($unidadDeMedida=="METROS") {
        $total=$stock*100 ;
        return $total;
      }
      elseif($unidadDeMedida=="UNIDADES"){
        $total = $stock ;
        return $total;
      } 
      elseif($unidadDeMedida=="MILILITROS"){
        $total = $stock ;
        return $total;
      }
      elseif($unidadDeMedida=="GRAMOS"){
        $total = $stock ;
        return $total;
      }
      elseif($unidadDeMedida=="CENTIMETROS"){
        $total = $stock ;
        return $total;
      }

    }

    public function validarcodigo($codigo)
    {

      $quimico= almacenagroquimicos::
      select('id','codigo','nombre', 'estado')
      ->where('codigo','=',$codigo)
      ->get();

      return response()->json(
        $quimico->toArray());

    }



    public function convertidorStockUnidadesMinimas_UnidadCentral($unidadDeMedida,$stock){
     if($unidadDeMedida == "LITROS"){
      $total=$stock/1000 ;
      return $total;
    }
    elseif ($unidadDeMedida =="KILOGRAMOS") {
      $total=$stock/1000;
      return $total;
    }
    elseif ($unidadDeMedida=="METROS") {
      $total=$stock/100 ;
      return $total;
    }
    elseif($unidadDeMedida=="UNIDADES"){
      $total = $stock;
      return $total;
    }   

    elseif($unidadDeMedida=="MILILITROS"){
      $total = $stock;
      return $total;
    } 

    elseif($unidadDeMedida=="CENTIMETROS"){
      $total = $stock;
      return $total;
    } 
    elseif($unidadDeMedida=="GRAMOS"){
      $total = $stock;
      return $total;
    } 
  }



  public function activar(Request $request)
  { 
    $id =  $request->get('idAgro');
    $quimico=almacenagroquimicos::findOrFail($id);
    $quimico->estado="Activo";
    $quimico->update();
    return Redirect::to('almacenes/agroquimicos');
  }

  public function verInformacion($id)
  {

   $cantidad= DB::table('cantidad_unidades_agro')->where('idProducto', '=', $id)->where('cantidad_unidades_agro.cantidad','>=','0')
   ->join('unidadesmedida as u' ,'cantidad_unidades_agro.idMedida','=','u.id')
   ->join('almacenagroquimicos as alm' ,'cantidad_unidades_agro.idProducto','=','alm.id')
   ->select('cantidad_unidades_agro.*','alm.nombre as nombreprodu','u.nombre as unidadnombre')->get();


   return view("almacen.agroquimicos.ver",["cantidad"=>$cantidad]);
 }


 public function  propiedadesUnidadMedida($id){
  $unidades  = DB::table('unidades_medidas')
  ->join('nombre_unidades_medidas', 'unidades_medidas.idUnidadMedida', '=', 'nombre_unidades_medidas.id')
  ->select('unidades_medidas.*', 'nombre_unidades_medidas.*')
  ->where('estado', '=', 'Activo')
  ->where('unidades_medidas.id','=', $id)
  ->first();

  return $unidades;
}

public function actualizarStock($id,$cantidadAlmacen){
  $material=almacenagroquimicos::findOrFail($id);
  $cantidadActual = $material->cantidad;
  $cantidadTotal = $cantidadActual+ $cantidadAlmacen;
  $material->cantidad=$cantidadTotal;
  $material->update();
}


}

