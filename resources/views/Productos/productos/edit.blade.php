@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">productos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/productos')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('/productos')}}">Productos</a></li>
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
              <div class="actions"><h3></h3> </div>
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Producto: {{ $productos->nombre}}</strong></h2> 
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
          <form action="{{url('productos', [$productos->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text"  onchange="mayus(this);"  class="form-control" required value="{{ $productos->nombre}}" placeholder="Ingrese nombre del producto"/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Calidad: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <select name="calidad" class="form-control" required>
                 @foreach($calidades as $calidad)
                 @if($calidad->id==$productos->calidad)
                 <option value="{{$calidad->id}}" selected>
                  {{$calidad->nombre}}
                </option>
                @else
                <option value="{{$calidad->id}}">
                  {{$calidad->nombre}}
                </option>
                @endif
                @endforeach
              </select>
              <div class="help-block with-errors"></div>
            </div>
          </div><!--/form-group-->

          <div class="form-group">
            <label class="col-sm-3 control-label">Unidad de Medida <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="unidad_de_Medida" class="form-control" required>  
                @if($productos->unidad_de_Medida=="KILOGRAMOS")
                <option value="KILOGRAMOS" selected>
                  KILOGRAMOS                
                </option>
                <option value="TONELADA">
                  TONELADA                 
                </option>     
                @else 
                <option value="KILOGRAMO" >
                  KILOGRAMOS                
                </option>
                <option value="TONELADA" selected>
                  TONELADA                 
                </option>     
                @endif           
              </select>
              <div class="help-block with-errors"></div>
            </div>
          </div><!--/form-group-->

          <div class="form-group">
            <label class="col-sm-3 control-label">Formato de empaque: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="idFormatoEmpaque" class="form-control" required>
               @foreach($empaques as $empaque)
               @if($empaque->id==$productos->idFormatoEmpaque)
               <option value="{{$empaque->id}}" selected>
                {{$empaque->formaEmpaque}}
              </option>
              @else
              <option value="{{$empaque->id}}">
               {{$empaque->formaEmpaque}}
             </option>
             @endif
             @endforeach
           </select>
           <div class="help-block with-errors"></div>
         </div>
       </div><!--/form-group-->



       <div class="form-group ">
        <label class="col-sm-3 control-label">Porcentaje de humedad</label>
        <div class="col-sm-6">
        <input parsley-type="number" type="text" maxlength="3" required parsley-range="[0, 100]" name="porcentaje_Humedad"   class="form-control mask" value="{{$productos->porcentaje_Humedad}}" onkeypress="return soloNumeros(event);">
        </div>
      </div>


      <input type="text" hidden name="nombreimagen" value="{{$productos->imagen}}">

      <div class="form-group ">
        <label class="col-sm-3 control-label">Imagen</label>
        <div class="col-sm-6">
         <input  type="file" hidden name="imagen"  value="{{$productos->imagen}}" class="form-control"  accept=".jpg, .jpeg, .png">
         @if (($productos->imagen)!="")
         <img src="{{asset('imagenes/productos/'.$productos->imagen)}}" height="100px" width="100px">
         @endif
       </div>
     </div>





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
