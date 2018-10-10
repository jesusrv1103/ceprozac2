<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete2">
  <div class="modal-dialog">
    <div class="modal-content panel default blue_border horizontal_border_1">
      <div class="modal-body"> 
        <div class="row">
          <div class="block-web">
            <div class="header">
              <h3 class="content-header theme_color">&nbsp;Agregar Material a Almácen</h3>
            </div>


            <div class="porlets-content" style="margin-bottom: -50px;">
       <form action="{{route('almacen.entradas.agroquimicos.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8" >
            {{csrf_field()}}

              <div class="form-group">
            <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <input name="nombre2" type="text"  value="{{Input::old('nombre2')}}" maxlength="30"  onchange="mayus(this);"  class="form-control"  value="" placeholder="Ingrese nombre del producto" />

            </div>
          </div>

                    <div class="form-group">
            <label class="col-sm-3 control-label"> Proveedor: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="provedor_id2" class="form-control" value="{{Input::old('provedor_id2')}}" required>  
                @foreach($provedor as $provedores)
                <option value="{{$provedores->id}}">
                 {{$provedores->nombre}}
               </option>
               @endforeach              
             </select>
             <div class="help-block with-errors"></div>
           </div>
         </div><!--/form-group-->

 <div class="form-group">
          <label class="col-sm-3 control-label">Empresa : <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
            <select name="recibio2" id="recibio2" value="recibio2"  class="form-control select" required>  
              @foreach($empresas as $emp)
              <option value="{{$emp->nombre}}">
               {{$emp->nombre}} 
             </option>
             @endforeach              
           </select>
           <div class="help-block with-errors"></div>
         </div>
       </div>

                <div class="form-group">
          <label class="col-sm-3 control-label">Entregado a : <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
            <select name="entregado_a" id="entregado_a" value=""  class="form-control select" required>  
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
          <label class="col-sm-3 control-label">Recibe en Almacén CEPROZAC : <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
            <select name="recibe_alm" id="recibe_alm" value=""  class="form-control select" required>  
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
  <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color">*</strog></label>
  <div class="col-sm-6">

    <input name="observaciones" type="text"  maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes de la Compra"/>
  </div>
</div>


<div class="form-group">
          <label class="col-sm-3 control-label">Codigo de Barras: <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
            <input type="radio" value="1" name="habilitarDeshabilitar" onchange="habilitar(this.value);" checked> Ingrese Codigo de Barras 
            <input type="radio" value="2" name="habilitarDeshabilitar"  onchange="habilitar(this.value);"> GenerarCodigo de Barras Automatico

            <input type="radio" value="3" name="habilitarDeshabilitar"  onchange="habilitar(this.value);"> Ninguno

          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label"> <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
           <input type="text" name="codigo" id="segundo"  maxlength="12"   class="form-control" placeholder="Ingrese el Codigo de Barras"  value="{{Input::old('codigo')}}"/><br>
           <div class="text-danger" id='error_rfc'>{{$errors->formulario->first('codigo')}}</div>
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
        <input name="descripcion2" type="text"  value="{{Input::old('descripcion2')}}"  maxlength="70"  onchange="mayus(this);"  class="form-control"  value="" placeholder="Ingrese Descripción del Material" />
      </div>
    </div>

    <div class="form-group">
      <label  class="col-sm-3 control-label">Cantidad en Almacén <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <input name="cantidad2" maxlength="9" type="number" value="{{Input::old('cantidad2')}}" min="1" max='9999999' step="1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency"  value="" placeholder="Ingrese la Cantidad en Almacén" onkeypress=" return soloNumeros(event);" />
      </div>    
    </div>
                   <div class="form-group">
            <label class="col-sm-3 control-label">Medida de Salida: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="medida" value="{{Input::old('medida')}}">
                @if(Input::old('medida')=="Kilogramos")
                <option value='Kilogramos' selected>Kilogramos
                </option>
                <option value="Toneladas">Toneladas</option>
                <option value="Litros">Litros</option>
                <option value="Metros">Metros</option>
                <option value="Unidades">Unidades</option>
                @elseif(Input::old('medida')=="Toneladas")
                <option value='Toneladas' selected>Toneladas
                </option>
                <option value="Litros">Litros</option>
                <option value="Metros">Metros</option>
                <option value="Unidades">Unidades</option>
                <option value='Kilogramos'>Kilogramos</option>
                 @elseif(Input::old('medida')=="Litros")
                <option value='Toneladas'>Toneladas</option>
                <option value="Litros" selected>Litros</option>
                <option value="Metros">Metros</option>
                <option value="Unidades">Unidades</option>
                <option value='Kilogramos'>Kilogramos</option>
                @elseif(Input::old('medida')=="Metros")
                <option value='Toneladas'>Toneladas</option>
                <option value="Litros">Litros</option>
                <option value="Metros" selected>Metros</option>
                <option value="Unidades">Unidades</option>
                <option value='Kilogramos'>Kilogramos</option>
                @else
                <option value='Toneladas'>Toneladas</option>
                <option value="Litros">Litros</option>
                <option value="Metros" >Metros</option>
                <option value="Unidades" selected>Unidades</option>
                <option value='Kilogramos'>Kilogramos</option>
                @endif
              </select>
              
            </div>
          </div>

     <div class="form-group">
        <label class="col-sm-3 control-label">Número de Factura: <strog class="theme_color">*</strog></label>
        <div class="col-sm-3">
          <input name="factura2" id="factura2" value="{{Input::old('factura2 ')}}" type="text"  maxlength="10" onchange="mayus(this);"  class="form-control" onkeypress=" return soloNumeros(event);"  value="" placeholder="Ingrese el Número de Nota"/>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Fecha de Compra de Material: <strog class="theme_color">*</strog></label>
        <div class="col-sm-6">

         <input type="date" name="fecha2" id="fecha2" value="{{Input::old('fecha2 ')}}" class="form-control mask" >
       </div>
     </div>

 <div class="form-group">
        <label class="col-sm-3 control-label">Precio Unitario: <strog class="theme_color">*</strog></label>
        <div class="col-sm-6">
            <input name="preciou2" id="preciou2" value="{{Input::old('preciou2  ')}}" type="number" class="form-control" />
          </div>    
        </div>    
    </div>

 <div class="form-group">
      <div class="col-sm-6">
        <input  id="varz" value="" name="varz" type="hidden"  maxlength="50"  class="form-control"  placeholder="Ingrese el Codigo de Barras"/>
      </div>
    </div>

 
            </div><!--/porlets-content--> 
          </div><!--/block-web--> 
        </div>
      </section>
    </div>
    <div class="modal-footer" style="margin-top: -10px;">
      <div class="row col-md-5 col-md-offset-7" style="margin-top: -5px;">
         <input type="hidden" name="_token2" value="{{ csrf_token() }}"> 
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
         </form>
     </div>
   </div>
 </div><!--/modal-content--> 
</div><!--/modal-dialog--> 
</div><!--/modal-fade--> 

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