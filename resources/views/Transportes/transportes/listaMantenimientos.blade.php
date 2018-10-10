@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Lista de Mantenimientos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/empleados')}}">Inicio</a></li>
      <li class="active">Lista de Mantenimientos</a></li>
    </ol>
  </div>
</div>
<div class="container clear_both padding_fix">
  <div class="row">
    <div class="col-md-12">
      <div class="block-web">
        <div class="header">
          <div class="row" style="margin-top: 15px; margin-bottom: 12px;">
            <div class="col-sm-7">
              <div class="actions"> </div>
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Mantenimientos de : {{$transporte->nombre_Unidad}}</strong></h4>
            </div>
            <div class="btn-group pull-right">
              <b>
               <div class="btn-group" style="margin-right: 10px;">
                <a class="btn btn-sm btn-success tooltips" href="{{URL::action('MantenimientoTransporteController@create',[])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Proveedor"> <i class="fa fa-plus"></i> Registrar </a>

                <a class="btn btn-sm btn-warning tooltips" href="{{URL::action('TransporteController@descargarMantenimientos',[$transporte->id,$transporte->nombre_Unidad])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

                <a class="btn btn-sm btn-danger tooltips" href="{{URL::action('TransporteController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

              </div>
              
            </a>
          </b>
        </div>

      </div>
    </div>
    <div class="porlets-content container clear_both padding_fix">
      @if($mantenimientos==null)
      <div class="alert alert-danger"> <strong>No</strong> se encuentran mantenimientos registrados  a este Vehiculo. <a class="alert-link" href="{{URL::action('MantenimientoTransporteController@crearMantenimientoEspecifico',[$transporte->id])}}">Click Para registrar</a></div>
      
    </b>
  </div>
  @else
  @foreach($mantenimientos as $mantenimiento)
  <div class="col-lg-6"> 
    <section class="panel default blue_title h4">
      <div class="panel-heading"><span class="semi-bold">{{$mantenimiento->concepto}}</span> 
      </div>
      <div class="panel-body">

        <table class="table table-striped">

          <tbody>
            <tr>
              <th>Concepto: </th>
              <td>{{$mantenimiento->concepto}}</td>
            </tr>
            <tr>
              <th>Descripcion:</th>
              <td>{{$mantenimiento->descripcion}}</td>
            </tr>
            <tr>
              <th>Fecha: </th>
              <td>{{$mantenimiento->fecha}}</td>
            </tr>
            <tr>
              <th>Fecha: </th>
              <td>{{$mantenimiento->fecha}}</td>
            </tr>
            <tr>
              <th>Encargado de Mantenimiento: </th>
              <td> {{$mantenimiento->nm}} {{$mantenimiento->am}}</td>
            </tr>
            <tr>
              <th>Responsable de Vehiculo: </th>
              <td> {{$mantenimiento->nc}} {{$mantenimiento->ac}}</td>
            </tr>
            <tr>
              <th>Editar: </th>
              <td>      
                <center>
                  <a href="{{URL::action('MantenimientoTransporteController@edit',$mantenimiento->idMantenimiento)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
                </center>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </section>
  </div>
  @endforeach
  @endif
</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
