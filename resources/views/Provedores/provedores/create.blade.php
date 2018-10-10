@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class=""> Proveedores</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/provedores')}}">Inicio</a></li>
      <li><a  style="color: #808080" href="{{url('/provedores')}}"> Proveedores</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Registrar proveedor</strong></h2> 
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
          <form action="{{route('provedores.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  >
            {{csrf_field()}}

            <input name="nombreOculto" id="ocultoNombre"  hidden  />
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="nombre" type="text"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" onkeypress=" return soloLetras(event);" required  placeholder="Ingrese nombre de proveedor" id="nombre" maxlength="80" parsley-rangelength="[1,70]"      >
                <span id="errorNombre" style="color:#FF0000;"></span>

              </div>
            </div>


            <input name="nombreOculto" id="ocultoApellidos"  hidden  />
            <div class="form-group">
              <label class="col-sm-3 control-label">Apellidos: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="apellidos" type="text"  onchange="mayus(this); validarProvedor();quitarEspacios(this);"  class="form-control" onkeypress=" return soloLetras(event);" required  id="apellidos" placeholder="Ingrese nombre de proveedor" maxlength="80" parsley-rangelength="[1,70]"      >
                <span id="errorNombre" style="color:#FF0000;"></span>

              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input type="text" parsley-type="phone" placeholder="Ingrese el número de teléfono de proveedor" name="telefono" value="" class="form-control mask" data-inputmask="'mask':'(999) 999-9999'" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Direccion: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="direccion" type="text"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" required value="" placeholder="Ingrese Direccion de proveedor" maxlength="150" parsley-rangelength="[1,150]" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="email" name="email" value="" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de proveedor"/>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-offset-7 col-sm-5">
                <button type="submit" class="btn btn-primary" value="submit" id="submit">Guardar</button>
                <a href="{{url('/provedores')}}" class="btn btn-default"> Cancelar</a>
              </div>
            </div><!--/form-group-->
          </form>
        </div><!--/porlets-content-->
      </div><!--/block-web-->
    </div><!--/col-md-12-->
  </div><!--/row-->
</div><!--/container clear_both padding_fix-->

@include('Provedores.provedores.modalReactivar')

@endsection

