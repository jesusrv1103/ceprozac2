@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">

    <h1>Inicio</h1>
    <h2 class="">Almacén</h2>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/almacenes/agroquimicos')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('/almacenes/agroquimicos')}}">Entradas de Almacén Agroquímicos</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Mover Producto de Almacén : {{$almacen->nombre_lote}} </strong></h2>
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
        <div class="text-danger" id='error_rfc'>{{$errors->formulario->first('codigo')}}</div>
        <form action="{{route('almacen.general.salidas.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">

          {{csrf_field()}}



          <div class="form-group">
            <label class="col-sm-3 control-label">Lote Actual: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

             <input type="text" name="lotea" id="lotea" value="{{$almacen->nombre_lote}}" class="form-control mask" readonly="" >
           </div>
         </div>

               <div class="form-group">
            <label class="col-sm-3 control-label">Almacén Origen: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

             <input type="text" name="almacena" id="almacena" value="{{$almacen->almanombre}}" class="form-control mask" readonly="" >
           </div>
         </div>

                   <div class="form-group">
            <label class="col-sm-3 control-label">Producto: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

             <input type="text" name="lotea" id="lotea" value="{{$almacen->nomprod}}" class="form-control mask" readonly="" >
           </div>
         </div>

                        <div class="form-group">
            <label class="col-sm-3 control-label">Calidad: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

             <input type="text" name="calidada" id="calidada" value="{{$almacen->calidadnombre}}" class="form-control mask" readonly="" >
           </div>
         </div>


                        <div class="form-group">
            <label class="col-sm-3 control-label">Proveedor: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

             <input type="text" name="proveedora" id="proveedora" value="{{$almacen->nombreprov}}  {{$almacen->apellidos}}" class="form-control mask" readonly="" >
           </div>
         </div>


                                                             <div class="form-group">
                        <label class="col-sm-3 control-label">Almacén Destino: <strog class="theme_color">*</strog></label>
                        <div class="col-sm-6">
                          <select name="almacendest"  id="almacendest" class="form-control select" data-live-search="true"  required>  
                            @foreach($almacengeneral as $almacendest)
                            <option value="{{$almacendest->id}}_{{$almacendest->esp_libre}}">
                             {{$almacendest->nombre}}
                           </option>
                           @endforeach              
                         </select>
                         <div class="help-block with-errors"></div>
                       </div>
                     </div><!--/form-group-->
                   
                                                                                <div class="form-group">
                        <label class="col-sm-3 control-label">Espacio Asignado: <strog class="theme_color">*</strog></label>
                        <div class="col-sm-6">
                          <select name="espacio"  id="espacio" class="form-control select2" required>           
                         </select>
                         <div class="help-block with-errors"></div>
                       </div>
                     </div><!--/form-group-->

                          <div class="form-group">
      <label class="col-sm-3 control-label">Entrega Producto : <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <select name="entregado_a" id="entregado_a" value=""  class="form-control select2" required>  
          @foreach($empleado as $emp)
          <option value="{{$emp->id}}">
           {{$emp->nombre}} {{$emp->apellidos}} 
         </option>
         @endforeach              
       </select>
       <div class="help-block with-errors"></div>
     </div>
   </div>

                             <div class="form-group">
      <label class="col-sm-3 control-label">Recibe Producto : <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <select name="recibe" id="recibe" value=""  class="form-control select2" required>  
          @foreach($empleado as $emp)
          <option value="{{$emp->id}}">
           {{$emp->nombre}} {{$emp->apellidos}} 
         </option>
         @endforeach              
       </select>
       <div class="help-block with-errors"></div>
     </div>
   </div>

             <div class="form-group">
            <label class="col-sm-3 control-label">Fecha: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

             <input type="date" name="fecha" id="fecha" value="" class="form-control mask" >
           </div>
         </div>


         <div class="form-group"> 
           <label class="col-sm-3 control-label">Cantidad de Salida: <strog class="theme_color">*</strog></label>
                <div class="col-sm-3">
          <input name="scantidad" id="scantidad" type="number" value="1" max="{{$almacen->cantidad_act}}" min="1" required="" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" maxlength="5"  />
            <span id="errorCantidad" style="color:#FF0000;"></span>

        </div>    
      </div>  

            <div class="form-group"> 
               <label class="col-sm-3 control-label">Cantidad en Almacén: <strog class="theme_color">*</strog></label>
                <div class="col-sm-3"> 
        <input name="pcantidad" id="pcantidad" value="{{$almacen->cantidad_act}}" type="number" disabled class="form-control" />
      </div>

    </div>  

          <div class="form-group"> 
               <label class="col-sm-3 control-label">Unidad de Medida: <strog class="theme_color">*</strog></label>
                <div class="col-sm-3"> 
      <input name="medida" id="medida" disabled value="{{$almacen->medida}}"  class="form-control" />
    </div>   
    </div> 

        
     <div class="form-group"> 
          <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
      <input name="observaciones" id="observaciones" placeholder="Observaciónes del Movimiento"   class="form-control" />
    </div>    
  </div> 

    <div class="form-group">
    <div class="col-sm-6">
      <input  id="almacenid" value="{{$almacen->id_almacen}}" name="almacenid" type="hidden"   class="form-control"/>
    </div>
  </div>

      <div class="form-group">
    <div class="col-sm-6">
      <input  id="id_producto" value="{{$almacen->id_producto}}" name="id_producto" type="hidden"   class="form-control"/>
    </div>
  </div>

        <div class="form-group">
    <div class="col-sm-6">
      <input  id="id_provedor" value="{{$almacen->id_provedor}}" name="id_provedor" type="hidden"   class="form-control"/>
    </div>
  </div>

          <div class="form-group">
    <div class="col-sm-6">
      <input  id="id_lote" value="{{$almacen->id}}" name="id" type="hidden"   class="form-control"/>
    </div>
  </div>


<div class="form-group">
  <div class="col-sm-offset-7 col-sm-5">
    <button type="submit" onclick="return save();" class="btn btn-primary">Guardar</button>
    <a href="{{url('/almacen/entradas/agroquimicos')}}" class="btn btn-default"> Cancelar</a>
  </div>
</div><!--/form-group-->
</form>
</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->
</html> 
<script type="text/javascript">
  window.onload=function() {
      var select2 = document.getElementById('almacendest');
  var selectedOption2 = select2.selectedIndex;
  var cantidadtotal = select2.value;
  limite = "2",
  separador = "_",
  arregloDeSubCadenas = cantidadtotal.split(separador, limite);
  id=arregloDeSubCadenas[0];
  esplibre=arregloDeSubCadenas[1];

  var cantidadtotal = esplibre;
  limite = "15",
  separador = ",",
  arregloDeSubCadenas = cantidadtotal.split(separador, limite);
  for (var i = 0; i <= esplibre.length-1; i++) {
    var x = document.getElementById('espacio');
    var option = document.createElement("option");
    option.text = arregloDeSubCadenas[i];
    x.add(option);
  }

}

var select = document.getElementById('almacendest');
  select.addEventListener('change',

    function(){
      var selectedOption = this.options[select.selectedIndex];
   //   console.log(selectedOption.value + ': ' + selectedOption.text);
    var cantidadtotal = select.value;
  limite = "2",
  separador = "_",
  arregloDeSubCadenas = cantidadtotal.split(separador, limite);
  id=arregloDeSubCadenas[0];
  esplibre=arregloDeSubCadenas[1];
   // id_materiales=arregloDeSubCadenas[3];

  // console.log(arregloDeSubCadenas);
  document.getElementById('espacio').options.length = 0; 
  var cantidadtotal = esplibre;
  limite = "15",
  separador = ",",
  arregloDeSubCadenas = cantidadtotal.split(separador, limite);
  if (esplibre.length == 1 ){
      var x = document.getElementById('espacio');
    var option = document.createElement("option");
    option.text = arregloDeSubCadenas[0];
    x.add(option);
  }else{
    for (var i = 0; i <= esplibre.length/2 -1; i++) {
    var x = document.getElementById('espacio');
    var option = document.createElement("option");
    option.text = arregloDeSubCadenas[i];
    x.add(option);
  }

  }




});

  </script>
@endsection