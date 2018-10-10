@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Almacén de Materiales de Limpieza</h1>
    <h2 class="">Entradas</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('almacenes/limpieza')}}">Inicio</a></li>
      <li class="active">Entradas de Almacén de Materiales de Limpieza</a></li>
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
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Entradas de Almacén de Materiales de Limpieza </strong></h2>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">
                   <a class="btn btn-sm btn-success tooltips" href="{{ route('almacen.entradas.limpieza.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Entrada"> <i class="fa fa-plus"></i> Registrar Entrada de Almacén </a>

                   <a class="btn btn-sm btn-warning tooltips" href="{{ route('almacen.limpieza.entradas.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>



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
                <th>N°Compra </th>
                <th>Fecha de Entrada</th>  
                <th>Proveedor de Material </th>
                <th>N°Factura </th> 
                <th>Nombre de Material</th>
                <th>Cantidad</th>
                <th>Total Cantidad</th>
                <th>Precio Unitario </th>
                <th>IVA </th>
                <th>Subtotal </th>
                <th>Total de Compra </th>
                <th>Tipo de Moneda </th>
                <th>Comprador</th>
                <td><center><b>Editar</b></center></td>
                <td><center><b>Borrar</b></center></td>                            
              </tr>
            </thead>
            <tbody>
              @foreach($entrada  as $entradas)
              <tr class="gradeA">
                <td>{{$entradas->id}} </td>
                <td>{{$entradas->fecha}} </td>
                <td>{{$entradas->prov}} </td>
                <td>{{$entradas->factura}} </td>
                <td>{{$entradas->nombremat}} </td>
                <td>{{$entradas->medidaaux}}</td>
                <td>{{$entradas->cantidad}} {{$entradas->medida}}</td>
                <td>${{$entradas->p_unitario}} </td>
                <td>${{$entradas->iva}} </td>
                <td>${{$entradas->importe}} </td>
                <td>${{$entradas->total}} </td>
                <td>${{$entradas->moneda}} </td>
                <td>{{$entradas->emp}} </td>
                <td>  <a href="{{URL::action('EntradasAlmacenLimpiezaController@edit',$entradas->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a> 
                </td>
                <td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$entradas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
                </td>
              </td>
            </td>

          </tr>
          @include('almacen.limpieza.entradas.modal')


          @endforeach
        </tbody>
        <tfoot>
          <tr>
                <th>N°Compra </th>
                <th>Fecha de Entrada</th>  
                <th>Proveedor de Material </th>
                <th>N°Factura </th> 
                <th>Nombre de Material</th>
                <th>Cantidad</th>
                <th>Total Cantidad</th>
                <th>Precio Unitario </th>
                <th>IVA </th>
                <th>Subtotal </th>
                <th>Total de Compra </th>
                <th>Tipo de Moneda </th>
                <th>Comprador</th>
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