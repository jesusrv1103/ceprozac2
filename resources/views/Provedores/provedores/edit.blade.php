@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Provedores</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/provedores')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('/provedores')}}">Empresas</a></li>

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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar proveedor: {{ $provedores->nombre}}</strong></h2> 
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
          <form action="{{url('provedores', [$provedores->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate >
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT" />

            <div class="form-group">
              <input name="nombreOculto" id="ocultoNombre" value="{{$provedores->nombre}}" hidden  />
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text" id="nombre" onblur="validarProvedor();"   onchange="mayus(this);quitarEspacios(this);"  class="form-control" onkeypress=" return soloLetras(event);" required value="{{$provedores->nombre}}" maxlength="70" parsley-rangelength="[1,70]" placeholder="Ingrese nombre de la empresa"/>
                <span id="errorNombre" style="color:#FF0000;"></span>
              </div>
            </div>

            <div class="form-group">
              <input name="apellidoOculto" id="ocultoApellidos" value="{{$provedores->apellidos}}" hidden  />
              <label class="col-sm-3 control-label">Apellidos: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="apellidos" type="text" id="apellidos"  onchange="mayus(this); quitarEspacios(this);" onblur="validarProvedor();"  class="form-control" onkeypress=" return soloLetras(event);" required value="{{$provedores->apellidos}}" maxlength="70" parsley-rangelength="[1,70]" placeholder="Ingrese nombre de la empresa"/>
                <span id="errorNombre" style="color:#FF0000;"></span>
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input type="text" parsley-type="phone" placeholder="Ingrese el número de teléfono de la empresa" name="telefono" value="{{ $provedores->telefono}}" class="form-control mask" data-inputmask="'mask':'(999) 999-9999'" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Direccion: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="direccion" type="text"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" required value="{{ $provedores->direccion}}" splaceholder="Ingrese Direccion de la empresa" maxlength="150" parsley-rangelength="[1,150]" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="email" name="email" value="{{ $provedores->email}}" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de la empresa" maxlength="30" parsley-rangelength="[1,30]"/>

              </div>
            </div>



            <div class="form-group">
              <div class="col-sm-offset-7 col-sm-5">
                <button type="submit" class="btn btn-primary" id="submit">Guardar</button>
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

