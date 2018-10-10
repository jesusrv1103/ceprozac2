@extends('layouts.principal')
@section('contenido')
<html>
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Clientes</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/clientes')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('/clientes')}}">Clientes</a></li>   
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Cliente: {{ $clientes->nombre}}</strong></h2> 
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
          <form action="{{url('clientes', [$clientes->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text"  maxlength="30" onchange="mayus(this);quitarEspacios(this);"  class="form-control"  value="{{$clientes->nombre}}"  onkeypress=" return soloLetras(event);" required value="" placeholder="Ingrese nombre de el Cliente"/>
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="rfc" value="{{$clientes->rfc}}"  maxlength="20" id="RFC"  type="text" required parsley-regexp="([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})"   required parsley-rangelength="[12,13]"  onkeyup="mayus(this);"  class="form-control"   class="form-control" required placeholder="Ingrese RFC del Cliente"/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Contacto: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="contacto" type="text"   maxlength="30" onchange="mayus(this);quitarEspacios(this);"  class="form-control" onkeypress=" return soloLetras(event);" required value="{{$clientes->contacto}}" placeholder="Ingrese nombre de el contacto"/>
                <div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Regimen Fiscal: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <select name="id_Regimen_Fiscal" >
                 @foreach($regimenes as $regimen)
                 @if($regimen->id == $clientes->fiscal)
                 <option value='{{$regimen->id}}' selected>
                   {{$regimen->nombre}}
                 </option>   
                 @else
                 <option value='{{$regimen->id}}'>
                   {{$regimen->nombre}}
                 </option>
                 @endif
                 @endforeach
               </select>
             </div>
           </div>



           <div class="form-group">
            <label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <input name="telefono" type="text" placeholder="Ingrese el número de teléfono del cliente"  value="{{ $clientes->telefono}}"  class="form-control mask" data-inputmask="'mask':'(999) 999-9999'">
            </div>
          </div>



          <div class="form-group">
            <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="email" name="email" value="{{ $clientes->email}}" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de el cliente"/>

            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Codigo Postal: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
            <input name="codigo_Postal" type="text"  value="{{$clientes->codigo_Postal}}" maxlength="5" quitarEspacios(this);"  class="form-control"  required value="" placeholder="Ingrese Codigo Postal"/>

            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Dirección de Facturación: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <input name="direccion_fact" type="text"  maxlength="40" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="{{ $clientes->direccion_fact}}" placeholder="Ingrese la Direccion Fiscal del Cliente"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Dirección de Entrega de Embarques: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <input name="direccion_entr" type="text"  maxlength="40" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);"  value="{{ $clientes->direccion_entr}}" placeholder="Ingrese la Direccion de Entrega de Embarque del Cliente"/>
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-3 control-label">Asignación de Volumen de Venta por Año: <strog class="theme_color">*</strog></label>
            <div class="col-sm-2">
              <input name="cantidad_venta" value="{{ $clientes->cantidad_venta}}" maxlength="9" type="number" value="1000" min="1" max='9999999' step="10" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="" placeholder="Ingrese el Volumen de Venta por Año" onkeypress=" return soloNumeros(event);" />
            </div>      
            
          </div>  




          <div class="form-row">    
            <label class="col-sm-3 control-label">Nuevo Saldo Del Cliente: <strog class="theme_color">*</strog></label>
            <div class="col-sm-2">
              <div class="input-group">
               <div class="input-group-addon">$</div>


               <input name="saldocliente" maxlength="9" type="number" value="1000.00" value="{{ $clientes->saldocliente}}" min="1" max='9999999' step="100" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="" placeholder="Ingrese el Saldo Inicial" onkeypress=" return soloNumeros(event);"/>
             </div>
           </div>
         </div>
         <!--/form-group-->



         <div class="form-group">
          <div class="col-sm-offset-7 col-sm-5">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="/clientes" class="btn btn-default"> Cancelar</a>
          </div>
        </div><!--/form-group-->
      </form>
    </div><!--/porlets-content-->
  </div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->
</html> 
@endsection

