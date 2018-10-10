@extends('layouts.principal')
@section('contenido')

<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Proveedores</h1>
    <h2 class="">Proveedores</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/provedores')}}">Inicio</a></li>
      <li class="active"> Proveedores</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Proveedores</strong></h2>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">
                    <a class="btn btn-sm btn-success tooltips" href="provedores/create" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Proveedor"> <i class="fa fa-plus"></i> Registrar </a>

                    <a class="btn btn-sm btn-warning tooltips" href="{{ route('provedores.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

                  </div>
                  
                </a>
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
                <th>Telefono </th>
                <th>Direccion </th>
                <th>Email </th>
                <th>Empresas</th>
                <td><center><b>Editar</b></center></td>
                <td><center><b>Borrar</b></center></td>
              </tr>
            </thead>
            <tbody>
              @foreach($provedores  as $provedores)
              <tr class="gradeA">
                <td>{{$provedores->nombre}} {{$provedores->apellidos}} </td>
                <td>{{$provedores->telefono}} </td>
                <td>{{$provedores->direccion}}</td>
                <td>{{$provedores->email}}</td>
                <td><center><a class="btn btn-info btn-sm" href="{{URL::action('ProvedorController@verEmpresas',$provedores->id)}}" role="button"><i class="fa fa-sign-in"></i></a></center></td>

                <td> 
                  <center>
                    <a href="{{URL::action('ProvedorController@edit',$provedores->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
                  </center>
                </td>
                <td>
                  <center>
                   <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$provedores->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
                 </td>
               </td>
             </tr>
             @include('Provedores.provedores.modal')
             @endforeach
           </tbody>
           <tfoot>
            <tr>
             <th>Nombre </th>
             <th>Telefono </th>
             <th>Direccion </th>
             <th>Email </th>
             
             <th>Empresas</th>
             <th><center><b>Editar</b></center></th>
             <th><center><b>Borrar</b></center></th>
           </tr>
         </tfoot>
       </table>
     </div><!--/table-responsive-->
   </div><!--/porlets-content-->
 </div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
@stop