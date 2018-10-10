@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Lista de Cuentas CEPROZAC</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/empleados')}}">Inicio</a></li>
      <li class="active">Lista de Cuentas CEPROZAC</a></li>
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
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>CUENTAS DE: {{$empresas->nombre}}</strong></h4>
            </div>
            <div class="btn-group pull-right">
              <b>

                <div class="btn-group" style="margin-right: 10px;">
                  <a class="btn btn-sm btn-success tooltips" href="{{URL::action('CuentasEmpresasCEPROZACController@create1',$empresas->id)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva cuenta Bancaria"> <i class="fa fa-plus"></i> Registrar </a>

                  <a class="btn btn-sm btn-warning tooltips"  style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" href="{{URL::action('CuentasEmpresasCEPROZACController@descargarCuentas',[$empresas->id,$empresas->nombre])}}" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

                  <a class="btn btn-sm btn-danger tooltips" href="{{url('/empresasCEPROZAC')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Salir"> <i class="fa fa-times"></i> Salir</a>
                </div>
              </a>
            </b>
          </div>

        </div>
      </div>
      <div class="porlets-content container clear_both padding_fix">
       @if($cuentas==null)
       <div class="alert alert-danger"> <strong>No</strong> se encuentran cuentas registradas a este Empresa. <a class="alert-link" href="{{URL::action('CuentasEmpresasCEPROZACController@create1',$empresas->id)}}">Clic Para registrar</a> </div>

     </b>
   </div>
   @else
   @foreach($cuentas as $cuenta)

   <div class="col-lg-6"> 
    <section class="panel default blue_title h4">
      <div class="panel-heading"><span class="semi-bold">{{$cuenta->num_cuenta}}</span> 
      </div>
      <div class="panel-body">

        <table class="table table-striped">

          <tbody>
            <tr>
              <th>Banco: </th>
              <td>{{$cuenta->nomBanco}}</td>
            </tr>
            <tr>
              <th>Clave Interbancaria: </th>
              <td>{{$cuenta->cve_interbancaria}}</td>
            </tr>
            <tr>
              <th>Numero de Cuenta: </th>
              <td>{{$cuenta->num_cuenta}}</td>
            </tr>
            <tr>
              <th>Saldo: </th>
              <td>{{$cuenta->saldo}}</td>
            </tr>
            <tr>
              <th> Editar</th>
              <td>
                <center>

                  <a href="{{URL::action('CuentasEmpresasCEPROZACController@edit',$cuenta->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
                </center>
              </td>
            </tr>
            <tr>
              <th> Eliminar</th>
              <td>
               <center>
                 <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$cuenta->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
               </center>
             </td>
           </tr>

         </tbody>
       </table>
     </div>
   </section>
 </div>
 @include('EmpresasCeprozac.cuentasBancarias.modal')
 @endforeach
 @endif

</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
