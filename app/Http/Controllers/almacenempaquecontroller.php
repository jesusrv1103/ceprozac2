<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Requests;

use CEPROZAC\almacenagroquimicos;
use CEPROZAC\almacenempaque;
use CEPROZAC\formaempaque;
use CEPROZAC\Http\Requests\almacenempaquerequest;
use CEPROZAC\Http\Requests\modalentradaemp;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\entradasempaques;
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

class almacenempaquecontroller extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $material = DB::table('almacenempaque')
       ->join('provedor_materiales as p', 'almacenempaque.provedor', '=', 'p.id')
       ->select('almacenempaque.*','p.nombre as provedor')
       ->where('almacenempaque.estado','Activo')->get();
       $provedor= DB::table('provedor_materiales')->where('estado','Activo')->get();
       $empleado = DB::table('empleados')->where('estado','Activo')->get();
       $empresas=DB::table('empresas_ceprozac')->where('estado','=' ,'Activo')->get();
       $unidades= DB::table('unidadesmedida')->where('estado','Activo')->get();
       return view('almacen.empaque.index', ['material' => $material,'provedor' => $provedor, 'empleado' => $empleado,"empresas"=>$empresas,'unidades'=>$unidades]);
        //
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
       ->select('p.*','p.nombre as nombre')
       ->where('provedores_tipo_provedor.idTipoProvedor','=','4')->get();
       $empaque= DB::table('forma_empaques')->where('estado','Activo')->get();
       return view('almacen.empaque.create',['provedor' => $provedor,'empaque'=>$empaque]);
        //
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(almacenempaquerequest $formulario)
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
            $material= new almacenempaque;
            $material->nombre=$formulario->get('nombre');
            
        if (Input::hasFile('imagen')){ //validar la imagen, si (llamanos clase input y la funcion hash_file(si tiene algun archivo))
            $file=Input::file('imagen');//si pasa la condicion almacena la imagen
            $file->move(public_path().'/imagenes/almacenempaque',$file->getClientOriginalName());//lo movemos a esta ruta                        
            $material->imagen=$file->getClientOriginalName();
        }
        $material->descripcion=$formulario->get('descripcion');
        $material->cantidad=$formulario->get('cantidad');
        $material->medida=$formulario->get('medida');
        $material->codigo=$formulario->get('codigo');
        $material->provedor=$formulario->get('provedor_name');
        $material->stock_minimo=$formulario->get('stock_min');
        $material->estado='Activo';
        $aux=$formulario->get('medida');

        $aux=$formulario->get('medida');
        $material->save();
        $materialid= almacenempaque::orderBy('id', 'desc')->first()->id;
        //$medida2= DB::table('unidadesmedida')->where('nombre','=',$aux)->take(1)->get();
<<<<<<< HEAD
        $medida2= unidadesmedida::where('nombre','=',$aux)->first()->id;
=======
         $medida2= unidadesmedida::where('nombre','=',$aux)->first()->id; 
>>>>>>> a49fb5c103b05916f389285927eb7fb743810a53
        $unidad = new cantidad_unidades_emp;
        $unidad->idProducto=$materialid;
        $unidad->idMedida=$medida2;
        $unidad->cantidad=$formulario->get('cantidad');
        $unidad->estado="Activo";
        $unidad->save();
        return Redirect::to('detalle/empaque');

    }
  }        //
        //
}

public function detalle(){ 
    $material= DB::table('almacenempaque')->orderby('created_at','DESC')->take(1)->get();
    $provedor= DB::table('provedor_materiales')->where('estado','Activo')->get();

    return view('almacen.empaque.detalle',["material"=>$material,"provedor"=>$provedor]);

}


public function invoice($id){ 
    $material= DB::table('almacenempaque')->where('id',$id)->get();
         //$material   = AlmacenMaterial:: findOrFail($id);
    $date = date('Y-m-d');
    $invoice = "2222";
       // print_r($materiales);    
    $view =  \View::make('almacen.empaque.invoice', compact('date', 'invoice','material'))->render();
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
     $provedor = DB::table('provedores_tipo_provedor')
     ->join('provedor_materiales as p', 'provedores_tipo_provedor.idProvedorMaterial', '=', 'p.id')
     ->select('p.*','p.nombre as nombre')
     ->where('provedores_tipo_provedor.idTipoProvedor','4')->get();
     return view("almacen.empaque.edit",["material"=>almacenempaque::findOrFail($id)],['provedor' => $provedor]);
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
       $material=almacenempaque::findOrFail($id);
       $material->nombre=$request->get('nombre');
       $medidaaux=$request->get('medida');
       $medida2= unidadesmedida::where('nombre','=',$material->medida)->first()->id;
       $unidadaux=cantidad_unidades_emp::where('idProducto','=',$id)->where('idMedida','=',$medida2)->first()->id;
       
       if (Input::hasFile('imagen')){ //validar la imagen, si (llamanos clase input y la funcion hash_file(si tiene algun archivo))
            $file=Input::file('imagen');//si pasa la condicion almacena la imagen
            $file->move(public_path().'/imagenes/almacenempaque',$file->getClientOriginalName());//lo movemos a esta ruta
            $material->imagen=$file->getClientOriginalName();           
        }   
        $material->descripcion=$request->get('descripcion');
        $material->cantidad=$request->get('cantidad');
        $material->medida=$request->get('medida');
        $material->codigo=$request->get('codigo');
        $material->provedor=$request->get('provedor_name');
        $material->stock_minimo=$request->get('stock_min');
        $material->estado='Activo';
        $material->update();

        $unidad=cantidad_unidades_emp::findOrFail($unidadaux);
        $medidaaux=$request->get('medida');
        $medida2= unidadesmedida::where('nombre','=',$medidaaux)->first()->id;
        $unidad->idMedida=$medida2;
        $unidad->cantidad=$request->get('cantidad');
        $unidad->estado="Activo";
        $unidad->update();

        return Redirect::to('almacenes/empaque');
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
      $material=almacenempaque::findOrFail($id);
      $material->estado='Inactivo';
      $material->save();
      return Redirect::to('almacenes/empaque');
        //
  }

  public function excel()
  {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('almacenempaque', function($excel) {
          $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
            $material = almacenempaque::join('provedor_materiales','provedor_materiales.id', '=', 'almacenempaque.provedor')
            ->select('almacenempaque.id','almacenempaque.nombre','provedor_materiales.nombre as nom','almacenempaque.descripcion','almacenempaque.cantidad','almacenempaque.medida')
            ->where('almacenempaque.estado', 'Activo')
            ->get();          
            $sheet->fromArray($material);
            $sheet->row(1,['ID','Nombre de Empaque','Proveedor','Descripción' ,'Cantidad','Medida']);
            $sheet->setOrientation('landscape');
            
            /*    
            $objDrawing = new PHPExcel_Worksheet_Drawing;
            $objDrawing->setPath(public_path('images\logoCeprozac.jpg')); //your image path
            $objDrawing->setCoordinates('E20');
            $objDrawing->setWorksheet($sheet);
            $objDrawing->setResizeProportional(true);
            $objDrawing->setWidthAndHeight(260,220);
            $objDrawing->setOffsetX(200);
*/
        });
      })->export('xls');
    }

    public function stock(modalentradaemp $formulario, $id)
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

            $material=almacenempaque::findOrFail($id);
            $prov=$material->provedor;
            $prove=provedormateriales::findOrFail($prov);
            $nom_provedor=$prove->id;

            $material2= new entradasempaques;
            $material2->id_material=$id;
            $material2->cantidad=$formulario->get('cantidades'.$id);
            $material2->medida=$formulario->get('umedida'.$id);
            $material2->medidaaux=$formulario->get('medidaaux'.$id);

            $material2->provedor=$nom_provedor;
            $material2->entregado=$formulario->get('entregado_a'.$id);
            $material2->recibe_alm=$formulario->get('recibe_alm'.$id);
            $material2->observacionesc=$formulario->get('observaciones'.$id);

            $material2->comprador=$formulario->get('recibio'.$id);
            $material2->factura=$formulario->get('factura'.$id);
            $material2->fecha=$formulario->get('fecha2'.$id);
            $material2->p_unitario=$formulario->get('preciou'.$id);
            $ivaaux=$formulario->get('iva'.$id) * .010;
            $ivatotal = $material2->p_unitario *  $material2->cantidad * $ivaaux;
            $material2->iva=$ivatotal;

            $material2->total= $material2->p_unitario *  $material2->cantidad + $ivatotal;
            $material2->importe= $material2->p_unitario *  $material2->cantidad + $ivatotal;
            $material2->moneda=$formulario->get('moneda'.$id);
            $material2->estado="Activo";
            $material2->save(); 


            return Redirect::to('almacenes/empaque');
        }
    }
}

public function validarcodigo($codigo)
{

    $quimico= almacenempaque::
    select('id','codigo','nombre', 'estado')
    ->where('codigo','=',$codigo)
    ->get();

    return response()->json(
      $quimico->toArray());

}



public function activar(Request $request)
{ 
    $id =  $request->get('idEmp');
    $quimico=almacenempaque::findOrFail($id);
    $quimico->estado="Activo";
    $quimico->update();
    return Redirect::to('almacenes/empaque');
}
}
