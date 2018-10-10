<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="0" id="modal-delete2-{{$materiales->id}}">
  <div class="modal-dialog">
    <div class="modal-content panel default blue_border horizontal_border_1">
      <div class="modal-body"> 
        <div class="row">
          <div class="block-web">
            <div class="header">
              <h3 class="content-header theme_color">&nbsp;Agregar Stock: {{ $materiales->nombre}}</h3>
            </div>


            <div class="porlets-content" style="margin-bottom: -50px;">
          <form action="{{url('/almacen/materiales/stock', [$materiales->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">



              <div class="form-group">
              <label  class="col-sm-3 control-label">Agregar Stock<strog class="theme_color">*</strog></label>
              <div class="col-sm-8">
                <input name="cantidades{{$materiales->id}}" id="cantidades{{$materiales->id}}" maxlength="9" value="1" type="text" min="1" max='9999999'" class="form-control" required placeholder="Ingrese la Cantidad" onkeypress=" return soloNumeros(event);" />
               </div>    
               </div>  
                           <br> <br> 

 <div class="form-group"> 
 <label class="col-sm-3 control-label">Medida <strog class="theme_color">*</strog></label>
  <div class="col-sm-8">
  <select name="medida"   class="form-control select"  data-live-search="true"   id="medida" >  
    @foreach($unidades as $unidad)
    <option value="{{$unidad->unidad_medida}}_{{$unidad->nombre}}_{{$unidad->cantidad}}">
     {{$unidad->nombre}}
   </option>
   @endforeach              
 </select>

 <span id="errorMedida" style="color:#FF0000;"></span>
 <div class="help-block with-errors"></div>
</div>
</div><!--/form-group-->
<br> <br>


      <div class="form-group">
        <label class="col-sm-3 control-label">Fecha de Compra <strog class="theme_color">*</strog></label>
        <div class="col-sm-6">

         <input type="date" name="fecha2{{$materiales->id}}" id="fecha2{{$materiales->id}}"  class="form-control mask" required="">
       </div>
     </div>


            <br> <br>
 <div class="form-group">
          <label class="col-sm-3 control-label">Empresa : <strog class="theme_color">*</strog></label>
          <div class="col-sm-8">
            <select name="recibio{{$materiales->id}}" id="recibio{{$materiales->id}}" value="recibio"  class="form-control select" required>  
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
            <select name="entregado_a{{$materiales->id}}" id="entregado_a{{$materiales->id}}" value=""  class="form-control select" required>  
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
            <select name="recibe_alm{{$materiales->id}}" id="recibe_alm{{$materiales->id}}" value=""  class="form-control select" required>  
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
  <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
  <div class="col-sm-8">

    <input name="observaciones" type="text"  maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes de la Compra"/>
  </div>
</div>
            <br> <br>

       <div class="form-group">
        <label class="col-sm-3 control-label">Número de Nota: <strog class="theme_color">*</strog></label>
        <div class="col-sm-8">
          <input name="nota{{$materiales->id}}" id="nota{{$materiales->id}}"  type="text"  maxlength="10" onchange="mayus(this);"  class="form-control" placeholder="Ingrese el Número de Nota ó Factura"  />
          <div class="help-block with-errors"></div>
        </div>
      </div>
            <br> <br>
      <div class="form-row">    
          <label class="col-sm-3 control-label">Precio Unitario <strog class="theme_color">*</strog></label>
          <div class="col-sm-8">
            <div class="input-group">
             <div class="input-group-addon">$</div>

             
             <input name="preciou{{$materiales->id}}" id ="preciou{{$materiales->id}}" maxlength="9" type="text" min="0" max='9999999' step="100" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required placeholder="Ingrese el Precio de este Producto" onkeypress=" return soloNumeros(event);"/>
           </div>
         </div>
       </div>

              <br> <br>
<br> <br>
        
   <div class="form-group"> 
     <label class="col-sm-3 control-label">% IVA  <strog class="theme_color">*</strog></label>
      <div class="col-sm-8">
    <input name="iva{{$materiales->id}}" id="iva{{$materiales->id}}" value="16" type="text" class="form-control" onkeypress=" return soloNumeros(event);" placeholder="Ingrese el % IVA del Producto" />
  </div>    
  </div>

  <br> <br>

          <div class="form-group">
            <label class="col-sm-3 control-label">Tipo de Moneda: <strog class="theme_color">*</strog></label>
            <div class="col-sm-8">
              <select name="moneda{{$materiales->id}}"  id ="moneda{{$materiales->id}}" class="form-control select" data-live-search="true"  value="{{Input::old('moneda')}}">
                   
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
      <input  id="nota" name="nota" type="hidden"   class="form-control" />
    </div>
  </div>

    <div class="form-group">
    <div class="col-sm-6">
      <input  id="umedida{{$materiales->id}}" name="umedida{{$materiales->id}}" value="{{$materiales->medida}}" type="hidden"   class="form-control" />
    </div>
  </div>

              <div class="form-group">
    <div class="col-sm-6">
      <input  id="medidaaux{{$materiales->id}}" name="medidaaux{{$materiales->id}}" value="" type="hidden"   class="form-control" />
    </div>
  </div>


       
    </div>
            <br> <br>
 
            </div><!--/porlets-content--> 
          </div><!--/block-web--> 
          <br> <br>
          <div>
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">  <div class="form-group">
                    <label class="col-sm-3 control-label"> <strog class="theme_color"></strog></label>
                        <div class="col-sm-8">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         <button type="submit" onclick="return save({{$materiales->id}});" class="btn btn-primary">Agregar</button>
         </div>
         </div>
         <br> <br>
         </div>

        </div>
      </section>
    </div>



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

  if (document.getElementById('umedida{{$materiales->id}}').value != unidadaux){
   //document.getElementById("errorMedida").innerHTML = "La Unidad de Medida Seleccionada ,No Es Compatible con este Producto";
   swal("Alerta!", "La Unidad de Medida Seleccionada ,No Es Compatible con este Producto!", "error");
   return false;
 }
    document.getElementById("errorMedida").innerHTML = "";

        var cantidades = document.getElementById("cantidades{{$materiales->id}}");
    var cantidaden = cantidades.value;
    var cantidadth = cantidadaux * cantidaden;
    var u = "";
    var medidaaux = u.concat(cantidadth," ",unidadaux);

    document.getElementById('medidaaux{{$materiales->id}}').value=medidaaux;
    



    var w = document.getElementById('fecha2'+$id2).value;
    var x = document.getElementById('preciou'+$id2).value;
    var y = document.getElementById('nota'+$id2).value;
    var z = document.getElementById('cantidades'+$id2).value;
        var a = document.getElementById('iva'+$id2).value;




    if (w !== "" && x !== "" && y !== "" && z !== ""  && a !== ""){
      if (z < 1){
          swal("Alerta!", "La Cantidad de Entrada debe ser Mayor de 0!", "error");
        return false;
      }
            document.getElementById('nota').value = y;
return true;

    }else{
       swal("Alerta!", "Faltan campos Por llenar Favor de Verificar!", "error");
      return false;

    }

}
</script>

 </div><!--/modal-content--> 
</div><!--/modal-dialog--> 
</div><!--/modal-fade--> 

         </form>