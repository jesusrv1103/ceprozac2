<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete2-{{$materiales->idAgroquimico}}">
  <div class="modal-dialog">
    <div class="modal-content panel default blue_border horizontal_border_1">
      <div class="modal-body"> 
        <div class="row">
          <div class="block-web">
            <div class="header">
              <h3 class="content-header theme_color">&nbsp;Agregar Stock: {{ $materiales->nombre}}</h3>
            </div>


            <div class="porlets-content" style="margin-bottom: -50px;">
              <form action="{{url('almacenes/agroquimicos/stock', [$materiales->idAgroquimico])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
                {{csrf_field()}}

                <input type="hidden" name="_method" value="PUT">

                <input type="hidden" value="{{$materiales->idAgroquimico}}">
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Agregar Stock<strog class="theme_color">*</strog></label>
                  <div class="col-sm-8">
                    <input name="cantidad" id="cantidades{{$materiales->idAgroquimico}}" maxlength="9" type="text" value="1" min="1" max='9999999'" class="form-control" required placeholder="Ingrese la Cantidad" onkeypress=" return soloNumeros(event);" />
                  </div>    
                </div>
                <br> <br>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Proveedores : <strog class="theme_color">*</strog></label>
                  <div class="col-sm-8">
                    <select name="provedor" id="recibio{{$materiales->idAgroquimico}}"   class="form-control select" required>  
                      @foreach($provedores as $provedor)
                      <option value="{{$provedor->id}}">
                       {{$provedor->nombre}} 
                     </option>
                     @endforeach              
                   </select>
                   <div class="help-block with-errors"></div>
                 </div>
               </div>
               <br> <br>

               <div class="form-group">
                <label class="col-sm-3 control-label">Fecha de Compra<strog class="theme_color">*</strog></label>
                <div class="col-sm-8">

                  <input type="date" name="fecha2{{$materiales->idAgroquimico}}" id="fecha2{{$materiales->idAgroquimico}}" value="" class="form-control mask" >
                </div>
              </div>

              <br> <br>

              <div class="form-group">
                <label class="col-sm-3 control-label">Empresa : <strog class="theme_color">*</strog></label>
                <div class="col-sm-8">
                  <select name="recibio{{$materiales->idAgroquimico}}" id="recibio{{$materiales->idAgroquimico}}" value="recibio"  class="form-control select" required>  
                    @foreach($empresas as $emp)
                    <option value="{{$emp->id}}">
                     {{$emp->nombre}} 
                   </option>
                   @endforeach              
                 </select>
                 <div class="help-block with-errors"></div>
               </div>
             </div>
             <br> <br>

             <div class="form-group">
              <label class="col-sm-3 control-label">Entregado a : <strog class="theme_color">*</strog></label>
              <div class="col-sm-8">
                <select name="entregado_a{{$materiales->idAgroquimico}}" id="entregado_a{{$materiales->idAgroquimico}}" value=""  class="form-control select" required>  
                  @foreach($empleado as $emp)
                  <option value="{{$emp->id}}">
                   {{$emp->nombre}} {{$emp->apellidos}} 
                 </option>
                 @endforeach              
               </select>
               <div class="help-block with-errors"></div>
             </div>
           </div>
           <br> <br>


           <div class="form-group">
            <label class="col-sm-3 control-label">Recibe: <strog class="theme_color">*</strog></label>
            <div class="col-sm-8">
              <select name="recibe_alm{{$materiales->idAgroquimico}}" id="recibe_alm{{$materiales->idAgroquimico}}" value=""  class="form-control select" required>  
                @foreach($empleado as $emp)
                <option value="{{$emp->id}}">
                 {{$emp->nombre}} {{$emp->apellidos}} 
               </option>
               @endforeach              
             </select>
             <div class="help-block with-errors"></div>
           </div>
         </div>
         <br> <br>  

         <div class="form-group">
          <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color">*</strog></label>
          <div class="col-sm-8">

            <input name="observaciones{{$materiales->idAgroquimico}}" type="text"  maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes de la Compra"/>
          </div>
        </div>
        <br> <br>
        <div class="form-group">
          <label class="col-sm-3 control-label">N° Factura: <strog class="theme_color">*</strog></label>
          <div class="col-sm-8">
            <input name="factura{{$materiales->idAgroquimico}}" id="factura{{$materiales->idAgroquimico}}" value="" type="text"  maxlength="10" onchange="mayus(this);"  class="form-control"  value="" placeholder="Ingrese el Número de Factura"/>
            <div class="text-danger" id='error_rfc'>{{$errors->formulario->first('factura')}}</div>
          </div>
        </div>
        <br> <br>
        <div class="form-row">    
          <label class="col-sm-3 control-label">Precio Unitario <strog class="theme_color">*</strog></label>
          <div class="col-sm-8">
            <div class="input-group">
             <div class="input-group-addon">$</div>


             <input name="precioUnitario" maxlength="9" type="number" value="{{Input::old('preciou')}}" min="0" max='9999999' step="100" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="" placeholder="Ingrese el Precio de este Producto" onkeypress=" return soloNumeros(event);"/>
           </div>
         </div>
       </div>
       <br> <br>

       <br> <br>

       <div class="form-group"> 
         <label class="col-sm-3 control-label">% IVA  <strog class="theme_color">*</strog></label>
         <div class="col-sm-8">
           <input name="iva" id="iva{{$materiales->idAgroquimico}}" value="0" type="text" class="form-control" onkeypress=" return soloNumeros(event);" placeholder="Ingrese el % IVA del Producto" />
         </div>    
       </div>
       <br> <br>
       <div class="form-group"> 
         <label class="col-sm-3 control-label">% IEPS </label>
         <div class="col-sm-8">
           <input name="ieps" id="ieps{{$materiales->idAgroquimico}}" value="0" type="text" class="form-control" onkeypress=" return soloNumeros(event);" placeholder="Ingrese el % IEPS del Producto" />
         </div>    
       </div>  

       <br> <br>

       <div class="form-group">
        <label class="col-sm-3 control-label">Tipo de Moneda: <strog class="theme_color">*</strog></label>
        <div class="col-sm-8">
          <select name="moneda{{$materiales->idAgroquimico}}"  id ="moneda{{$materiales->idAgroquimico}}" class="form-control select" data-live-search="true"  value="{{Input::old('moneda')}}">

            @if(Input::old('moneda')=="Peso MXM")
            <option value='Peso MXN' selected>Peso MXN
            </option>
            <option value="Dolar USD">Dolar USD</option>
            @else
            <option value='Dolar USD' selected>Dolar USD
            </option>
            <option value="Peso MXN">Peso MXN</option>
            @endif
          </select>          
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-6">
          <input  id="factura" name="factura" type="hidden"   class="form-control" />
        </div>
      </div>





    </div>
    <br> <br>

  </div><!--/porlets-content--> 
</div><!--/block-web--> 
<br> <br>

<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
<div class="form-group">
  <label class="col-sm-3 control-label"> <strog class="theme_color"></strog></label>
  <div class="col-sm-8">
   <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
   <button type="submit"onclick="return save({{$materiales->idAgroquimico}});" class="btn btn-primary">Agregar</button>
 </div>
</div>
<br> <br>
</div>

</div>
</section>
</div>

</form>
</div><!--/modal-content--> 
</div><!--/modal-dialog--> 
</div><!--/modal-fade--> 


<script>
  function save($id2)
  {
    var select2 = document.getElementById('medida');
    var selectedOption2 = select2.selectedIndex;
    var cantidadtotal = select2.value;
    limite = "3",
    separador = "_",
    arregloDeSubCadenas = cantidadtotal.split(separador, limite);
    unidadaux = arregloDeSubCadenas[0];
    medida=arregloDeSubCadenas[1];
    cantidadaux=arregloDeSubCadenas[2];

    if (document.getElementById('umedida{{$materiales->idAgroquimico}}').value != unidadaux){
   //document.getElementById("errorMedida").innerHTML = "La Unidad de Medida Seleccionada ,No Es Compatible con este Producto";
   swal("Alerta!", "La Unidad de Medida Seleccionada ,No Es Compatible con este Producto!", "error");
   return false;
 }
 document.getElementById("errorMedida").innerHTML = "";

 var cantidades = document.getElementById("cantidades{{$materiales->idAgroquimico}}");
 var cantidaden = cantidades.value;
 var cantidadth = cantidadaux * cantidaden;
 var u = "";
 var medidaaux = u.concat(cantidadth," ",unidadaux);

 document.getElementById('medidaaux{{$materiales->idAgroquimico}}').value=medidaaux;


 var w = document.getElementById('fecha2'+$id2).value;
 var x = document.getElementById('preciou'+$id2).value;
 var y = document.getElementById('factura'+$id2).value;
 var z = document.getElementById('cantidades'+$id2).value;
 var a = document.getElementById('iva'+$id2).value;
 var b = document.getElementById('ieps'+$id2).value;


 if (w !== "" && x !== "" && y !== "" && z !== "" & a !== "" & b !== "" ){
  if (z < 1){
   swal("Alerta!", "La Cantidad de Entrada debe ser Mayor de 0!", "error");
   return false;
 }
 document.getElementById('factura').value = y;
 return true;
}else{
  swal("Alerta!", "Faltan campos Por llenar Favor de Verificar!", "error");
  return false;

}

}
</script>