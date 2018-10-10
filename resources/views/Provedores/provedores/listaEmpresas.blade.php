@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Lista de Empresas</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/empleados')}}">Inicio</a></li>
      <li class="active">Lista de Empresas</a></li>
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
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>LISTA DE EMPRESAS DE: {{$provedor->nombre}} {{$provedor->apellidos}}</strong></h4>
            </div>
            <div class="btn-group pull-right">
              <b>

                <div class="btn-group" style="margin-right: 10px;">
                  <a class="btn btn-sm btn-success tooltips" href="{{URL::action('EmpresaController@create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Proveedor"> <i class="fa fa-plus"></i> Registrar </a>

                  <!--{{$nombre= $provedor->nombre." ". $provedor->apellidos}}-->

                  <a class="btn btn-sm btn-warning tooltips" href="{{URL::action('ProvedorController@descargarEmpresas',[$provedor->id,$nombre])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

                  <a class="btn btn-sm btn-danger tooltips" href="/empresas" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

                </div> 
              </b>
            </div>

          </div>
        </div>
        <div class="porlets-content container clear_both padding_fix">
          @if($empresas==null)
          <div class="alert alert-danger"> <strong>No</strong> <a class="alert-link" href="{{ route('empresas.create')}}">se encuentran empresas registradas </a> a este proveedor. Click Para registrar</div>
          @else
          @foreach($empresas as $empresa)
          <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">{{$empresa->nombre}}</span> 
              </div>
              <div class="panel-body">

                <table class="table table-striped">

                  <tbody>
                    <tr>
                      <th>Nombre Empresa: </th>
                      <td>{{$empresa->nombre}}</td>
                    </tr>
                    <tr>
                      <th>RFC:</th>
                      <td>{{$empresa->rfc}}</td>
                    </tr>
                    <tr>
                      <th>Rgimen Fiscal: </th>
                      <td>{{$empresa->nomRegimen}}</td>
                    </tr>
                    <tr>
                      <th>Telefono:</th>
                      <td>{{$empresa->telefono}}</td>
                    </tr>
                    <tr>
                      <th>Direccion</th>
                      <td>{{$empresa->direccion}}</td>
                    </tr>
                    <tr>
                      <th>Correo: </th>
                      <td>{{$empresa->email}}</td>
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
