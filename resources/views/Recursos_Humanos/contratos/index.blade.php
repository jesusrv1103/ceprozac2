@inject('metodo','CEPROZAC\Http\Controllers\ContratosController')
@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Contratos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/contratos')}}">Inicio</a></li>
      <li class="active">Contratos</a></li> 
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
              <h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Contratos </strong></h2>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">
                    <a class="btn btn-sm btn-success tooltips" href="contratos/create" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Empleado"> <i class="fa fa-plus"></i> Registrar </a>

                    <a class="btn btn-sm btn-warning tooltips" href="{{route('contratos.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

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
              <tr >
                <th  >Nombre Completo</th>
                <th >CURP</th>
                <th >Correo</th>
                <th >Telefono</th>
                <th >Estado</th>
                <th >Historial</th>
                
                <th >Ver</th>
                <th >Descargar</th>
                <td><center><b>Editar</b></center></td>
                <td><center><b>Borrar</b></center></td>
              </tr>
            </thead>
            <tbody>
             @foreach($contratos  as $contrato)
             @if( $metodo->calcularFecha($contrato->fechaFin) <= 0 )
             @if($contrato->estado_Contrato=="En curso")
             {{ $metodo->actualizarEstado($contrato->idContrato) }}
             @endif
             <tr class="gradeX" >
               <td style="background-color: #FFE4E1;" >
                 {{$contrato->nombre}} {{$contrato->apellidos}}
               </td>
               <td style="background-color: #FFE4E1;" >{{$contrato->curp}}</td>
               <td style="background-color: #FFE4E1;" >{{$contrato->email}}</td>
               <td style="background-color: #FFE4E1;" >{{$contrato->telefono}}</td>
               <td style="background-color: #FFE4E1;" >Contrato vencido hace {{ abs($metodo->calcularFecha($contrato->fechaFin))}} dias</td>
               <td style="background-color: #FFE4E1;"> 
                <center>
                  <a href="{{URL::action('ContratosController@historial',$contrato->idEmpleado)}}" class="btn btn-link btn-sm" role="button"><i class="fa fa-calendar-o" ></i></a>
                </center>
              </td>

              <td style="background-color: #FFE4E1;" >
               <center>
                 <a href="{{URL::action('ContratosController@verInformacion',$contrato->idContrato)}}" class="btn btn-info btn-sm" role="button"><i class="fa fa-eye" ></i></a>
               </center>
             </td>

             <td style="background-color: #FFE4E1;" >
               <center>
                 <a href="{{URL::action('ContratosController@pdf',$contrato->idContrato)}}" class="btn btn-warning btn-sm" role="button"><i class="fa fa-download"></i></a>
               </center>
             </td>

             <td style="background-color: #FFE4E1;"> 
              <a href="{{URL::action('ContratosController@edit',$contrato->idContrato)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>
            </td> 
          </td>
          <td style="background-color: #FFE4E1;">
            <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$contrato->idContrato}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
          </td>
        </tr>
        @else
        <tr class="gradeX example" >
         <td >{{$contrato->nombre}} {{$contrato->apellidos}} </td>

         <td >{{$contrato->curp}}</td>
         <td  >{{$contrato->email}}</td>
         <td >{{$contrato->telefono}}</td>
         <td >Contrato por vencer en {{ $metodo->calcularFecha($contrato->fechaFin)}} dias</td>
         <td>
           <center>

            <a href="{{URL::action('ContratosController@historial',$contrato->idEmpleado)}}" class="btn btn-link btn-sm" role="button"><i class="fa fa-calendar-o" ></i></a>
          </center>

        </td>

        <td >
         <center>
           <a href="{{URL::action('ContratosController@verInformacion',$contrato->idContrato)}}" class="btn btn-info btn-sm" role="button"><i class="fa fa-eye" ></i></a>
         </center>
       </td>
       <td >
         <center>
           <a href="{{URL::action('ContratosController@pdf',$contrato->idContrato)}}" class="btn btn-warning btn-sm" role="button"><i class="fa fa-download"></i></a>
         </center>
       </td>
       <td >  <a href="{{URL::action('ContratosController@edit',$contrato->idContrato)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>
       </td> 
     </td>
     <td > <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$contrato->idContrato}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
     </td>
   </tr>
   @endif
   @include('Recursos_Humanos.contratos.modal')

   @endforeach
 </tbody>
 <tfoot>
  <tr>

    <th >Nombre Completo</th>

    <th >CURP </th>
    <th > Correo </th>
    <th >Telefono </th>

    <th >Estado</th>
    <th >Historial</th>
    <th >Ver</th>
    <th >Descargar</th>
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


<script>

  $('.minimize').click(function(e){
    var h = $(this).parents(".header");
    var c = h.next('.porlets-content');
    var p = h.parent();

    c.slideToggle();

    p.toggleClass('closed');

    e.preventDefault();
  });

  $('.refresh').click(function(e){
    var h = $(this).parents(".header");
    var p = h.parent();
    var loading = $('<div class="loading"><i class="fa fa-refresh fa-spin"></i></div>');

    loading.appendTo(p);
    loading.fadeIn();
    setTimeout(function() {
      loading.fadeOut();
    }, 1000);

    e.preventDefault();
  });



</script>



@endsection
