@extends('layouts.principal')
@section('contenido')
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Registrar Cliente</strong></h2>
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


          <form method="post" action="{{url('clientes/validarmiformulario')}}" class="form-horizontal row-border" parsley-validate novalidate >




            {{csrf_field()}}
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text"  value="{{Input::old('nombre')}}" maxlength="30" onchange="mayus(this);quitarEspacios(this);"  class="form-control" onkeypress=" return soloLetras(event);" required value="" placeholder="Ingrese nombre de el Cliente"/>
                <div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>
              </div>
            </div>


            <input name="rfcOculto" id="oculto"  hidden  />
            <div class="form-group">
              <label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="rfc" id="rfc"  maxlength="20" type="text" required parsley-regexp="([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})"   required parsley-rangelength="[12,13]"  onkeyup="mayus(this);validarcliente();"  class="form-control"   class="form-control" required placeholder="Ingrese RFC del Cliente"/>
                <div class="text-danger" id='error_rfc'>{{$errors->formulario->first('rfc')}}</div>
                <span id="errorRFC" style="color:#FF0000;"></span>
              </div>
            </div>



            <div class="form-group">
              <label class="col-sm-3 control-label">Contacto: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="contacto" type="text"  value="{{Input::old('contacto')}}" maxlength="30" onchange="mayus(this);quitarEspacios(this);"  class="form-control" onkeypress=" return soloLetras(event);" required value="" placeholder="Ingrese nombre de el contacto"/> 
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">Regimen Fiscal: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <select name="id_Regimen_Fiscal" class="form-control select2"  value="{{Input::old('fiscal')}}">

                  @foreach($regimen_fiscal as $regimen)
                  <option value='{{$regimen->id}}'>
                    {{$regimen->nombre}}
                  </option>
                  @endforeach
                </select>

              </div>
            </div>




            <div class="form-group">
              <label class="col-sm-3 control-label">Telefono:</label>
              <div class="col-sm-6">
                <input name="telefono" type="text" value="{{Input::old('telefono')}}" placeholder="Ingrese el número de teléfono del cliente"   class="form-control mask" data-inputmask="'mask':'(999) 999-9999'">
                <div class="text-danger" id='error_telefono'>{{$errors->formulario->first('telefono')}}</div>
              </div>
            </div>



            <div class="form-group">
              <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="email" name="email" value="{{Input::old('email')}}" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de el cliente"/>
                <div class="text-danger" id='error_email'>{{$errors->formulario->first('email')}}</div>
              </div>    
            </div>



            <div class="form-group">
              <label class="col-sm-3 control-label">Codigo Postal: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
              <input name="codigo_Postal" type="text"  value="{{Input::old('codigo_Postal')}}" maxlength="30"   class="form-control"  required value="" placeholder="Ingrese Codigo Postal"/>
                <div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">Dirección de Facturación: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="direccion_fact" type="text" value="{{Input::old('direccion_fact')}}" maxlength="200" onchange="mayus(this);"  class="form-control"  required value="" placeholder="Ingrese la Dirección de Facturación"/>
                <div class="text-danger" id='error_dreccion_fac'>{{$errors->formulario->first('direccion_fact')}}</div>
              </div>
            </div>



            <div class="form-group">
              <label class="col-sm-3 control-label">Dirección de Entrega de Embarques: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="direccion_entr" type="text"  value="{{Input::old('direccion_entr')}}" maxlength="200" onchange="mayus(this);"  class="form-control"  required value="" placeholder="Ingrese la Dirección de Entrega de Embarques"/>
                <div class="text-danger" id='error_dreccion_fac'>{{$errors->formulario->first('direccion_entr')}}</div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Asignación de Volumen de Venta por Año: <strog class="theme_color">*</strog></label>
              <div class="col-sm-3">
                <input name="cantidad_venta" maxlength="9" type="text" value="{{Input::old('cantidad_venta')}}" value="1000" min="1" max='9999999' step="10" data-number-to-fixed="2" data-number-stepfactor="200" class="form-control currency" required value="" placeholder="Volumen de Venta por Año" onkeypress=" return soloNumeros(event);" />
                <div class="text-danger" id='error_cantidad'>{{$errors->formulario->first('cantidad_venta')}}</div>
              </div>      

              <div class="form-group">
               <div class="col-sm-2">
                 <select name="volumen_venta" value="{{Input::old('volumen_venta')}}">
                   @if(Input::old('volumen_venta')=="Kilogramos")
                   <option value='Kilogramos' selected>Kilogramos
                   </option>
                   <option value="Toneladas">Toneladas</option>
                   @else
                   <option value='Toneladas' selected>Toneladas
                   </option>
                   <option value="Kilogramos">Kilogramos</option>
                   @endif
                 </select>

               </div>   
             </div>
           </div>





           <div class="form-row">    
            <label class="col-sm-3 control-label">Saldo Inical Del Cliente: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <div class="input-group">
               <div class="input-group-addon">$</div>


               <input name="saldocliente" maxlength="9" type="number" value="{{Input::old('saldocliente')}}" min="0" max='9999999' step="100" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="" placeholder="Ingrese el Saldo Inicial" onkeypress=" return soloNumeros(event);"/>
             </div>
           </div>
         </div>

         <br> <br>
         <br> <br>



         <div class="form-group">
          <div class="col-sm-offset-7 col-sm-5">
            <button type="submit" value="submit" id="submit" class="btn btn-primary">Guardar</button>
            <a href="{{url('/clientes')}}" class="btn btn-default"> Cancelar</a>
          </div>
        </div><!--/form-group-->
      </form>
    </div><!--/porlets-content-->
  </div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->




@include('clientes.modalreactivar')
@endsection
