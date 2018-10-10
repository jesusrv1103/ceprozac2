@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Compras</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/compras/recepcion')}}">Inicio</a></li>
      <li class="active">Recepción de Compras</a></li> 
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
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Compras </strong></h2>
                            <div class="text-success" id='result'>
                @if(Session::has('message'))
                {{Session::get('message')}}
                @endif
              </div>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">
                                      <a class="btn btn-sm btn-success tooltips" href="{{ route('compras.recepcion.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Compra"> <i class="fa fa-plus"></i> Registrar  </a>


                    <a class="btn btn-sm btn-warning tooltips" href="{{route('compras.recepcion.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

                  </div>

                </b>
              </div>
            </div>
          </div>
        </div>
        
        <div class="porlets-content">
          <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info7">
              <thead>
                <tr>
                 <th style="display:none;" >N° </th>
                 <th>Nombre de Recepción </th>
                 <th style="display:none;" >Fecha de Compra </th>
                 <th>Provedor </th>
                 <th style="display:none;" >Transporte </th>
                 <th style="display:none;" >N° Transportes </th>
                 <th>Empresa</th>
                 <th style="display:none;" >Recibio Compra</th>
                 <th style="display:none;" >Observaciones de Compra</th>  
                 <th style="display:none;" >Total de Compra</th>  
                 <th>Producto</th>  
                 <th style="display:none;" >Calidad</th>  
                 <th style="display:none;" >Empaque</th>  
                 <th style="display:none;" >Humedad</th>  
                 <th style="display:none;" >Pacas</th>  
                 <th style="display:none;" >Pacas a Revisar</th>  
                 <th style="display:none;" >Observaciones de Muestreo</th>  
                 <th style="display:none;" >Bascula</th>  
                 <th style="display:none;" >Ticket</th>
                 <th style="display:none;" >Realizo Pesaje</th>
                 <th>KG Recibidos</th>
                 <th>KG Enviados</th>
                 <th style="display:none;" >Diferencia</th>
                 <th style="display:none;" >Observaciones Pesaje</th>  
                 <th>Enviado a Ubicación</th>
                 <th style="display:none;" >Espacio Asignado</th>  
                 <th style="display:none;" >Observaciónes de Ubicación</th> 
                 <th>Fumigación </th>  
                 <th>Ver &nbsp; &nbsp;</th>
                  <th>Imprimir Etiquetas&nbsp; &nbsp;</th>
                    <td><center><b>Editar</b></center></td>  
                 <td><center><b>Borrar</b></center></td>                            
               </tr>
             </thead>
             <tbody>
               @foreach($compra  as $compras)             
               <tr class="gradeX">
                 <td style="display:none;" >{{$compras->id}} </td>
                 <td >{{$compras->nombre}} </td>
                 <td style="display:none;" >{{$compras->fecha_compra}} </td>
                 <td >{{$compras->nombreprov}} </td>
                 <td style="display:none;" >{{$compras->transporte}} </td>
                 <td style="display:none;" >{{$compras->num_transportes}} </td>
                 <td >{{$compras->nomempresa}} </td>
                 <td style="display:none;" >{{$compras->nomemple}} </td>
                 <td style="display:none;" >{{$compras->observacionesc}} </td>
                 <td style="display:none;" >${{$compras->total_compra}}.00 </td>
                 <td >{{$compras->nomprod}} </td>
                 <td style="display:none;" >{{$compras->nomcali}} </td>
                 <td style="display:none;" >{{$compras->nomforma}} </td>
                 <td style="display:none;" >{{$compras->humedad}} </td>
                 <td style="display:none;" >{{$compras->pacas}} </td>
                 <td style="display:none;" >{{$compras->pacas_rev}} </td>
                 <td style="display:none;" >{{$compras->observacionesm}} </td>
                 <td style="display:none;" >{{$compras->nombas}} </td>
                 <td style="display:none;" >{{$compras->ticket}} </td>
                 <td style="display:none;" >{{$compras->nomepleado}} </td>
                 <td >{{$compras->kg_recibidos}} </td>
                 <td >{{$compras->kg_enviados}} </td>
                 <td style="display:none;" >{{$compras->diferencia}} </td>
                 <td style="display:none;" >{{$compras->observacionesb}} </td>
                 <td >{{$compras->nomalma}} </td>
                 <td style="display:none;" >{{$compras->espacio_asignado}} </td>
                 <td style="display:none;" >{{$compras->observacionesu}} </td>
                 <td >{{$compras->fumest}} </td>

                  <td >
       <a href="{{URL::action('RecepcionCompraController@verInformacion',$compras->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>

                               <td><a href="{{URL::action('RecepcionCompraController@invoice',$compras->id)}}" target="_blank" class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i></a>     </td>

                                <td>  <a href="{{URL::action('RecepcionCompraController@edit',$compras->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a> 
                      </td>

                 <td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$compras->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
                 </td>
               </tr>

               @include('Compras.Recepcion.modal')
               @endforeach
             </tbody>
             <tfoot>
              <tr>
               <th></th> 
                 <th style="display:none;" >N° </th>
                 <th>Nombre de Recepción </th>
                 <th style="display:none;" >Fecha de Compra </th>
                 <th>Provedor </th>
                 <th style="display:none;" >Transporte </th>
                 <th style="display:none;" >N° Transportes </th>
                 <th>Empresa</th>
                 <th style="display:none;" >Recibio Compra</th>
                 <th style="display:none;" >Observaciones de Compra</th>  
                 <th style="display:none;" >Total de Compra</th>  
                 <th>Producto</th>  
                 <th style="display:none;" >Calidad</th>  
                 <th style="display:none;" >Empaque</th>  
                 <th style="display:none;" >Humedad</th>  
                 <th style="display:none;" >Pacas</th>  
                 <th style="display:none;" >Pacas a Revisar</th>  
                 <th style="display:none;" >Observaciones de Muestreo</th>  
                 <th style="display:none;" >Bascula</th>  
                 <th style="display:none;" >Ticket</th>
                 <th style="display:none;" >Realizo Pesaje</th>
                 <th>KG Recibidos</th>
                 <th>KG Enviados</th>
                 <th style="display:none;" >Diferencia</th>
                 <th style="display:none;" >Observaciones Pesaje</th>  
                 <th>Enviado a Ubicación</th>
                 <th style="display:none;" >Espacio Asignado</th>  
                 <th style="display:none;" >Observaciónes de Ubicación</th> 
                 <th>Fumigación </th>  
                 <th>Ver &nbsp; &nbsp;</th>
                                   <th>Imprimir Etiquetas &nbsp; &nbsp;</th>
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