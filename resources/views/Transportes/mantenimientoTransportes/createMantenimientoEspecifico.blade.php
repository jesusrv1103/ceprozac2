@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class=""> Mantenimiento Tractores</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/home')}}">Inicio</a></li>
      <li><a  style="color: #808080" href="{{url('/mantenimientoTractores')}}"> Mantenimiento Tractores</a></li>
    </ol>
  </div>
</div>
<div class="container clear_both padding_fix">
  <div class="row">
    <div class="col-md-12">
      <div class="block-web">
        <div class="header">
          <div class="row" style="margin-top: 15px; margin-bottom: 12px;">
            <div class="col-sm-8">
              <div class="actions"> </div>
              <h2 class="content-header" style="margin-top: -5px;"><strong>Registrar Mantenimiento a Vehiculo</strong></h2> 
            </div>
            <div class="col-md-4">
              <div class="btn-group pull-right">
                <div class="actions"> 
                </div>
              </div>
            </div>    
          </div>
        </div>
        <div class="porlets-content">
          <form action="{{route('mantenimiento.store')}}" method="post" class="form-horizontal row-border"  parsley-validate novalidate>
            {{csrf_field()}}

            <div class="form-group">
             <label class="col-sm-3 control-label"> Vehiculo: <strog class="theme_color">*</strog></label>
             <div class="col-sm-6">
              <select name="idTransporte" class="form-control" required>  

                
                @foreach($transportes as $transporte)
                @if($transporteEspecifico->id == $transporte->id)
                <option value="{{$transporte->id}}" selected>
                 {{$transporte->nombre_Unidad}}
               </option>
               @else 
               <option value="{{$transporte->id}}" >
                 {{$transporte->nombre_Unidad}}
               </option>
               @endif
               @endforeach              
             </select>
             <div class="help-block with-errors"></div>
           </div>
         </div><!--/form-group-->

         
         <div class="form-group">
          <label class="col-sm-3 control-label">Concepto: <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">

            <input name="concepto" type="text"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" onkeypress=" return soloLetras(event);" required  placeholder="Ingrese concepto de el Mantenimiento" maxlength="35" parsley-rangelength="[1,35]"/>

          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Descripción</label>
          <div class="col-sm-6">
            <textarea name= "descripcion"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" maxlength="300" rows="3" resize="none" placeholder="Ejemplo: Cambio de puntas de inyección d‑ Revisión de candelas de precalentamiento.."></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Fecha: <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">

           <input name="fecha" type="text" class="form-control mask" data-inputmask="'alias': 'date'" required parsley-regexp="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$">
         </div>
       </div>



       <div class="form-group">
         <label class="col-sm-3 control-label">Responsable Vehiculo: <strog class="theme_color">*</strog></label>
         <div class="col-sm-6">
           <select name="idChofer" class="form-control" required>
             @foreach($operadores as $operador)
             <option value="{{$operador->id}}">

               {{$operador->nombre}} {{$operador->apellidos}}
             </option>
             @endforeach
           </select>
           <div class="help-block with-errors"></div>
         </div>
       </div><!--/form-group-->

       <div class="form-group">
        <label class="col-sm-3 control-label">Encargado de Mantenimiento: <strog class="theme_color">*</strog></label>
        <div class="col-sm-6">
          <select name="idMecanico" class="form-control" required>
           @foreach($encargados_mantenimiento as $mantenimiento)


           <option value="{{$mantenimiento->id}}">
             {{$mantenimiento->nombre}} {{$mantenimiento->apellidos}}
           </option>
           @endforeach
         </select>
         <div class="help-block with-errors"></div>
       </div>
     </div><!--/form-group-->


     <div class="form-group">
      <div class="col-sm-offset-7 col-sm-5">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{url('/mantenimiento')}}" class="btn btn-default"> Cancelar</a>
      </div>
    </div><!--/form-group-->
  </form>
</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@endsection

