@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">

    <h1>Inicio</h1>
    <h2 class="">Almacén de Materiales</h2>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('almacen/materiales')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('almacen/salidas/material')}}">Salidas de Almacén de Materiales/Refacciónes</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Salida de Material: {{$material->nombre}} </strong></h2>
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
        <form action="{{url('/almacen/salidas/material', [$salida->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
          {{csrf_field()}}
          <input type="hidden" name="_method" value="PUT">




          <div class="form-group">
            <label class="col-sm-3 control-label">Entrego : <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="entrego" id="entrego" class="form-control select2" required>  

               @foreach($empleado as $emp)

               @if($emp->id == $salida->entrego)
               <option value="{{$emp->id}}" selected>{{$emp->nombre}} {{$emp->apellidos}} </option>
               @else
               <option value="{{$emp->id}}">
                 {{$emp->nombre}} {{$emp->apellidos}} 
               </option>
               @endif             
               @endforeach               
             </select>
             <span id="errorentrego" style="color:#FF0000;"></span>
             <div class="help-block with-errors"></div>
           </div>
         </div>




         <div class="form-group">
          <label class="col-sm-3 control-label">Recibio : <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
            <select name="recibio" id="recibio"   class="form-control select2" required>  
             @foreach($empleado as $emp)

             @if($emp->id == $salida->recibio)
             <option value="{{$emp->id}}" selected>{{$emp->nombre}} {{$emp->apellidos}} </option>
             @else
             <option value="{{$emp->id}}">
               {{$emp->nombre}} {{$emp->apellidos}} 
             </option>
             @endif             
             @endforeach              
           </select>
           <div class="help-block with-errors"></div>
         </div>
       </div>



       <div class="form-group">
        <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
        <div class="col-sm-6">
          <input name="movimiento" id="movimiento" value="{{$salida->tipo_movimiento}}"  type="text"  maxlength="35" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);"  placeholder="Ingrese el Tipo de Movimiento Realizado"/>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Destino : <strog class="theme_color">*</strog></label>
        <div class="col-sm-6">
          <select name="destino" id="destino"   class="form-control select2" >  
            @foreach($almacenes as $al)
            @if ($al->nombre == $salida->destino)
            <option value="{{$al->nombre}}" selected>{{$al->nombre}} </option>
            @else
            <option value="{{$al->nombre}}">{{$al->nombre}} </option>
            @endif
            @endforeach              
          </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Fecha de Salida: <strog class="theme_color">*</strog></label>
        <div class="col-sm-6">

         <input type="date" name="fecha" id="fecha" value="{{$salida->fecha}}" class="form-control mask" >
       </div>
     </div>

     <div class="col-lg-4 col-lg-offset-4">
       <div class="form-group">
        <label class="col-sm-6 control-label">Buscar Codigo de Barras: <strog class="theme_color">*</strog></label>
        <div class="col-sm-6">
          <input  id="codigo" value="" onkeypress="return teclas(event);" name="codigo" type="text"  maxlength="35"  class="form-control"  placeholder="Ingrese el Codigo de Barras"/>
        </div>
      </div>
    </div>


    <div class="container clear_both padding_fix">
      <div class="block-web">
       <div class="row">
        <div class="panel panel-primary"> 

          <div class="panel-body">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
              <div class="form-group"> 
                <label for="material">Material </label>
                <select name="id_materialk"   class="form-control select"  value="id_materialk" data-live-search="true"   id="id_materialk" >  
                  @foreach($materiales as $mat)
                  <option value="{{$mat->cantidad}}_{{$mat->descripcion}}_{{$mat->codigo}}_{{$mat->id}}_{{$mat->nombre}}_{{$mat->medida}}_{{$mat->ubicacion}}">
                   {{$mat->nombre}}
                 </option>
                 @endforeach              
               </select>
               <div class="help-block with-errors"></div>
             </div>
           </div><!--/form-group-->


           <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
             <div class="form-group"> 
              <label for="pcantidad">Cantidad en Almacén </label>
              <input name="pcantidad" id="pcantidad" value="" step="any"  type="number" disabled class="form-control" />
            </div>    
          </div> 
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
           <div class="form-group"> 
            <label for="amedida">Medida </label>
            <input name="amedida" id="amedida" value="" type="text" disabled class="form-control" />
          </div>
        </div>   

        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
         <div class="form-group"> 
          <label for="descripcion">Descripción </label>
          <input name="descripcion" id="descripcion" disabled class="form-control" />
        </div>    
      </div>  

      <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
       <div class="form-group"> 
        <label for="ubicacion">Ubicación Actual</label>
        <input name="ubicacion" id="ubicacion"  type="text" class="form-control" placeholder="Ubicacion" readonly="" />
      </div>    
    </div>  


    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
     <div class="form-group"> 
      <label for="scantidad">Cantidad de Salida </label>
      <input name="scantidad" id="scantidad" type="number" step="any"  value="1" max="{{$mat->cantidad}}" min="1" required="" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" maxlength="5"  />
      <span id="errorCantidad" style="color:#FF0000;"></span>
    </div>    
  </div>  

  <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
   <div class="form-group"> 
    <label for="medida">Medida </label>
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


</div>
<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
  <div class="form-group"> 
    <button type="button" id="btn_add" onclick="agregar();" class="btn btn-primary">Agregar</button>
  </div>
</div>

</div>



<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
  <div class="form-group"> 
    <table id="detalles" name="detalles[]" value="" class="table table-striped table-bordered table-condensed table-hover">
      <thead style="background-color:#A9D0F5">
        <th>Opciones</th>
        <th>N°Articulo</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>Unidad de Medida</th>
        <th>Equivale</th>
        <th>Destino</th>
        <th>Tipo de Movimiento</th>
        <th>Fecha</th>

      </thead>
      <tfoot>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tfoot>
      <tbody>

      </tbody>
    </table>

    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
     <div class="form-group"> 
      <label for="total">Total de Elementos </label>
      <input name="total" id="total" type="number"  class="form-control"  readonly/>
    </div>    
  </div>  

  <div class="form-group">
    <div class="col-sm-6">
      <input  id="codigo2" value="" name="codigo2[]" type="hidden"  maxlength="50"  class="form-control"  placeholder="Ingrese el Codigo de Barras"/>
    </div>
  </div>

</div>

</div>


</div>




<div class="form-group">
  <div class="col-sm-offset-7 col-sm-5">
    <button type="submit" onclick="return save();" class="btn btn-primary">Guardar</button>
    <a href="{{url('/almacen/salidas/material')}}" class="btn btn-default"> Cancelar</a>
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

  function teclas(event) {
    tecla=(document.all) ? event.keyCode : event.which;
   // alert(tecla);

   var cuenta = document.getElementById('codigo');
   var x = cuenta.value;
   var z = x.length
   if (tecla == 13  ) {
    var busca = z;
    //  alert ("12 entro");
    var y = document.getElementById("id_materialk").length;
    var i= 0;
    while(i <= y){


      if (i == y){
        swal("Producto No Encontrado!", "Verifique el Codigo de Barras!", "error");
        break;
      }

      var e = document.getElementById("id_materialk");
      var value = e.options[e.selectedIndex=i].value;
      var text = e.options[e.selectedIndex=i].text;
      var cantidadtotal = value;
      limite = "7",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
      var ida =arregloDeSubCadenas[3];
      var nombre =arregloDeSubCadenas[4];
      var codigo = arregloDeSubCadenas[2];
      var descripciona = arregloDeSubCadenas[1];
      var cantidada = arregloDeSubCadenas[0];
      var medidaa = arregloDeSubCadenas[5]; 
      var ubicacionact = arregloDeSubCadenas[6]; 
      stock=arregloDeSubCadenas[0];
      tecla=(document.all) ? event.keyCode : event.which;
      if (codigo == x){
        swal("Producto Encontrado:"+nombre +"!", "Stock de Salida!", "success",{content: "input", inputType:"number",}).then((value) => {
          var aux =`${value}`;

          document.getElementById("scantidad").value = aux;
  //swal(aux);
});

        document.getElementById('id_materialk').selectedIndex = i;
        document.getElementById("pcantidad").value=cantidada ;
        document.getElementById("descripcion").value=descripciona;
        document.getElementById("amedida").value=medidaa;
        document.getElementById("ubicacion").value=ubicacionact;

        document.getElementById("scantidad").max=stock;
        break;
      }

      i++;
    }


    return false;
  } 

 //return false;

}

window.onload=function() {
     //stock agroquimicos
     var select2 = document.getElementById('id_materialk');
     var selectedOption2 = select2.selectedIndex;
     var cantidadtotal = select2.value;
     limite = "7",
     separador = "_",
     arregloDeSubCadenas = cantidadtotal.split(separador, limite);  
     var ida =arregloDeSubCadenas[3];
     var nombrea =arregloDeSubCadenas[4];
     var codigoa = arregloDeSubCadenas[2];
     var descripciona = arregloDeSubCadenas[1];
     var cantidada = arregloDeSubCadenas[0];
     var medidaa = arregloDeSubCadenas[5];
      var ubicacionact = arregloDeSubCadenas[6]; 

     document.getElementById("pcantidad").value=cantidada ;
     document.getElementById("descripcion").value=descripciona;
     document.getElementById("amedida").value=medidaa;
     document.getElementById("scantidad").value = "1";
             document.getElementById("ubicacion").value=ubicacionact;
     document.getElementById("codigo").select();

     var tabla = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);

    var scantidadx = document.getElementById("scantidad");
    var cantidaden = scantidadx.value;

    cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminarFila(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = '{{$salida->id_material}}';
    cell3.innerHTML = '{{$material->nombre}}';
    cell4.innerHTML = '{{$salida->cantidad}}';
    cell5.innerHTML = '{{$salida->medida}}';
    cell6.innerHTML = '{{$salida->medidaaux}}';
    cell7.innerHTML = '{{$salida->destino}}';
    cell8.innerHTML = '{{$salida->tipo_movimiento}}';
    cell9.innerHTML = '{{$salida->fecha}}';

    var x = document.getElementById("id_materialk");
    //x.remove(x.selectedIndex);
    var xrow = tabla.rows.length-2;
    document.getElementById("total").value=xrow;
    limpiar();

  }
  var select = document.getElementById('id_materialk');
  //alert(select);
  select.addEventListener('change',
    function(){
      var selectedOption = this.options[select.selectedIndex];
    // alert(selectedOption.value);
   //   console.log(selectedOption.value + ': ' + selectedOption.text);
   var cantidadtotal = selectedOption.value;
   limite = "7",
   separador = "_",
   arregloDeSubCadenas = cantidadtotal.split(separador, limite);
   var ida =arregloDeSubCadenas[3];
   var nombrea =arregloDeSubCadenas[4];
   var codigoa = arregloDeSubCadenas[2];
   var descripciona = arregloDeSubCadenas[1];
   var cantidada = arregloDeSubCadenas[0];
   var medidaa = arregloDeSubCadenas[5]; 
    var ubicacionact = arregloDeSubCadenas[6];
   // id_materiales=arregloDeSubCadenas[3];

  // console.log(arregloDeSubCadenas); 
  document.getElementById("pcantidad").value=cantidada ;
  document.getElementById("descripcion").value=descripciona;
  document.getElementById("amedida").value=medidaa;
  document.getElementById("scantidad").value = "1";
          document.getElementById("ubicacion").value=ubicacionact;
});

  function limpiar(){
    document.getElementById("scantidad").value="1";
  }

  function eliminarFila(value) {

    document.getElementById("detalles").deleteRow(value);
   // var id2= uno2--;
   var menos =document.getElementById("detalles").rows
   var r = menos.length;
   document.getElementById("total").value= r - 2;
   limpiar();
 } 


 function agregar(){
  var select2 = document.getElementById('medida');
  var selectedOption2 = select2.selectedIndex;
  var cantidadtotal = select2.value;
  limite = "3",
  separador = "_",
  arregloDeSubCadenas = cantidadtotal.split(separador, limite);
  unidadaux = arregloDeSubCadenas[0];
  medida=arregloDeSubCadenas[1];
  cantidadaux=arregloDeSubCadenas[2];

  if (document.getElementById('amedida').value != unidadaux){
   document.getElementById("errorMedida").innerHTML = "La Unidad de Medida Seleccionada ,No Es Compatible con este Producto";
   return false;
 }
 document.getElementById("errorMedida").innerHTML = "";

 var menos =document.getElementById("detalles").rows
 var r = menos.length - 2;
 if (r == 0){
  var fechav = document.getElementById('fecha').value;
  var recibiov =  document.getElementById('recibio').value;
  var entregadov = document.getElementById('entrego').value;
  var destinov = document.getElementById('destino').value;
  var materialv = document.getElementById('id_materialk').value;
  var salidav = document.getElementById('scantidad').value;

  if(fechav !== "" && recibiov !== "" &&entregadov !=="" && destinov!=="" && materialv!=="" &&salidav!==""){
   if (salidav > 0){
     document.getElementById("errorCantidad").innerHTML = "";
     if (parseInt(entregadov) != parseInt(recibiov)){
       document.getElementById("errorentrego").innerHTML = "";


       var select2=document.getElementById('id_materialk');
       var cantidadtotal2 = select2.value;
       limite2 = "6",
       separador2 = "_",
       arregloDeSubCadenas2 = cantidadtotal2.split(separador2, limite2);
       x=arregloDeSubCadenas2[3];


       var valida = document.getElementById("scantidad").value;
       var valida2 = document.getElementById("pcantidad").value;
       var y = parseInt(valida);
       var z = parseInt(valida2);
       var comprueba = recorre(x)

       if (comprueba == 1){
        swal("Alerta!", "Este Material Ya se ha Insertado en la Tabla!", "error");
        return false;


      }
      var cantidades = document.getElementById("scantidad");
      var cantidadt = cantidades.value;

      var cantidadth = cantidadaux * cantidadt;
      var u = "";
      var medidaaux = u.concat(cantidadth," ",unidadaux);

      if (cantidadth > z) {
        swal("Alerta!", "El Stock de Salida no Puede Ser Mayor que la Cantidad Actual en Almacén!", "error");
        return false;

      }

      var select=document.getElementById('id_materialk');
      var cantidadtotal = select.value;
      limite = "6",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
        //var id2= uno++;
        cantidad=arregloDeSubCadenas[0];
        descripcion=arregloDeSubCadenas[1];
        codigo=arregloDeSubCadenas[2];
        id=arregloDeSubCadenas[3];
        nombre=arregloDeSubCadenas[4];
        var tabla = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);




    var fechas = document.getElementById("fecha");
    var var3 = fechas.value;

    var cantidades = document.getElementById("scantidad");
    var cantidadt = cantidades.value;

    var dest = document.getElementById("destino");
    var dest = dest.value;

    var mov = document.getElementById("movimiento");
    var movt = mov.value;

    cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminarFila(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = id;
    cell3.innerHTML = nombre;
     cell4.innerHTML = cantidadt;
    cell5.innerHTML = medida;
    cell6.innerHTML = medidaaux;
    cell7.innerHTML = dest;
    cell8.innerHTML = movt;
    cell9.innerHTML = var3;

    var x = document.getElementById("id_materialk");
    //x.remove(x.selectedIndex);
    limpiar();
    //cargar();

    var menos =document.getElementById("detalles").rows
    var r = menos.length;
    document.getElementById("total").value= r - 2;
    


  }else{
   document.getElementById("errorentrego").innerHTML = "El Empleado que entrega el Material no puede ser el mismo que lo Recibe";

 }}else{
  document.getElementById("errorCantidad").innerHTML = "La Cantidad de Salida debe ser Mayor de 0";
}}else{

  swal("Alerta!", "Faltan campos Por llenar Favor de Verificar!", "error");
}}else{
 swal("Alerta!", "Solo puede Agregar 1 Producto para Poder Modificar la Salida de Almacén!", "error");
}
} 

function recorre(valor) {
 var z = 1
 var arreglo = [];
 var table = document.getElementById('detalles');
 for (var r = 1, n = table.rows.length-1; r < n; r++) {
  for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
   if (z == 1){
        //alert(z)
       // document.getElementById("id_materialk").id=z;
      // document.getElementById("id_materialk").value=table.rows[r].cells[c].innerHTML;
      var j = table.rows[r].cells[c].innerHTML
      if (valor == j ){
        var r = 1;
        return(r);
        z ++;
      }
    }

    else if(z == 2){
     z ++;


   }else if(z == 3){
      ///alert(table.rows[r].cells[c].innerHTML);
      z ++;
    }else if(z == 4){

   //  alert(table.rows[r].cells[c].innerHTML);
   z ++;
 } else if (z == 5){
       //  alert(z)
     //  document.getElementById("entrego").value=table.rows[r].cells[c].innerHTML;
     //alert(table.rows[r].cells[c].innerHTML);

//alert(arreglo);
z ++;
}else if (z == 6){
 //document.getElementById("recibio").value=table.rows[r].cells[c].innerHTML;
 //alert(table.rows[r].cells[c].innerHTML);
 z ++;

}else if(z == 7){
   z ++;

 }else if(z == 8){
   z ++;

 }else if(z == 9){
   z ++;

 }else{
     z = 1;

   }

 }
}
}   

function save() {
 if (document.getElementById('total').value > 0){
   var z = 1
   var arreglo = [];
   var table = document.getElementById('detalles');
   for (var r = 1, n = table.rows.length-1; r < n; r++) {
    for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
     if (z == 1){
        //alert(z)
       // document.getElementById("id_materialk").id=z;
      // document.getElementById("id_materialk").value=table.rows[r].cells[c].innerHTML;
      arreglo.push(table.rows[r].cells[c].innerHTML);
       // alert(table.rows[r].cells[c].innerHTML);
       z ++;
     }

     else if(z == 2){
         //alert(z)
       //  document.getElementById("id_materialk").value=table.rows[r].cells[c].innerHTML;
       arreglo.push(table.rows[r].cells[c].innerHTML);
       // alert(table.rows[r].cells[c].innerHTML);
       z ++;
       

     }else if(z == 3){
         //alert(z)
       //  document.getElementById("scantidad").value=table.rows[r].cells[c].innerHTML;
       arreglo.push(table.rows[r].cells[c].innerHTML);
        //alert(table.rows[r].cells[c].innerHTML);
        z ++;
      }else if(z == 4){
         //alert(z)
        // document.getElementById("destino").value=table.rows[r].cells[c].innerHTML;
        arreglo.push(table.rows[r].cells[c].innerHTML);
       // alert(table.rows[r].cells[c].innerHTML);
       z ++;
     } else if (z == 5){
       //  alert(z)
     //  document.getElementById("entrego").value=table.rows[r].cells[c].innerHTML;
       //  alert(table.rows[r].cells[c].innerHTML);
       arreglo.push(table.rows[r].cells[c].innerHTML);
       z ++;
     }else if (z == 6){
       //  alert(z)
     //  document.getElementById("entrego").value=table.rows[r].cells[c].innerHTML;
       //  alert(table.rows[r].cells[c].innerHTML);
       arreglo.push(table.rows[r].cells[c].innerHTML);
       z ++;
     }else if (z == 7){
       //  alert(z)
     //  document.getElementById("entrego").value=table.rows[r].cells[c].innerHTML;
       //  alert(table.rows[r].cells[c].innerHTML);
       arreglo.push(table.rows[r].cells[c].innerHTML);
       z ++;
     }
     else{
       // document.getElementById("fecha").value=table.rows[r].cells[c].innerHTML;
       arreglo.push(table.rows[r].cells[c].innerHTML);
       document.getElementById("codigo2").value=arreglo;
       z = 1;

     }

   }
 }
 var menos =document.getElementById("detalles").rows
 var r = menos.length;
 document.getElementById("total").value= r - 2;
}else{

  swal("Alerta!", "No hay Elementos Agregados a la Tabla, Para Poder Guardar!", "error");
  return false;

}
}

</script>

@endsection