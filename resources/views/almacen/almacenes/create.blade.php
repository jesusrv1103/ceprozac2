@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Productos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('productos')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('productos')}}">Productos</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Producto</strong></h2> 
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
          <form action="{{route('productos.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
            {{csrf_field()}}
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text"  onchange="mayus(this);"  class="form-control" required value="" placeholder="Ingrese nombre del producto" />
              </div>
            </div>


          <div class="form-group">
            <label class="col-sm-3 control-label">Unidad de Medida <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="unidad_de_Medida" class="form-control" required>  
               <option value="KILOGRAMOS">
                KILOGRAMOS                
              </option>
              <option value="TONELADA">
                TONELADA                 
              </option>                
            </select>
            <div class="help-block with-errors"></div>
          </div>
        </div><!--/form-group-->





      <div class="form-group">
        <div class="col-sm-offset-7 col-sm-5">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <a href="{{url('/productos')}}" class="btn btn-default"> Cancelar</a>
        </div>
      </div><!--/form-group-->


    </form>
  </div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->

@endsection
<!--
  Schema::create('productos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nombre');
        $table->string('descripcion');
        $table->string('calidad');
        $table->string('unidad_de_Medida');
        $table->string('formato_de_Empaque');
        $table->string('porcentaje_Humedad');
        $table->string('proveedor');
        $table->string('estado');
        $table->timestamps();-->