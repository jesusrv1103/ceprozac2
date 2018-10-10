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
    <h2 class="">Tipo de Proveedores</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('empresas')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('empresas')}}">Tipo de Proveedores</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Tipo de Proveedor</strong></h2> 
            </div>
            <div class="col-md-4">
              <div class="btn-group pull-right">
                <div class="actions"> 
                </div>
              </div>
            </div>    
          </div>
        </div>


        <form action="{{url('tipoProvedores',[$tipo->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
          {{csrf_field()}}

          <input type="hidden" name="_method" value="PUT">
          <div class="form-group">
            <label class="col-sm-3 control-label">Tipo Proveedor: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6"> 
              <input name="nombre" type="text"  onchange="mayus(this);"  class="form-control" maxlength="100" parsley-rangelength="[1,100]"  required  placeholder="Ingrese Rol de Empleado"
              value="{{$tipo->nombre}}"/>
            </div>
          </div>



          <div class="form-group">
            <label class="col-sm-3 control-label">Descripción</label>
            <div class="col-sm-6">
              <textarea name= "descripcion"  onchange="mayus(this);"  class="form-control" maxlength="400" rows="3" resize="none"   placeholder="Ejemplo: Supervisar las labores de la comisión de Higiene y Seguridad y la de Formación y Capacitación." >{{$tipo->descripcion}}</textarea>


            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-7 col-sm-5">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <a href="{{url('/tipoProvedores')}}" class="btn btn-default"> Cancelar</a>
            </div>
          </div><!--/form-group-->
        </form>
      </div><!--/porlets-content-->
    </div><!--/block-web-->
  </div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->

@endsection
