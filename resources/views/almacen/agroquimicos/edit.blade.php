@inject('metodo','CEPROZAC\Http\Controllers\AlmacenAgroquimicosController')
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
      <li><a style="color: #808080" href="{{url('/almacen/materiales')}}">Almacén de Agroquímicos</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Agroquímicos: {{ $material->nombre}} </strong></h2> 
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
          <form action="{{url('almacenes/agroquimicos', [$material->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text" value="{{$material->nombre}}" onchange="mayus(this);"  class="form-control" required value="" placeholder="Ingrese nombre del producto" />
              </div>
            </div>



            <div class="form-group">
              <label class="col-sm-3 control-label">Codigo de Barras: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <div class="radio">
                  <label>
                    <input type="radio" value="1" name="habilitarDeshabilitar" id="1" onchange="habilitar(this.value);" checked> Edite Codigo de Barras 
                  </label>
                </div>
                <div class="radio">
                  <label>
                   <input type="radio" value="2" name="habilitarDeshabilitar" id="2" onchange="habilitar(this.value);"> GenerarCodigo de Barras Automatico 
                 </label>
               </div>
               <div class="radio">
                <label>
                 <input type="radio" value="3" name="habilitarDeshabilitar"  id="3" onchange="habilitar(this.value);"> Ninguno
               </label>
             </div>
           </div>
         </div>






         <div class="form-group">
          <label class="col-sm-3 control-label"> <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
           <input type="text" name="codigo" id="segundo"  value="{{$material->codigo }}" maxlength="12"   class="form-control" onkeypress=" return soloNumeros(event);" placeholder="Ingrese el Codigo de Barras" required value="" value="segundo"/><br>
         </div>
       </div>

       <div class="form-group">
        <label  class="col-sm-3 control-label">Codigo de Barras <strog class="theme_color">*</strog></label>
        <div class="col-sm-6" id="muestra_codigo">

         <td> <?php echo DNS1D::getBarcodeHTML("$material->id", "C128",3,33);?></td>
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
    <label class="col-sm-3 control-label">Unidad de Medida <strog class="theme_color">*</strog></label>
    <div class="col-sm-3">
      <div class="input-group" >
        <div class="input-group-addon" >Completas</div>
        <input name="unidadesCompletas"  parsley-range="[0,500]" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="{{$unidadesCompletas}}" placeholder="3" onkeypress=" return soloNumeros(event);"/>
      </div>
    </div>
    <div class="col-sm-5">
      <select id="medida" name="idUnidadMedida" onchange="obtenerSelect();" >
        @foreach($unidadesMedidas  as $unidad)
        @if($material->idUnidadMedida == $unidad->idContenedorUnidadMedida)
        <option value='{{$unidad-> idContenedorUnidadMedida}}' selected>
         {{$unidad->nombre}} {{$unidad->cantidad}}  {{$unidad->nombreUnidadMedida}}
       </option>
       @else
       <option value='{{$unidad-> idContenedorUnidadMedida}}' >
         {{$unidad->nombre}} {{$unidad->cantidad}}  {{$unidad->nombreUnidadMedida}}
       </option>

       @endif

       @endforeach
     </select>
   </div>
 </div>



 @if($unidad_medida=="LITROS" ||  $unidad_medida=="KILOGRAMOS" || $unidad_medida=="METROS" )


 <div class="form-group">    
  <label class="col-sm-3 control-label">Unidades Incompletas: <strog class="theme_color">*</strog></label>

  <div class="col-sm-3">
    <div class="input-group" >
      <div class="input-group-addon" id="unidadCentral">Kilogramos</div>
      <input id="Medida" name="unidadCentral"  parsley-range="[0,999]" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency"
      required value="{{$unidadCentral}}" placeholder="3" onkeypress=" return soloNumeros(event);"/>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="input-group" >
      <div class="input-group-addon" id="unidadDeMedida">Gramos</div>
      <input  name="unidadDeMedida" value="{{$unidadInferior}}" parsley-range="[0,999]" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency"   id="unidadMinima" placeholder="3" onkeypress=" return soloNumeros(event);"/>
    </div>
  </div>
</div>

@else

<div class="form-group">    
  <label class="col-sm-3 control-label">Unidades Incompletas: <strog class="theme_color">*</strog></label>

  <div class="col-sm-3">
    <div class="input-group" >
      <div class="input-group-addon" id="unidadCentral">Kilogramos</div>
      <input id="Medida" name="unidadCentral"  parsley-range="[0,999]" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency"
      required value="{{$unidadInferior}}"  placeholder="3" onkeypress=" return soloNumeros(event);"/>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="input-group" >
      <div class="input-group-addon" id="unidadDeMedida">Gramos</div>
      <input  name="unidadDeMedida"  parsley-range="[0,999]" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency"   id="unidadMinima" placeholder="3" onkeypress=" return soloNumeros(event);"/>
    </div>
  </div>
</div>


@endif


<div class="form-group">
  <label  class="col-sm-3 control-label">Stock Minimo <strog class="theme_color">*</strog></label>
  <div class="col-sm-6">
    <input name="stock_min" maxlength="9" type="number"
     value="{{$metodo->convertidorStockUnidadesMinimas_UnidadCentral($unidad_medida,$material->stock_minimo)}}" 
     min="1" max='9999999' step="1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required  placeholder="Ingrese la Cantidad de Stock Minimo en Almacén" onkeypress=" return soloNumeros(event);" />
  </div>    
</div> 



<div class="form-group">
  <div class="col-sm-offset-7 col-sm-5">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{url('/almacenes/agroquimicos')}}" class="btn btn-default"> Cancelar</a>
  </div>
</div><!--/form-group-->


</form>
</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>

<script>
 window.onload=function() {


   var select = document.getElementById("medida");
   var options=document.getElementsByTagName("option");
   var idProvedor= select.value;

   var x = select.options[select.selectedIndex].text;
   var unidadesDeMedida = x.split(" ");


//MILILITROS

//myArr.includes( 'donna' ) 
 if(  unidadesDeMedida.includes("MILILITROS")){  //MILILITROS

  $("#unidadDeMedida").hide();
  $("#unidadMinima").hide();
  document.getElementById('unidadCentral').innerHTML='MILILITROS';  
  $("#Medida").show();


} else if( unidadesDeMedida.includes("GRAMOS")){  //GRAMOS

  $("#unidadDeMedida").hide();
  $("#unidadMinima").hide();
  document.getElementById('unidadCentral').innerHTML='GRAMOS';  
  $("#Medida").show();

} else if( unidadesDeMedida.includes("CENTIMETROS")) {  //CENTIMETROS

  $("#unidadDeMedida").hide();
  $("#unidadMinima").hide();
  document.getElementById('unidadCentral').innerHTML='CENTIMETROS';  
  $("#Medida").show();


} else if( unidadesDeMedida.includes("LITROS")){  //LITROS

 $("#unidadDeMedida").show();
 $("#unidadMinima").show();


 document.getElementById('unidadCentral').innerHTML='Litros';  
 document.getElementById('unidadDeMedida').innerHTML='Mililitros';  

 $("#unidadCentral").show();
 $("#Medida").show();
} else if( unidadesDeMedida.includes("METROS")){  //METROS
 $("#unidadDeMedida").show();
 $("#unidadMinima").show();
 document.getElementById('unidadCentral').innerHTML='Metros';  
 document.getElementById('unidadDeMedida').innerHTML='Centimetros';  


 $("#Medida").show();

}  else if( unidadesDeMedida.includes("KILOGRAMOS")) {  //KILOGRAMOS

 $("#unidadDeMedida").show();
 $("#unidadMinima").show();

 document.getElementById('unidadCentral').innerHTML='Kilogramos';  
 document.getElementById('unidadDeMedida').innerHTML='GRAMOS';  

 $("#unidadCentral").show();
 $("#Medida").show();

} else if ( unidadesDeMedida.includes("UNIDADES")) {  //UNIDADES

  $("#unidadDeMedida").hide();
  $("#unidadMinima").hide();
  document.getElementById('unidadCentral').innerHTML='UNIDADES';  
  $("#Medida").show();

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
function obtenerSelect() {

  var select = document.getElementById("medida");
  var options=document.getElementsByTagName("option");
  var idProvedor= select.value;

  var x = select.options[select.selectedIndex].text;
  var unidadesDeMedida = x.split(" ");


//MILILITROS

//myArr.includes( 'donna' ) 
 if(  unidadesDeMedida.includes("MILILITROS")){  //MILILITROS

  $("#unidadDeMedida").hide();
  $("#unidadMinima").hide();
  document.getElementById('unidadCentral').innerHTML='MILILITROS';  
  $("#Medida").show();


} else if( unidadesDeMedida.includes("GRAMOS")){  //GRAMOS

  $("#unidadDeMedida").hide();
  $("#unidadMinima").hide();
  document.getElementById('unidadCentral').innerHTML='GRAMOS';  
  $("#Medida").show();

} else if( unidadesDeMedida.includes("CENTIMETROS")) {  //CENTIMETROS

  $("#unidadDeMedida").hide();
  $("#unidadMinima").hide();
  document.getElementById('unidadCentral').innerHTML='CENTIMETROS';  
  $("#Medida").show();


} else if( unidadesDeMedida.includes("LITROS")){  //LITROS

 $("#unidadDeMedida").show();
 $("#unidadMinima").show();


 document.getElementById('unidadCentral').innerHTML='Litros';  
 document.getElementById('unidadDeMedida').innerHTML='Mililitros';  

 $("#unidadCentral").show();
 $("#Medida").show();
} else if( unidadesDeMedida.includes("METROS")){  //METROS
 $("#unidadDeMedida").show();
 $("#unidadMinima").show();
 document.getElementById('unidadCentral').innerHTML='Metros';  
 document.getElementById('unidadDeMedida').innerHTML='Centimetros';  


 $("#Medida").show();

}  else if( unidadesDeMedida.includes("KILOGRAMOS")) {  //KILOGRAMOS

 $("#unidadDeMedida").show();
 $("#unidadMinima").show();

 document.getElementById('unidadCentral').innerHTML='Kilogramos';  
 document.getElementById('unidadDeMedida').innerHTML='GRAMOS';  

 $("#unidadCentral").show();
 $("#Medida").show();

} else if ( unidadesDeMedida.includes("UNIDADES")) {  //UNIDADES

  $("#unidadDeMedida").hide();
  $("#unidadMinima").hide();
  document.getElementById('unidadCentral').innerHTML='UNIDADES';  
  $("#Medida").show();

} 

}


</script>

@endsection