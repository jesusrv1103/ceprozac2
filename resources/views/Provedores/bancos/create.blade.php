<style type="text/css">
  textarea {
    resize: none;
  }
</style>
@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Bancos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('bancos')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('bancos')}}">Bancos</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Registrar Banco</strong></h2> 
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
          <form action="{{route('bancos.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
            {{csrf_field()}}

              <input name="nombreOculto" id="oculto"  hidden  />
            <div class="form-group">
              <label class="col-sm-3 control-label">Bancos: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6"> 
                <input name="nombre" type="text"  onchange="mayus(this);validarBanco();quitarEspacios(this);"  class="form-control" maxlength="30" parsley-rangelength="[1,50]" id="nombre"  required value="" placeholder="Ingrese nombre de el Banco"/>

                <span id="errorNombre" style="color:#FF0000;"></span>
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
              <input type="text" parsley-type="phone" placeholder="Ingrese el número de teléfono de el banco" name="telefono" value="" class="form-control mask" data-inputmask="'mask':'(999) 999-9999'" required>
              </div>
            </div>

              <div class="form-group">
              <label class="col-sm-3 control-label">Sucursal: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6"> 
                <input name="sucursal" type="text"  onchange="mayus(this);"  class="form-control" maxlength="30" parsley-rangelength="[1,50]"  required value="" placeholder="Ingrese nombre de sucursal  Bancaria"/>
              </div>
            </div>
              <div class="form-group">
              <label class="col-sm-3 control-label">Ejecutivo: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6"> 
                <input name="ejecutivo" type="text"  onchange="mayus(this);"  class="form-control" maxlength="30" parsley-rangelength="[1,150]"  required value="" placeholder="Ingrese nombre de  ejecutivo que  correspondiente a la sucursal Bancaria"/>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-offset-7 col-sm-5">
                <button type="submit" class="btn btn-primary" id="submit">Guardar</button>
                <a href="{{url('/rol')}}" class="btn btn-default"> Cancelar</a>
              </div>
            </div><!--/form-group-->
          </form>
        </div><!--/porlets-content-->
      </div><!--/block-web-->
    </div><!--/col-md-12-->
  </div><!--/row-->
</div><!--/container clear_both padding_fix-->

@include('Provedores.bancos.modalReactivar')

@endsection
