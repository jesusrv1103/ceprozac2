@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class=""> Vehículos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/home')}}">Inicio</a></li>
      <li><a  style="color: #808080" href="{{url('/transportes')}}"> Vehículos</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Registrar Tractores</strong></h2> 
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
          <form action="{{url('tractores', [$tractores->id])}}" method="post" class="form-horizontal row-border"  parsley-validate novalidate  >

            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="nombre" type="text"  onchange="mayus(this);quitarEspacios(this);"  class="form-control"  required value="{{$tractores->nombre}}" placeholder="Ingrese nombre  de Vehículo" maxlength="35" parsley-rangelength="[1,35]"/>

              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">Descripción</label>
              <div class="col-sm-6">
                <textarea name= "descripcion"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" maxlength="300" rows="3" draggable="false" placeholder="Ejemplo: Utilizado como una barredora para piso seco o húmedo de  almacenes...">{{$tractores->descripcion}}</textarea>
              </div>
            </div>



            <div class="form-group">
              <div class="col-sm-offset-7 col-sm-5">
                <button type="submit" class="btn btn-primary" id="submit">Guardar</button>
                <a href="{{url('/transportes')}}" class="btn btn-default"> Cancelar</a>
              </div>
            </div><!--/form-group-->
          </form>
        </div><!--/porlets-content-->
      </div><!--/block-web-->
    </div><!--/col-md-12-->
  </div><!--/row-->
</div><!--/container clear_both padding_fix-->


@include('Transportes.transportes.modalReactivar')

@endsection

