@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Almacen</h1>
    <h2 class="">Productos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li  ><a style="color: #808080" href="{{url('/productos')}}">Inicio</a></li>
      <li class="active">Productos</a></li>
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
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Productos</strong></h2>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">
                    <a class="btn btn-sm btn-success tooltips" href="productos/create" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Agregar Nuevo Producto"> <i class="fa fa-plus"></i> Agregar </a>
                    <a class="btn btn-sm btn-warning tooltips" href="{{ route('productos.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
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

                  <th>Nombre </th>


                  <th >Unidad de Medida</th>
                  <th >Formato de Empaque</th>
                  <th >% de humedad</th>
                  <th >Imagen</th>
                  <th><center><b>Editar</b></center></th>
                  <th><center><b>Borrar</b></center></th>
                </tr>
              </thead>
              <tbody>
               @foreach($producto  as $producto)
               <tr class="gradeA">

                <td>{{$producto->nombre}} {{$producto->nomCalidad}}</td>
                <td >{{$producto->unidad_de_Medida}}</td>
                <td >{{$producto->formaEmpaque}}</td>
                <td >{{$producto->porcentaje_Humedad}}%</td> 
                
                <td >
                  @if (($producto->imagen)!="")
                  <img src="{{asset('imagenes/productos/'.$producto->imagen)}}" alt="{{$producto->nombre}}" height="100px" width="100px" class="img-thumbnail">
                  @else
                  No Hay Imagen Disponible
                  @endif
                </td>   
                <td>  <a href="{{URL::action('ProductosController@edit',$producto->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a> 
                </td>
                <td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$producto->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
                </td>
              
            </tr>
            @include('Productos.productos.modal')
            @endforeach
          </tbody>
          <tfoot>
            <tr>

              <th>Nombre </th>

              <th >Unidad de Medida</th>
              <th >Formato de Empaque</th>
              <th >% de humedad</th>
              <th>Imagen</th>
              <th><center><b>Editar</b></center></th>
              <th><center><b>Borrar</b></center></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>            
    @endsection