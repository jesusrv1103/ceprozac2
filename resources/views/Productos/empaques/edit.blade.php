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
      <li><a style="color: #808080" href="{{url('empaques')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('empaques')}}">Bancos</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Empaque</strong></h2> 
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

          <form action="{{url('empaques',[$empaque->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
          {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label class="col-sm-3 control-label">Forma de Empaque: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6"> 
                <input name="formaEmpaque" type="text"  onchange="mayus(this);"  class="form-control" maxlength="50" parsley-rangelength="[1,50]"  required value="{{$empaque->formaEmpaque}}" placeholder="Ingrese forma de Empaque..."/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Descripción</label>
              <div class="col-sm-6">
                <textarea name= "descripcion"  onchange="mayus(this);"  class="form-control" maxlength="300" rows="3" resize="none" placeholder="Ejemplo: Contendedor de madera tipo rejilla utilizado para empaquetar pepinos.">{{$empaque->descripcion}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-7 col-sm-5">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{url('/empaques')}}" class="btn btn-default"> Cancelar</a>
              </div>
            </div><!--/form-group-->
          </form>
        </div><!--/porlets-content-->
      </div><!--/block-web-->
    </div><!--/col-md-12-->
  </div><!--/row-->
</div><!--/container clear_both padding_fix-->

@endsection
