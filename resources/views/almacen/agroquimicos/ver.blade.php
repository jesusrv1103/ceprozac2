@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Producto Actual en Almacén </h1>
    <h2 class="">Producto Actual en Almacén </h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/almacen/general')}}">Inicio</a></li>
      <li class="active">Producto Actual en Almacén </a></li>
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
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Producto Actual en Almacén </strong></h2>
            </div>
            <div class="col-md-12">
              <div class="btn-group pull-right">
                <b>
                 

                  <div class="btn-group" style="margin-right: 10px;">
                    <a class="btn btn-sm btn-success tooltips" href="{{ route('almacen.general.create')}}"style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Almacén"> <i class="fa fa-plus"></i> Registrar Almacén </a>

                    <a class="btn btn-sm btn-warning tooltips" href="{{ route('almacengeneral.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>


                  </div>
                </b>
              </div>
            </div>
          </div>
        </div>

        <div class="porlets-content">
          <div class="table-responsive">
           <table  class="display table table-bordered table-striped" id="dynamic-table">
            <thead>
              <tr>

                
                <th>Nombre del Producto</th>
                <th>Cantidad </th>
                <th>Unidad </th>                       
              </tr>
            </thead>
            <tbody>
              @foreach($cantidad  as $cantidades)
              <tr class="gradeX">
                
                <td>{{$cantidades->nombreprodu}} </td>
                <td>{{$cantidades->cantidad}} </td>            
                <td>{{$cantidades->unidadnombre}} </td> 
                
                

              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>                               
                <th>Nombre del Producto</th>
                <th>Cantidad </th>
                <th>Unidad </th>

              </tr>
            </tfoot>
          </table>
        </div><!--/table-responsive-->
      </div><!--/porlets-content-->
    </div><!--/block-web-->
  </div><!--/col-md-12-->
</div><!--/row-->
</div>


@endsection
