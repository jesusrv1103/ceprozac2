@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class=""> Unidades de Medida</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/unidades_medida')}}">Unidades de Medida</a></li>
      <li><a  style="color: #808080" href="{{url('/unidades_medida')}}"> Unidades de Medida</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Unidad de Medida: {{$unidades->nombre}}</strong></h2> 
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
         <div class="text-success" id='result'>
          @if(Session::has('message'))
          {{Session::get('message')}}
          @endif
        </div>
        <div class="porlets-content">
          <form action="{{url('/unidades_medida', [$unidades->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="nombre" type="text"  onchange="mayus(this);"  value="{{$unidades->nombre}}" class="form-control" required value="" placeholder="Ingrese nombre del Provedor" maxlength="80" parsley-rangelength="[1,70]"/>
                <div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>

              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Cantidad Equivalente: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="cantidad" type="number"  step="any" onchange="mayus(this);"  max="999999" min="0.1" value="{{$unidades->cantidad}}" class="form-control" required  placeholder="Ingrese el Número de Equivalencia" maxlength="2" />
                <div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>

              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">Unidad De Medida: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
               <select name="medida" class="form-control" required>
                 @foreach($nombreUnidadesMedida as $nombre)
                 @if($unidades->idUnidadMedida==$nombre->id)
                 <option value="{{$nombre->id}}" selected>
                   {{$nombre->nombreUnidadMedida}} 
                 </option>
                 @endif
                 <option value="{{$nombre->id}}" >
                   {{$nombre->nombreUnidadMedida}} 
                 </option>
                 @endforeach
               </select>
               <div class="help-block with-errors"></div>
             </div>
           </div><!--/form-group-->



           <div class="form-group">
            <div class="col-sm-offset-7 col-sm-5">
              <button type="submit" onclick="return save();" class="btn btn-primary">Guardar</button>
              <a href="{{url('/unidades_medida')}}" class="btn btn-default"> Cancelar</a>
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