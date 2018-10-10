@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Empresas</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li  ><a style="color: #808080" href="{{url('/empresas')}}">Inicio</a></li>
      <li class="active">Empresas</a></li>
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
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Empresas</strong></h2>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">
                    <a class="btn btn-sm btn-success tooltips" href="empresas/create" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Empresa"> <i class="fa fa-plus"></i> Registrar </a>

                    
                    <a class="btn btn-sm btn-warning tooltips" href="{{ route('empresas.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

                  </div>

                </b>
              </div>
            </div>
          </div>
        </div>

        <div class="porlets-content">
          <div class="table-responsive">
            <table  cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info1">
              <thead>
                <tr>
                  <th>Nombre </th>
                  <th>RFC </th>
                  <th >Direccion </th>
                  <th style="display:none;">Telefono </th>
                  <th style="display:none;">Correo </th>
                  <th style="display:none;">Regimen Fiscal </th>
                  <th >Proveedor </th>      
                  <th>Cuentas Bancarias</th>         
                  <td><center><b>Editar</b></center></td>
                  <td><center><b>Borrar</b></center></td>
                </tr>
              </thead>
              <tbody>
                @foreach($empresas  as $empresas)
                <tr class="gradeA">
                  <td>{{$empresas->nombre}} </td>
                  <td >{{$empresas->rfc}} </td>
                  <td>{{$empresas->direccion}}</td>
                  <td style="display:none;">{{$empresas->telefono}}</td>
                  <td style="display:none;">{{$empresas->email}}</td>
                  <td style="display:none;">{{$empresas->nombreRegimen}}</td>
                  <td>{{$empresas->nombreProvedor}} {{$empresas->apellidosProvedor}} </td>

                  <td> 
                    <center>
                      <a href="{{URL::action('EmpresaController@verCuentas',$empresas->id)}}" class="btn btn-white btn-sm" role="button"><i class="fa fa-money"></i></a> 
                    </center>
                  </td>


                  <td>  <a href="{{URL::action('EmpresaController@edit',$empresas->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a> 
                  </td>
                  <td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$empresas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
                  </td>
                </td>
              </tr>
              @include('Provedores.empresas.modal')
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th></th>
                <th>Nombre </th>
                <th>RFC </th>
                <th>Direccion </th>
                <th style="display:none;">Telefono </th>
                <th style="display:none;">Correo </th>
                <th style="display:none;">Regimen Fiscal </th>
                <th >Proveedor </th> 
                <th>Cuentas Bancarias</th>
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