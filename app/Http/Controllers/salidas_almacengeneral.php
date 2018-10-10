<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;

use CEPROZAC\Http\Requests;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\salidas_almacengeneral;
use CEPROZAC\entradas_almacengeneral;
use CEPROZAC\AlmacenAgroquimicos;
class salidas_almacengeneral extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
      $material= new salidas_almacengeneral;
        $almacen = $request->get('codigo2');
        $first = head($almacen);
         $name = explode("_",$first);
     $material->id_almacen=$request->get('almacenid');
      $material->espacio_asignado=$request->get('espacio');
      $material->destino=$first = $name[0];
       $material->fecha=$request->get('fecha');
       $material->kg_salida=$request->get('scantidad');
       $material->id_producto=$request->get('id_producto');
        $material->id_provedor=$request->get('id_provedor');
          $material->entrego=$request->get('entregado_a');
          $material->recibe_alm=$request->get('recibe');
          $material->observacionesc=$request->get('observaciones');
          $material->id_lote=$request->get('id_lote');
          $material->estado="Activo";
          $material->save();

          $lote = lote::findOrFail($request->get('id_lote'));
          $lote->cantidad_act=$lote->cantidad_act - $request->get('scantidad');
          $lote->update();

          

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
        //
    }
}
