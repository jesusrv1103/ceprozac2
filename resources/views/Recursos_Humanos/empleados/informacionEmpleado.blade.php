@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Lista de Empleados</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/empleados')}}">Inicio</a></li>
      <li class="active">Lista de Empleados</a></li>
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
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>INFORMACION DE: {{$empleado->nombre}} {{$empleado->apellidos}}</strong></h4>
            </div>
            <div class="btn-group pull-right">
              <b>

                <div class="btn-group" style="margin-right: 10px;">
                  <a class="btn btn-sm btn-success tooltips" href="{{URL::action('EmpleadoController@create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Empleado"> <i class="fa fa-plus"></i> Registrar </a>

                  <a class="btn btn-sm btn-danger tooltips" href="{{URL::action('EmpleadoController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

                </div> 
              </b>
            </div>

          </div>
        </div>
        <div class="porlets-content container clear_both padding_fix">

          <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Informacion Personal</span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Nombre Empresa: </th>
                      <td>{{$empleado->nombre}}</td>
                    </tr>
                    <tr>
                      <th>Apellidos:</th>
                      <td>{{$empleado->apellidos}}</td>
                    </tr>
                    <tr>
                      <th>Fecha Nacimiento: </th>
                      <td>{{$empleado->fecha_Nacimiento}}</td>
                    </tr>
                    <tr>
                      <th>CURP: </th>
                      <td>{{$empleado->curp}}</td>
                    </tr>
                    <tr>
                      <th>Telefono: </th>
                      <td>{{$empleado->email}}</td>
                    </tr>
                    <tr>
                      <th>Sexo: </th>
                      <td>{{$empleado->telefono}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </section>
          </div>

          <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Informacion Laboral</span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Fecha_Ingreso: </th>
                      <td>{{$empleado->fecha_Ingreso}}</td>
                    </tr>
                    <tr>
                      <th>Numero Seguro Social</th>
                      <td>{{$empleado->numero_Seguro_Social}}</td>
                    </tr>
                    <tr>
                      <th>Fecha Alta Seguro:</th>
                      <td>{{$empleado->fecha_Alta_Seguro}}</td>
                    </tr>
                    <tr>
                      <th>Sueldo Fijo: </th>
                      <td>{{$empleado->sueldo_Fijo}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </section>
          </div>

          <br><br> <br><br> 
          <br><br> 
          <br><br><br><br>
          <br><br><br><br>
          <br><br><br><br>
          <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Roles de Empleado</span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                    @foreach($roles as $rol)
                    <tr>
                      <th>Rol: </th>
                      <td>{{$rol->rol_Empleado}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </section>
          </div>
        </div><!--/porlets-content-->
      </div><!--/block-web-->
    </div><!--/col-md-12-->
  </div><!--/row-->
</div>


@endsection
