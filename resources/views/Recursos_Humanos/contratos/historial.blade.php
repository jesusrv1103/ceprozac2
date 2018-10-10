@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Historial de Contratos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/empleados')}}">Inicio</a></li>
      <li class="active">Historial de Contrato</a></li>
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
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>HISTORIAL DE: {{$empleado->nombre}} {{$empleado->apellidos}} </strong></h4>
            </div>
            <div class="btn-group pull-right">
              <b>
                <div class="btn-group" style="margin-right: 10px;">
                  <a class="btn btn-sm btn-danger tooltips" href="/contratos" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>
                </div> 
              </b>
            </div>

          </div>
        </div>
        <div class="porlets-content container clear_both padding_fix">


          @foreach($historial as $histo)
          <div class="col-lg-6">
            <section class="panel green_border horizontal_border_2">
              <div class="block-web">
                <div class="header">

                  <h3>De {{$histo->fechaInicio}} a {{$histo->fechaFin}}</h3>
                </div>
                <div class="porlets-content" style="display: block;">
                 <p align="justify"><strong>Empresa que contrata:</strong> {{$histo->nombreEmpresa}}</p>
                 <p align="justify"><strong>Fecha Inicio:</strong> {{$histo->fechaInicio}}</p>
                 <p align="justify"><strong>Fecha Fin:</strong> {{$histo->fechaFin}}</p>
                 <p align="justify"><strong>Duracion Contrato:</strong>  
                   {{floor($histo->duracionContrato/30)}} MES(ES) {{$histo->duracionContrato%30}} DIA(S) DE TIEMPO COMPLETO.</p>

                 <p align="justify"><strong>Estado:</strong> {{$histo->estado_Contrato}}</p>


                 </div>
               </div>
             </section>
           </div>
           @endforeach


         </div><!--/porlets-content-->
       </div><!--/block-web-->
     </div><!--/col-md-12-->
   </div><!--/row-->
 </div>



 @endsection
