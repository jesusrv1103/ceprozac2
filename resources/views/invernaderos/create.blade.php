@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class=""> Invernaderos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/invernaderos')}}">Invernaderos</a></li>
      <li><a  style="color: #808080" href="{{url('/invernaderos')}}"> Invernaderos</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Registrar Invernadero</strong></h2> 
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
        <form action="{{route('invernaderos.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
          {{csrf_field()}}

          <div class="form-group">
            <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="nombre" type="text"  onchange="mayus(this);"  value="{{Input::old('nombre')}}" class="form-control" onkeypress=" return soloLetras(event);" required value="" placeholder="Ingrese nombre del Provedor" maxlength="80" parsley-rangelength="[1,70]"/>
              <div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>

            </div>
          </div>

                    <div class="form-group">
            <label class="col-sm-3 control-label">Número de Módulos: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="modulos" type="number"  onchange="mayus(this);"  max="99" min="1" value="{{Input::old('modulos')}}" class="form-control" required  placeholder="Ingrese el Número de Módulos" maxlength="2" />
              <div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>

            </div>
          </div>


                    <div class="form-group">
            <label class="col-sm-3 control-label">Ubicación: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="ubicacion" type="text"  onchange="mayus(this);"  max="99" min="1" value="{{Input::old('ubicacion')}}" class="form-control" required  placeholder="Ingrese la Ubicación" maxlength="80" parsley-rangelength="[1,70]"/>
              <div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>

            </div>
          </div>







    

        
        <div class="form-group">
          <div class="col-sm-offset-7 col-sm-5">
            <button type="submit" onclick="return save();" class="btn btn-primary">Guardar</button>
            <a href="{{url('/invernaderos')}}" class="btn btn-default"> Cancelar</a>
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