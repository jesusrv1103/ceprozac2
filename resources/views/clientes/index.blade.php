@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Clientes</h1>
    <h2 class="">Clientes</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/clientes')}}">Inicio</a></li>
      <li class="active">Clientes</a></li>
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
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Clientes </strong></h2>
              
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
                    <a class="btn btn-sm btn-success tooltips" href="clientes/create" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Cliente"> <i class="fa fa-plus"></i> Registrar </a>

                    <a class="btn btn-sm btn-warning tooltips" href="{{ route('clientes.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

                  </div>

                </b>
              </div>
            </div>
          </div>
        </div>

        <div class="porlets-content">
          <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered " id="hidden-table-info2">
              <thead>


                <tr>
                  <th  >Nombre Completo</th>
                  <th >RFC</th>
                  <th style="display:none;" >Regimen Fiscal</th>
                  <th >Telefono</th>
                  <th>Correo </th>
                  
                  <th style="display:none;">Direccion de Facturación</th>
                  <th style="display:none;">Direccion de Entrega de Embarques</th>
                  <th style="display:none;">Asignación de Volumen de Venta por Año</th>
                  
                  <th style="display:none;">saldocliente</th>
                  <th style="display:none;">CP</th>
                  <th style="display:none;">Contacto</th>
                  <td><center><b>Editar</b></center></td>
                  <td><center><b>Borrar</b></center></td>
                </tr>
              </thead>
              <tbody>
                @foreach($cliente  as $clientes)
                <tr class="gradeX">

                  <td>{{$clientes->nombre}} </td>
                  <td>{{$clientes->rfc}} </td>
                  <td style="display:none;" >{{$clientes->RegimenFiscal}} </td>              
                  <td>{{$clientes->telefono}} </td>
                  <td>{{$clientes->email}}</td>
                  <td style="display:none;" >{{$clientes->direccion_fact}}</td>
                  <td style="display:none;" >{{$clientes->direccion_entr}}</td>
                  <td style="display:none;" >{{$clientes->cantidad_venta}} {{$clientes->volumen_venta}} </td>
                  <td style="display:none;" >${{$clientes-> saldocliente}}</td>
                  <th style="display:none;">{{$clientes->codigo_Postal}}</th>
                  <th style="display:none;">{{$clientes->contacto}}</th>

                  <td>  <a href="{{URL::action('ClienteController@edit',$clientes->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a> 
                  </td>
                  <td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$clientes->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
                  </td>
                </td>
              </td>

            </tr>
            @include('clientes.modal')
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th></th> 
              <th  >Nombre Completo</th>
              <th >RFC</th>
              <th style="display:none;" >Regimen Fiscal</th>
              <th >Telefono</th>
              <th>Correo </th>
              
              <th style="display:none;">Direccion de Facturación</th>
              <th style="display:none;">Direccion de Entrega de Embarques</th>
              <th style="display:none;">Asignación de Volumen de Venta por Año</th>
              
              <th style="display:none;">saldocliente</th>
              <th style="display:none;">CP</th>
              <th style="display:none;">Contacto</th>
              
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
