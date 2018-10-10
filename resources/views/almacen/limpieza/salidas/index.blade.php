@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Almacén de Materiales de Limpieza</h1>
    <h2 class="">Salidas</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('almacenes/limpieza')}}">Inicio</a></li>
      <li class="active">Salidas de Almacén de Materiales de Limpieza</a></li>
    </ol>
  </div>
</div>

<div class="text-success" id='result'>
  @if(Session::has('message'))
  {{Session::get('message')}}
  @endif
</div>

<div class="container clear_both padding_fix">
  <div class="row">
    <div class="col-md-12">
      <div class="block-web">
        <div class="header">
          <div class="row" style="margin-top: 15px; margin-bottom: 12px;">
            <div class="col-sm-7">
              <div class="actions"> </div>
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Salidas de Almacén de Materiales de Limpieza </strong></h2>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">
                   <a class="btn btn-sm btn-success tooltips" href="{{ route('almacen.salidas.limpieza.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Salida"> <i class="fa fa-plus"></i> Registrar Salida de Almacén </a>

                   <a class="btn btn-sm btn-warning tooltips" href="{{ route('almacen.limpieza.salidas.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>



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
                <th>N°Salida </th>
                <th>Nombre de Material</th>
                <th> Cantidad</th>
                    <th>Cantidad Total</th>
                <th>Destino </th>
                <th>Entrego </th>
                <th>Recibio</th>
                <th>Tipo de Movimiento</th>  
                <th>Fecha de Salida</th> 
                <td><center><b>Editar</b></center></td>   
                <td><center><b>Borrar</b></center></td>                            
              </tr>
            </thead>
            <tbody>
              @foreach($salida  as $salidas)
              <tr class="gradeA">
                <td>{{$salidas->id}} </td>
                <td>{{$salidas->nombre}} </td>
                <td>{{$salidas->medidaaux}}</td>
                <td>{{$salidas->cantidad}} {{$salidas->medida}}</td>
                <td>{{$salidas->destino}} </td>
                <td>  {{$salidas->emp1}} {{$salidas->ap1}}</td>
                <td> {{$salidas->emp2}} {{$salidas->ap2}}</td>
                <td>{{$salidas->tipo_movimiento}} </td>
                <td>{{$salidas->fecha}} </td>
                <td> 
                  <center>
                  <a href="{{URL::action('SalidasAlmacenLimpiezaController@edit',$salidas->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
                  </center>
                </td>
                <td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$salidas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
                </td>
              </td>
            </td>

          </tr>
          @include('almacen.limpieza.salidas.modal')


          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>N°Salida </th>
            <th>Nombre de Material</th>
            <th> Cantidad</th>
                    <th>Cantidad Total</th>
            <th>Destino </th>
            <th>Entrego </th>
            <th>Recibio</th>
            <th>Tipo de Movimiento</th>  
            <th>Fecha de Salida</th>
            <td><center><b>Editar</b></center></td>   
            <td><center><b>Borrar</b></center></td> 
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