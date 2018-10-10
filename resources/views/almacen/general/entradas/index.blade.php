@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>{{$almacen2->nombre}}</h1>
    <h2 class="">Entradas</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('almacen/general')}}">Inicio</a></li>
      <li class="active">Entradas de: {{$almacen2->nombre}}</a></li>
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
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Entradas de: {{$almacen2->nombre}} </strong></h2>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">
                   <a class="btn btn-sm btn-success tooltips" href="{{ route('almacen.general.entradas.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Entrada"> <i class="fa fa-plus"></i> Registrar Entrada de Almacén </a>

                   <a class="btn btn-sm btn-warning tooltips" href="{{ route('almacen.agroquimicos.entradas.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>



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
                  <th>N° Entrada </th>
                  <th>Fecha de Entrada</th>  
                  <th>Nombre de Lote </th>
                  <th>Producto </th>
                  <th>Calidad</th>
                  <th>Empaque</th>
                    <th>Cantidad de Entrada</th>
                     <th>Origen </th>

                  <td><center><b>Editar</b></center></td>                    
                  <td><center><b>Borrar</b></center></td>                            
                </tr>
              </thead>
              <tbody>
                @foreach($almacen  as $entradas)
                <tr class="gradeA">
                  <td>{{$entradas->id}} </td>
                  <td>{{$entradas->fecha}} </td>
                   <td>{{$entradas->nombre_lote}} </td>
                   <td>{{$entradas->nombreprodu}} </td>
                   <td>{{$entradas->calinombre}} </td>
                   <td>{{$entradas->empnombre}}</td>
                   <td>{{$entradas->kg_entrada}} {{$entradas->medida}} </td>
                   <td>{{$entradas->origen}} </td>

                                       <td> 
                  <center>
                    <a href="{{URL::action('entradas_almacengeneralController@edit',$entradas->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
                    </center>
                  </td>
                  <td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$entradas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
                  </td>
                </td>
                </td>

              </tr>
              @include('almacen.agroquimicos.entradas.modal')
              
            
                 @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th>N° Entrada </th>
                  <th>Fecha de Entrada</th>  
                  <th>Nombre de Lote </th>
                  <th>Producto </th>
                  <th>Calidad</th>
                  <th>Empaque</th>
                    <th>Cantidad de Entrada</th>
                     <th>Origen </th>
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