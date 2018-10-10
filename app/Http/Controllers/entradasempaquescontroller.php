<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Requests\EntradasAgroquimicosRequest;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Http\Requests\entradasempaquerequest;
use CEPROZAC\entradasempaques;
use CEPROZAC\Empleado;
use CEPROZAC\AlmacenAgroquimicos;
use CEPROZAC\almacenempaque;
use CEPROZAC\ProvedorMateriales;
use CEPROZAC\empresas_ceprozac;
use CEPROZAC\cantidad_unidades_emp;
use CEPROZAC\unidadesmedida;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Collection as Collection;
class entradasempaquescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  
    { 
     $entrada= DB::table('entradasempaques')->where('entradasempaques.estado','=','Activo')
     ->join('almacenempaque as a', 'entradasempaques.id_material', '=', 'a.id')
     ->join('empresas_ceprozac as e', 'entradasempaques.comprador', '=', 'e.id')
     ->join('provedor_materiales as prov', 'entradasempaques.provedor', '=', 'prov.id')

     ->select('entradasempaques.*','a.nombre as nombremat','entradasempaques.*','a.medida','e.nombre as emp','prov.nombre as prov')->get();
        // print_r($salida);
     return view('almacen.empaque.entradas.index', ['entrada' => $entrada]);

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
     ->where('provedores_tipo_provedor.idTipoProvedor','=','4')->get();
       $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();
       $material=DB::table('almacenempaque')->where('estado','=' ,'Activo')->where('cantidad','>=','0')->get();
       $unidades= DB::table('unidadesmedida')->where('estado','Activo')->get();

       $cuenta = count($material);


       if (empty($material)){
           $entrada= DB::table('entradasempaques')
           ->join('almacenempaque as a', 'entradasempaques.id_material', '=', 'a.id')
           ->select('entradasempaques.*','a.nombre as nombremat','entradasempaques.*','a.medida')->get();
        // print_r($salida);
           return view('almacen.empaque.entradas.index', ['entrada' => $entrada]);

         // return view("almacen.materiales.salidas.create")->with('message', 'No Hay Material Registrado, Favor de Dar de Alta Material Para Poder Acceder a Este Modulo');
       }else if (empty($empleado)) {
           $entrada= DB::table('entradasempaques')
           ->join('almacenempaque as a', 'entradasempaques.id_material', '=', 'a.id')
           ->select('entradasempaques.*','a.nombre as nombremat','entradasempaques.*','a.medida')->get();
           return view('almacen.empaque.entradas.index', ['entrada' => $entrada]);


       }else if (empty($provedor)){
           $entrada= DB::table('entradasempaques')
           ->join('almacenempaque as a', 'entradasempaques.id_material', '=', 'a.id')
           ->select('entradasempaques.*','a.nombre as nombremat','entradasempaques.*','a.medida')->get();
           return view('almacen.empaque.entradas.index', ['entrada' => $entrada]);

       }
       else{
        return view("almacen.empaque.entradas.create",["material"=>$material,"provedor"=>$provedor],["empleado"=>$empleado,"empresas"=>$empresas,'unidades'=>$unidades]);

    }
        //
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(entradasempaquerequest $formulario)
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

            $num = 1;
            $y = 0;
            $limite = $formulario->get('total');
   //print_r($limite);

            while ($num <= $limite) {
                $material= new entradasempaques;
                $unidad = new cantidad_unidades_emp;
            //print_r($num);
                $producto = $formulario->get('codigo2');
                $first = head($producto);
                $name = explode(",",$first);        
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
                   $unidad->estado="Activo";
                   $unidad->idMedida=$medida2;
        ///si ya exixste//
        $comprueba2= DB::table('cantidad_unidades_agro')->where('idMedida','=',$medida2)->where('idProducto','=',$prod)->get();
        $r=count($comprueba2);
        if ($r > 0){
          $unidadaux=cantidad_unidades_agro::where('idProducto','=',$prod)->where('idMedida','=',$medida2)->first()->id;
          $unidad2=cantidad_unidades_agro::findOrFail($unidadaux);
          $unidad2->cantidad=$unidad2->cantidad + $aux;
          $unidad2->update();
        }else{
          $unidad->save();
        }

        $concat = $aux." ".$aux2;
        $y = $y + 1;
        $yy =$first = $name[$y]; 
        $producto2 = $yy;
        $name2 = explode(" ",$producto2);
        $material->cantidad= $name2[0];

        $material->medida= $name2[1];
        $material->medidaaux=$concat;
        $y = $y + 1;
            // print_r($first = $name[$y]);
                $material->factura=$first = $name[$y];
                $y = $y + 1;
             //print_r($first = $name[$y]);
            // print_r($first = $name[$y]);
                $material->p_unitario=$first = $name[$y];
                $y = $y + 1;
                $material->iva=$first = $name[$y];
                $y = $y + 1;
                $material->total=$first = $name[$y];
                $material->importe=$first = $name[$y];
                $y = $y + 1;
                $material->estado="Activo";
                $material->provedor=$formulario->get('prov');
                $material->comprador=$formulario->get('recibio');
                $material->entregado=$formulario->get('entregado_a');
                $material->recibe_alm=$formulario->get('recibe_alm');
                $material->observacionesc=$formulario->get('observacionese');
                $material->fecha=$formulario->get('fecha');
                $material->moneda=$formulario->get('moneda');
                $material->save();
                $num = $num + 1;
            }}
        //
        }
        return redirect('/almacen/entradas/empaque');
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
       $entradas2=DB::table('entradasempaques')->where('factura','=',$id)->get();
       $entrada = entradasempaques::findOrFail($entradas2[0]->id);
       $fac=$entrada->factura;
       $empleado=DB::table('empleados')->where('estado','=' ,'Activo')->get();
       $entradas=DB::table('entradasempaques')->where('factura','=',$fac)
       ->join('almacenempaque as a', 'entradasempaques.id_material', '=', 'a.id')
       ->select('entradasempaques.*','a.nombre as nombremat','a.id as idagro')->get();


       $material=DB::table('almacenempaque')->where('estado','=' ,'Activo')->where('cantidad','>=','0')->get();
                         $provedor = DB::table('provedores_tipo_provedor')
        ->join('provedor_materiales as p', 'provedores_tipo_provedor.idProvedorMaterial', '=', 'p.id')
     ->select('p.*','p.nombre as nombre')
     ->where('provedores_tipo_provedor.idTipoProvedor','=','4')->get();
      $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();
        // 
       return view('almacen.empaque.entradas.edit', ['entrada' => $entrada,'empleado' => $empleado,'entradas'=> $entradas,'material'=>$material,'provedor'=>$provedor,'empresas'=>$empresas,'unidades'=>$unidades]);
        //
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
               $entrada = entradasempaques::findOrFail($id);
       $fac=$entrada->factura;
       $empleado=DB::table('empleados')->where('estado','=' ,'Activo')->get();
       $entradas=DB::table('entradasempaques')->where('factura','=',$fac)
       ->join('almacenempaque as a', 'entradasempaques.id_material', '=', 'a.id')
       ->select('entradasempaques.*','a.nombre as nombremat','a.id as idagro')->get();


       $material=DB::table('almacenempaque')->where('estado','=' ,'Activo')->where('cantidad','>=','0')->get();
        $provedor = DB::table('provedores_tipo_provedor')
        ->join('provedor_materiales as p', 'provedores_tipo_provedor.idProvedorMaterial', '=', 'p.id')
     ->select('p.*','p.nombre as nombre')
     ->where('provedores_tipo_provedor.idTipoProvedor','=','4')->get();
      $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();
      $unidades= DB::table('unidadesmedida')->where('estado','Activo')->get();
        // 
       return view('almacen.empaque.entradas.edit', ['entrada' => $entrada,'empleado' => $empleado,'entradas'=> $entradas,'material'=>$material,'provedor'=>$provedor,'empresas'=>$empresas,'unidades'=>$unidades]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
   $entrada = entradasempaques::findOrFail($id);
       $fac=$entrada->factura;
      $entradas=DB::table('entradasempaques')->where('factura','=',$fac)->get();
       $cuenta = count($entradas);

      for ($x=0; $x < $cuenta  ; $x++) {
      $elimina = entradasempaques::findOrFail($entradas[$x]->id);
      $decrementa=almacenempaque::findOrFail($elimina->id_material);
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
      $unidadaux=cantidad_unidades_emp::where('idProducto','=',$decrementa->id)->where('idMedida','=',$medida2)->first()->id;
      $unidad=cantidad_unidades_emp::findOrFail($unidadaux);
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
        $material= new entradasempaques;
        $unidad = new cantidad_unidades_emp;
            
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
               $aux =$first = $name[$y];
      $unidad->cantidad=$first = $name[$y];
        //$material->cantidad=$first = $name[$y];
        $y = $y + 1;
        $aux2 =$first = $name[$y];
         $medida2= unidadesmedida::where('nombre','=',$aux2)->first()->id;
          $unidad->estado="Activo";
        $unidad->idMedida=$medida2;

      //si ya existe//

        $comprueba2= DB::table('cantidad_unidades_emp')->where('idMedida','=',$medida2)->where('idProducto','=',$prod)->get();
        $r=count($comprueba2);
        if ($r > 0){
          $unidadaux=cantidad_unidades_emp::where('idProducto','=',$prod)->where('idMedida','=',$medida2)->first()->id;
          $unidad2=cantidad_unidades_emp::findOrFail($unidadaux);
          $unidad2->cantidad=$unidad2->cantidad + $aux;
        $unidad2->update();
        }else{
          $unidad->save();
        }

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
        $material->save();
        $num = $num + 1;
        //
    }
   return redirect('/almacen/entradas/empaque');
        //
    }


 public function excel()
 {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('entradasempaques', function($excel) {
          $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
            $salidas = entradasempaques::where('entradasempaques.estado','=','Activo')->join('almacenempaque','almacenempaque.id', '=', 'entradasempaques.id_material')->join('empleados as emp1', 'entradasempaques.entregado', '=', 'emp1.id')
            ->join('empleados as emp2', 'entradasempaques.recibe_alm', '=', 'emp2.id')
            ->join('empresas_ceprozac as e', 'entradasempaques.comprador', '=', 'e.id')
            ->join('provedor_materiales as prov', 'entradasempaques.provedor', '=', 'prov.id')
            ->select('entradasempaques.id', 'almacenempaque.nombre', 'entradasempaques.cantidad','almacenempaque.medida','prov.nombre as prov', 'entradasempaques.factura','entradasempaques.p_unitario','entradasempaques.iva','entradasempaques.total','entradasempaques.moneda','e.nombre as emp','entradasempaques.fecha','emp1.nombre as empnom','emp1.apellidos as empapellidos','emp2.nombre as rec_alma','emp2.apellidos as apellidosrec','entradasempaques.observacionesc')
            ->get();       
            $sheet->fromArray($salidas);
            $sheet->row(1,['N°Compra','Material','Cantidad','Medida' ,'Proveedor','Numero de Factura','Precio Unitario','IVA','Subtotal','Tipo de Moneda','Comprador','Fecha de Compra',"Entrego","Apellidos","Recibe en Almacén CEPROZAC","Apellidos",'Observaciónes de la Compra']);
            $sheet->setOrientation('landscape');
        });
      })->export('xls');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material=entradasempaques::findOrFail($id);
        $material->estado="Inactivo";
         $decrementa=almacenempaque::findOrFail($material->id_material);
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
      $unidadaux=cantidad_unidades_emp::where('idProducto','=',$decrementa->id)->where('idMedida','=',$medida2)->first()->id;
      $unidad=cantidad_unidades_emp::findOrFail($unidadaux);
      $unidad->cantidad=$unidad->cantidad - $r;
      $unidad->update();
      
      $decrementa->update();
        $material->update();
        return Redirect::to('/almacen/entradas/empaque');   
        //
    }
}
