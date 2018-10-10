@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Empaques</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('almacenes/empaque')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('almacenes/empaque')}}">Almacén de Empaques</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Registrar Nuevo Empaque</strong></h2>
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
        <form action="{{route('almacenes.empaque.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
          {{csrf_field()}}



          <div class="form-group">
            <label class="col-sm-3 control-label"> Nombre del Empaque: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="nombre" class="form-control" value="{{Input::old('nombre')}}" required>  
                @foreach($empaque as $empaques)
                <option value="{{$empaques->formaEmpaque}}">
                 {{$empaques->formaEmpaque}}
               </option>
               @endforeach              
             </select>
             <div class="help-block with-errors"></div>
             <div class="text-danger" id='error_prov'>{{$errors->formulario->first('nombre')}}</div>
           </div>
         </div><!--/form-group-->




         <div class="form-group">
          <label class="col-sm-3 control-label">Codigo de Barras: <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
            <input type="radio" value="1" name="habilitarDeshabilitar" onchange="habilitar(this.value);" checked> Ingrese Codigo de Barras 
            <input type="radio" value="2" name="habilitarDeshabilitar"  onchange="habilitar(this.value);"> GenerarCodigo de Barras Automatico

            <input type="radio" value="3" name="habilitarDeshabilitar"  onchange="habilitar(this.value);"> Ninguno

          </div>
        </div>

        <input name="nombreOculto" id="oculto"  hidden  />
        <div class="form-group">
          <label class="col-sm-3 control-label"> <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
           <input type="text" name="codigo" id="segundo"  maxlength="35"  onchange="validarempaque();"  class="form-control" placeholder="Ingrese el Codigo de Barras"  required value="{{Input::old('codigo')}}"/><br>
           <div class="text-danger" id='error_rfc'>{{$errors->formulario->first('codigo')}}</div>
           <span id="errorCodigo" style="color:#FF0000;"></span>
         </div>
       </div>

       <div class="form-group ">
        <label class="col-sm-3 control-label">Imagen</label>
        <div class="col-sm-6">
         <input  name="imagen" type="file"  value="{{Input::old('imagen')}}" accept=".jpg, .jpeg, .png" >
       </div>
     </div>
     



     <div class="form-group">
      <label class="col-sm-3 control-label">Descripción: <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <input name="descripcion" type="text"  value="{{Input::old('descripcion')}}"  maxlength="70"  onchange="mayus(this);"  class="form-control" required value="" placeholder="Ingrese Descripción del Material" />
      </div>
    </div>

<<<<<<< HEAD
    <div class="form-group">
      <label  class="col-sm-3 control-label">Cantidad en Almacén <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <input name="cantidad" maxlength="9" type="number" value="{{Input::old('cantidad')}}" min="1" max='9999999' step="1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="" placeholder="Ingrese la Cantidad en Almacén" onkeypress=" return soloNumeros(event);" />
      </div>    
    </div>  
=======
  <div class="form-group">
    <label  class="col-sm-3 control-label">Cantidad en Almacén <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input name="cantidad" type="number" step="any"  max="999999" min="0.1"  value="{{Input::old('cantidad')}}" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="" placeholder="Ingrese la Cantidad en Almacén" onkeypress=" return soloNumeros(event);" />
    </div>    
  </div>  
>>>>>>> d3d3c8de7d37cce1681f947cfbc718167259f896

    <div class="form-group">
      <label class="col-sm-3 control-label">Unidad de Medida <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <select name="medida" value="{{Input::old('medida')}}">
          @if(Input::old('medida')=="KILOGRAMOS")
          <option value='KILOGRAMOS' selected>KILOGRAMOS
          </option>
          <option value="LITROS">LITROS</option>
          <option value="METROS">METROS</option>
          <option value="UNIDADES">UNIDADES</option>
          
          @elseif(Input::old('medida')=="LITROS")
          <option value="LITROS" selected>LITROS</option>
          <option value="METROS">METROS</option>
          <option value="UNIDADES">UNIDADES</option>
          <option value='KILOGRAMOS'>KILOGRAMOS</option>
          @elseif(Input::old('medida')=="METROS")
          <option value="LITROS">LITROS</option>
          <option value="METROS" selected>METROS</option>
          <option value="UNIDADES">UNIDADES</option>
          <option value='KILOGRAMOS'>KILOGRAMOS</option>

          @else
          <option value="LITROS">LITROS</option>
          <option value="METROS" >METROS</option>
          <option value="UNIDADES" selected>UNIDADES</option>
          <option value='KILOGRAMOS'>KILOGRAMOS</option>   
          @endif
        </select>
        
      </div>
    </div>
    <div class="form-group">
      <label  class="col-sm-3 control-label">Stock Minimo <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <input name="stock_min" maxlength="9" type="number" value="{{Input::old('stock_min')}}" min="1" max='9999999' step="1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="" placeholder="Ingrese la Cantidad de Stock Minimo en Almacén" onkeypress=" return soloNumeros(event);" />
      </div>    
    </div> 


    

    <div class="form-group">
      <div class="col-sm-offset-7 col-sm-5">
        <button type="submit" id="submit" class="btn btn-primary">Guardar</button>
        <a href="{{url('/almacenes/empaque')}}" class="btn btn-default"> Cancelar</a>
      </div>
    </div><!--/form-group-->


  </form>
</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
@include('almacen.empaque.modalreactivar')
@endsection

<script>
  function habilitar(value)
  {
    if(value=="1")
    {
// habilitamos
document.getElementById("segundo").disabled=false;
document.getElementById("segundo").value = "";
document.getElementById("segundo").focus(); 
}else if(value=="2"){
// deshabilitamos
document.getElementById("segundo").disabled=false;
document.getElementById("segundo").readonly="readonly";
document.getElementById("segundo").readonly=true;
var aleatorio = Math.floor(Math.random()*999999999999);
document.getElementById("segundo").value=aleatorio;
}else if (value=="3"){
  document.getElementById("segundo").disabled=true;
  document.getElementById("segundo").value = "";
}
}
</script>
</head>
