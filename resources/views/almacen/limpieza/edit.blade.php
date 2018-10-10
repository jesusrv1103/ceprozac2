@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Agroquímicos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/almacen/materiales')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('/almacen/materiales')}}">Almacén de Material de Limpieza</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Material de Limpieza: {{ $material->nombre}}</strong></h2> 
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
          <form action="{{url('/almacenes/limpieza', [$material->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

  <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text" value="{{$material->nombre}}" onchange="mayus(this);"  class="form-control" required value="" placeholder="Ingrese nombre del producto" />
              </div>
            </div>

                          <div class="form-group">
            <label class="col-sm-3 control-label"> Proveedor: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="provedor_name" class="form-control select2"  required>  
                @foreach($provedor as $provedores)

                @if($provedores->id == $material->provedor)
                <option value="{{$provedores->id}}" selected>{{$provedores->nombre}}</option>
                @else
                <option value="{{$provedores->id}}">
                 {{$provedores->nombre}}
               </option>
                @endif
                
               
               @endforeach              
             </select>
             <div class="help-block with-errors"></div>
           </div>
         </div><!--/form-group-->

                            <div class="form-group">
              <label class="col-sm-3 control-label">Codigo de Barras: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
<input type="radio" value="1" name="habilitarDeshabilitar" id="1" onchange="habilitar(this.value);" checked> Edite Codigo de Barras 
<input type="radio" value="2" name="habilitarDeshabilitar" id="2" onchange="habilitar(this.value);">Nuevo Codigo de Barras Automatico

<input type="radio" value="3" name="habilitarDeshabilitar" id="3" onchange="habilitar(this.value);"> Ninguno

              </div>
            </div>
  
         <div class="form-group">
              <label class="col-sm-3 control-label"> <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
 <input type="text" name="codigo" onkeypress=" return soloNumeros(event);" id="segundo"  value="{{$material->codigo }}" maxlength="12"   class="form-control" placeholder="Ingrese el Codigo de Barras" required value="" value="segundo"/><br>
</div>
</div>

               <div class="form-group">
              <label  class="col-sm-3 control-label">Codigo de Barras <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

   <td> <?php echo DNS1D::getBarcodeHTML("$material->id", "EAN13",3,33);?></td>
        </div>    
               </div>  

          



           <input type="text" hidden name="imagen " value="{{$material->imagen}}">

          <div class="form-group ">
            <label class="col-sm-3 control-label">Imagen</label>
            <div class="col-sm-6">
             <input  type="file" hidden name="imagen"  value="{{$material->imagen}}" class="form-control"  accept=".jpg, .jpeg, .png">
             @if (($material->imagen)!="")
             <img src="{{asset('imagenes/almacenagroquimicos/'.$material->imagen)}}" height="100px" width="100px">
             @endif
           </div>
         </div>

    <div class="form-group">
              <label class="col-sm-3 control-label">Descripción: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="descripcion" value="{{$material->descripcion}}" type="text"  onchange="mayus(this);"  class="form-control" required value="" placeholder="Ingrese Descripción del Material" />
              </div>
            </div>

               <div class="form-group">
              <label  class="col-sm-3 control-label">Cantidad en Almacén <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="cantidad" value="{{$material->cantidad }}" type="number" step="any"  max="999999" min="0.1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="" placeholder="Ingrese la Cantidad en Almacén" onkeypress=" return soloNumeros(event);" />
               </div>    
               </div>  


              <div class="form-group">
      <label class="col-sm-3 control-label">Unidad de Medida <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <select name="medida" value="{{Input::old('medida')}}">
          @if(($material->medida)=="KILOGRAMOS")
          <option value='KILOGRAMOS' selected>KILOGRAMOS
          </option>
          <option value="LITROS">LITROS</option>
          <option value="METROS">METROS</option>
          <option value="UNIDADES">UNIDADES</option>
    
          @elseif(($material->medida)=="LITROS")
          <option value="LITROS" selected>LITROS</option>
          <option value="METROS">METROS</option>
          <option value="UNIDADES">UNIDADES</option>
          <option value='KILOGRAMOS'>KILOGRAMOS</option>
          @elseif(($material->medida)=="METROS")
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
                <input name="stock_min" maxlength="9" type="number" value="{{$material->stock_minimo }}" min="1" max='9999999' step="1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="" placeholder="Ingrese la Cantidad de Stock Minimo en Almacén" onkeypress=" return soloNumeros(event);" />
               </div>    
               </div> 

       

   

   <div class="form-group">
    <div class="col-sm-offset-7 col-sm-5">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <a href="{{url('/almacenes/limpieza')}}" class="btn btn-default"> Cancelar</a>
    </div>
  </div><!--/form-group-->


</form>
</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection

<script>
 window.onload=function() {

  var cod = document.getElementById('segundo').value;
  if (cod > 0){
    document.getElementById('1').checked;


  }else{

    document.getElementById('3').checked=true;
  document.getElementById("segundo").disabled=true;
    document.getElementById("segundo").value = "";

  }
  }
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