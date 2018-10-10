
@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Empleados</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/empleados')}}">Inicio</a></li>
      <li class="active">Empleados</a></li> 
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
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Empleados </strong></h2>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">
                    <a class="btn btn-sm btn-success tooltips" href="empleados/create" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Empleado"> <i class="fa fa-plus"></i> Registrar </a>

                    <a class="btn btn-sm btn-warning tooltips" href="{{route('empleados.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

                  </div>

                </b>
              </div>
            </div>
          </div>
        </div>

        <div class="porlets-content">
          <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
              <thead>
                <tr>
                  <th  >Nombre Completo</th>
                  <th style="display:none;" >Fecha_Ingreso</th>
                  
                  <th style="display:none;">Fecha_Alta</th>
                  <th style="display:none;">NSS</th>
                  <th style="display:none;">Fecha_Nacimiento</th>
                  <th >CURP</th>
                  <th style="display:none;">email</th>
                  <th >Telefono</th>
                  <th style="display:none;">sexo</th>
                  <th style="display:none;">sueldo</th>
                  <th>Ver &nbsp; &nbsp;</th>
                  
                  <td><center><b>Editar</b></center></td>
                  <td><center><b>Borrar</b></center></td>
                </tr>
              </thead>
              <tbody>
                @foreach($empleados  as $empleados)
                <tr class="gradeX">
                  <td >{{$empleados->nombre}} {{$empleados->apellidos}} </td>
                  
                  <td style="display:none;" >{{$empleados->fecha_Ingreso}}</td>
                  <td style="display:none;" >{{$empleados->fecha_Alta_Seguro}}</td>
                  <td style="display:none;">{{$empleados->numero_Seguro_Social}}</td>
                  <td style="display:none;">{{$empleados->fecha_Nacimiento}}</td>
                  <td >{{$empleados->curp}}</td>
                  <td style="display:none;" >{{$empleados->email}}</td>
                  <td >{{$empleados->telefono}}</td>

                  <td style="display:none;" >{{$empleados->sueldo_Fijo}}</td>
                  <td style="display:none;"   >{{$empleados->sexo}}</td>
                  <td >
                    <a href="{{URL::action('EmpleadoController@verInformacion',$empleados->id)}}" class="btn btn-info btn-sm" role="button"><i class="fa fa-eye"></i></a>
                  </td>
                  
                  <td>   <a href="{{URL::action('EmpleadoController@edit',$empleados->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>
                  </td> 
                </td>
                <td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$empleados->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
                </td>
              </tr>
              @include('Recursos_Humanos.empleados.modal')
              @include('Recursos_Humanos.empleados.rolesmodal')
              @endforeach
            </tbody>
            <tfoot>
              <tr>
               <th></th> 
               <th >Nombre Completo</th>
               <th style="display:none;">fecha_Ingreso</th>
               <th style="display:none;">Fecha Alta</th>
               <th style="display:none;">NSS</th>
               <th style="display:none;">Fecha Nacimiento </th>
               <th >CURP </th>
               <th style="display:none;"> email </th>
               <th >Telefono </th>
               <th style="display:none;">sexo </th>
               <th style="display:none;">suedlo fijo </th>


               <th >Ver &nbsp; &nbsp;</th>
               

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
