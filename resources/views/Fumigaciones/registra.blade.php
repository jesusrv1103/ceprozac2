@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Fumigaciones</h2>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('fumigaciones')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('fumigaciones')}}">Fumigaciones</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Registrar Fumigacion: {{$fumigaciones->destino}}</strong></h2>
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
          <form action="{{url('fumigaciones', [$fumigaciones->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">


<div class="form-group">
  <label class="col-sm-3 control-label">Nombre de Lote: <strog class="theme_color"></strog></label>
  <div class="col-sm-6">

    <input name="lote" type="text"  value="{{$fumigaciones->destino}}" maxlength="200" onchange="mayus(this);"  class="form-control" placeholder="Ingrese El Lote de la Fumigación" readonly="" />
  </div>
</div>

<div class="form-group">
  <label class="col-sm-3 control-label">Ubicación Actual: <strog class="theme_color"></strog></label>
  <div class="col-sm-6">

    <input name="lote" type="text"  value="{{$ubicacion->nombre}}" maxlength="200" onchange="mayus(this);"  class="form-control" placeholder="Ingrese El Lote de la Fumigación" readonly="" />
  </div>
</div>


      <div class="form-group">
       <label class="col-sm-3 control-label">Hora de Inicio de La Fumigación: <strog class="theme_color">*</strog></label>
       <div class="col-sm-6">
        <input id="inicio" name="inicio" type="time" required>
        <div class="help-block with-errors"></div>
      </div>
    </div><!--/form-group-->

    <div class="form-group">
      <label class="col-sm-3 control-label">Fecha de Inicio: <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">

       <input type="date" name="fechai" id="fechai" value="" class="form-control mask" required>
     </div>
   </div>

   <div class="form-group">
    <label class="col-sm-3 control-label">Fecha de Termino: <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">

     <input type="date" name="fechaf" id="fechaf" value="" class="form-control mask" required >
   </div>
 </div>

 <div class="form-group">
   <label class="col-sm-3 control-label">Hora de Termino de La Fumigación: <strog class="theme_color">*</strog></label>
   <div class="col-sm-6">
    <input id="final" name="final" type="time" required>
    <div class="help-block with-errors"></div>
  </div>
</div><!--/form-group-->






<div class="form-group">
 <label class="col-sm-3 control-label">Fumigador: <strog class="theme_color">*</strog></label>
 <div class="col-sm-6">
  <select name="fumigador" id="fumigador"  class="form-control select" required>
    @foreach($empleado as $empleados)
    <option value="{{$empleados->id}}">
     {{$empleados->nombre}} {{$empleados->apellidos}} 
   </option>
   @endforeach
 </select>
 <div class="help-block with-errors"></div>
</div>
</div><!--/form-group-->

<div class="form-group">
 <label class="col-sm-3 control-label">Entrego Agroquimicos de Almacén: <strog class="theme_color">*</strog></label>
 <div class="col-sm-6">
  <select name="entrego_qui" id="entrego_qui"  class="form-control select" required>
    @foreach($empleado as $empleados)
    <option value=" {{$empleados->id}}">
     {{$empleados->nombre}} {{$empleados->apellidos}} 
   </option>
   @endforeach
 </select>
 <div class="help-block with-errors"></div>
</div>
</div><!--/form-group-->

<div class="form-group">
  <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
  <div class="col-sm-6">

    <input name="observacionesf" type="text"  maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes de la Fumigación"/>
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

<div class="form-group">
</div>

<div class="form-group">
 <label class="col-sm-3 control-label">Agroquímicos a Aplicar: <strog class="theme_color">*</strog></label>
 <div class="col-sm-6">
  <select name="quimicos" id="quimicos"  class="form-control select" required>
    @foreach($almacenagroquimicos as $quimico)
    <option value="{{$quimico->id}}_{{$quimico->nombre}}_{{$quimico->codigo}}_{{$quimico->descripcion}}_{{$quimico->cantidad}}_{{$quimico->medida}}">
     {{$quimico->nombre}} 
   </option>
   @endforeach
 </select>
   <span id="erroragro" style="color:#FF0000;"></span>
 <div class="help-block with-errors"></div>
</div>
<a class="btn btn-sm btn-danger"   style="margin-right: 10px;"  onclick="agroquimico();" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Agregar Agroquimico"> <i class="fa fa-plus"></i>Agregar</a>
</div><!--/form-group-->





<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
 <div class="form-group"> 
  <label for="scantidad">Cantidad Aplicada <strog class="theme_color">*</strog></label>
  <input name="scantidad" id="scantidad" type="number" value="1" max="1000000" min="1" required="" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" maxlength="5"  />
</div>    
  <span id="errorcantidad" style="color:#FF0000;"></span>
</div>  

<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
 <div class="form-group"> 
  <label for="pcantidad">Cantidad en Almacén <strog class="theme_color">*</strog></label>
  <input name="pcantidad" id="pcantidad" value="" type="number" disabled class="form-control" />
</div>    
</div>  
<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
 <div class="form-group"> 
  <label for="amedida">Medida </label>
  <input name="amedida" id="amedida" value="" type="text" disabled class="form-control" />
</div>
</div>  

<div class="col-sm-4">
 <div class="form-group"> 
  <label for="descripciona">Descripción </label>
  <input name="descripciona" id="descripciona" disabled class="form-control" />
</div>    
</div> 

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
  <div class="form-group"> 
    <table id="detalles" name="detalles[]" value="" class="table table-striped table-bordered table-condensed table-hover">
      <thead style="background-color:#A9D0F5">
        <th>Opciones</th>
        <th>N°</th>
        <th>Nombre de Agroquimico</th>
        <th>Descripcion</th>
        <th>Cantidad Aplicada</th>

      </thead>
      <tfoot>
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
</div>
</div>


<div class="form-group">
  <label class="col-sm-3 control-label">Estado de la Fumigacion: <strog class="theme_color">*</strog></label>
  <div class="col-sm-6">
    <select name="status" value="{{Input::old('status')}}" required>
      @if(Input::old('status')=="Proceso")
      <option value='En Proceso' selected>En Proceso
      </option>
      <option value="Realizada">Realizada</option>
      @else
      <option value='Realizada' selected>Realizada
      </option>
      <option value="En Proceso">En Proceso</option>
      @endif
    </select>

  </div>
</div>

<div class="form-group">
  <div class="col-sm-6">
    <input  id="codigo2" value="" name="codigo2[]" type="hidden"  class="form-control"  placeholder="Ingrese el Codigo de Barras"/>
  </div>
</div>

<div class="form-group">
  <div class="col-sm-6">
    <input  id="nombre_fum" value="" name="nombre_fum" type="hidden"  class="form-control""/>
  </div>
</div>

<div class="form-group">
  <div class="col-sm-6">
    <input  id="edit" value="2" name="edit" type="hidden"  class="form-control"  placeholder=""/>
  </div>
</div>

<div class="form-group">
  <div class="col-sm-offset-7 col-sm-5">
    <button type="submit" onclick="return save();" class="btn btn-primary">Guardar</button>
    <a href="{{url('/fumigaciones')}}" class="btn btn-default"> Cancelar</a>
  </div>
</div><!--/form-group--> 



  </form>
</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
@include('almacen.agroquimicos.modalreactivar')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


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
    var y = document.getElementById("quimicos").length;
    //  alert(y);
    var i= 0;
    while(i <= y){


        if (i == y){
    swal("Producto No Encontrado!", "Verifique el Codigo de Barras!", "error");
    break;
  }

      var e = document.getElementById("quimicos");
      var value = e.options[e.selectedIndex=i].value;
      var text = e.options[e.selectedIndex=i].text;
      var cantidadtotal = value;
      limite = "5",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
      stock=arregloDeSubCadenas[0];
      descripcion=arregloDeSubCadenas[1];
      codigo=arregloDeSubCadenas[2];
      id=arregloDeSubCadenas[3];
      nombre=arregloDeSubCadenas[4];
      tecla=(document.all) ? event.keyCode : event.which;
             if (codigo == x){
              swal("Producto Encontrado:"+nombre +"!", "Stock de Salida!", "success",{content: "input", inputType:"number",}).then((value) => {
                var aux =`${value}`;

                 document.getElementById("scantidad").value = aux;
  //swal(aux);
});
   
    document.getElementById('quimicos').selectedIndex = i;
    document.getElementById("pcantidad").value=stock;
   document.getElementById("descripcion").value=descripcion;
   
    document.getElementById("scantidad").max=stock;
    break;
  }

  i++;
}


return false;
}

 //return false;
    
}

  Array.prototype.sortNumbers = function(){
    return this.sort(
      function(a,b){
        return a - b
      }
      );
  }
  window.onload=function() {
     //stock agroquimicos
     var select2 = document.getElementById('quimicos');
     var selectedOption2 = select2.selectedIndex;
     var cantidadtotal = select2.value;
     limite = "6",
     separador = "_",
     arregloDeSubCadenas = cantidadtotal.split(separador, limite);
     var ida =arregloDeSubCadenas[0];
     var nombrea =arregloDeSubCadenas[1];
     var codigoa = arregloDeSubCadenas[2];
     var descripciona = arregloDeSubCadenas[3];
     var cantidada = arregloDeSubCadenas[4];
     var medidaa = arregloDeSubCadenas[5];
     document.getElementById("pcantidad").value=cantidada ;
     document.getElementById("descripciona").value=descripciona;
     document.getElementById("amedida").value=medidaa;
     document.getElementById("scantidad").value = "1";
       document.getElementById("codigo").select();
   }
    //  <option value="{{$quimico->id}}}_{{$quimico->nombre}}_{{$quimico->codigo}}_{{$quimico->descripcion}}_{{$quimico->cantidad}}_{{$quimico->medida}}">

      var select = document.getElementById('quimicos');
  //alert(select);
  select.addEventListener('change',
    function(){
      var selectedOption = this.options[select.selectedIndex];
     // alert(selectedOption.value);
   //   console.log(selectedOption.value + ': ' + selectedOption.text);
   var cantidadtotal = selectedOption.value;
   limite = "6",
   separador = "_",
   arregloDeSubCadenas = cantidadtotal.split(separador, limite);
   var ida =arregloDeSubCadenas[0];
   var nombrea =arregloDeSubCadenas[1];
   var codigoa = arregloDeSubCadenas[2];
   var descripciona = arregloDeSubCadenas[3];
   var cantidada = arregloDeSubCadenas[4];
   var medidaa = arregloDeSubCadenas[5];
   document.getElementById("pcantidad").value=cantidada ;
   document.getElementById("descripciona").value=descripciona;
   document.getElementById("amedida").value=medidaa;
   document.getElementById("scantidad").value = "1";



 });

   var uno = 1;
  var uno2 = 1;
  function agroquimico(){
    var select2=document.getElementById('quimicos');
    var cantidadtotal2 = select2.value;
    limite2 = "5",
    separador2 = "_",
    arregloDeSubCadenas2 = cantidadtotal2.split(separador2, limite2);
    x=arregloDeSubCadenas2[0];


    var valida = document.getElementById("scantidad").value;
    var valida2 = document.getElementById("pcantidad").value;
    var y = parseInt(valida);
    var z = parseInt(valida2);
    var comprueba = recorre(x)
    if (comprueba == 1){
      //alert("Este Material Ya se ha Insertado en la Tabla");
     // swal("Duplicado!", "Este Material Ya se ha Insertado en la Tabla!", "info");
       document.getElementById("erroragro").innerHTML = "Este Material Ya se ha Insertado en la Tabla";

    }else{
      if (y > z) {
       // swal("Error!", "El Stock de Salida no Puede Ser Mayor que la Cantidad Actual en Almacén!", "error");
       // alert("El Stock de Salida no Puede Ser Mayor que la Cantidad Actual en Almacén");
       document.getElementById("errorcantidad").innerHTML = "El Stock de Salida no Puede Ser Mayor que la Cantidad Actual en Almacén";

      }else if(y < 1){
        document.getElementById("errorcantidad").innerHTML = "El Stock de Salida no Puede Ser Menor de 1";
     //   swal("Error!", "El Stock de Salida no Puede Ser Menor de 1 !", "error");
       // alert("El Stock de Salida no Puede Ser Menor de 1");

      }else{
        document.getElementById("erroragro").innerHTML =""
        document.getElementById("errorcantidad").innerHTML =""

        var select=document.getElementById('quimicos');
        var cantidadtotal = select.value;
        limite = "6",
        separador = "_",
        arregloDeSubCadenas = cantidadtotal.split(separador, limite);
        var id2= uno2++;
        var ida =arregloDeSubCadenas[0];
        var nombrea =arregloDeSubCadenas[1];
        var codigoa = arregloDeSubCadenas[2];
        var descripciona = arregloDeSubCadenas[3];
        var cantidada = arregloDeSubCadenas[4];
        var medidaa = arregloDeSubCadenas[5];
        var tabla = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);

    var scantidadx = document.getElementById("scantidad");
    var cantidaden = scantidadx.value;

    cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminarFila(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = ida;
    cell3.innerHTML = nombrea;
    cell4.innerHTML = descripciona;
    cell5.innerHTML = cantidaden;

    var x = document.getElementById("quimicos");
    //x.remove(x.selectedIndex);
    document.getElementById("total").value=id2;
    limpiar();
  }
}}

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
        z=1;
        return(r);
      }
      z ++;
    }

    else if(z == 2){
         //alert(z)
       //  document.getElementById("id_materialk").value=table.rows[r].cells[c].innerHTML;
       z ++;
       

     }else if(z == 3){
      z ++;
    }else if(z == 4){

     z ++;
   } else if (z == 5){
       //  alert(z)
     //  document.getElementById("entrego").value=table.rows[r].cells[c].innerHTML;
         //alert(table.rows[r].cells[c].innerHTML);

//alert(arreglo);
z ++;
}else if (z == 6){
 //document.getElementById("recibio").value=table.rows[r].cells[c].innerHTML;
 // alert(table.rows[r].cells[c].innerHTML);
 z ++;

}else if(z == 7){
         //alert(z)
        // document.getElementById("movimiento").value=table.rows[r].cells[c].innerHTML;
           //alert(table.rows[r].cells[c].innerHTML);
           z ++;

         }else{
       // document.getElementById("fecha").value=table.rows[r].cells[c].innerHTML;
          //alert(table.rows[r].cells[c].innerHTML);
          z = 1;

        }

      }
    }
  }   

  function eliminarFila(value) {

    document.getElementById("detalles").deleteRow(value);
    var id2= uno2--;
    var menos =document.getElementById("detalles").rows
    var r = menos.length;
    document.getElementById("total").value= r - 2;
    limpiar();
  }   


  function codigos(){

    var cuenta = document.getElementById('codigo');
    var x = cuenta.value;
    var z = x.length
    if (z == 12  ) {
      var busca = z;
    //  alert ("12 entro");
    var y = document.getElementById("quimicos").length;
    //  alert(y);
    var i= 0;
    while(i < y){
      var e = document.getElementById("quimicos");
      var value = e.options[e.selectedIndex=i].value;
      var text = e.options[e.selectedIndex=i].text;
      var cantidadtotal = value;
      limite = "6",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
      var ida =arregloDeSubCadenas[0];
      var nombrea =arregloDeSubCadenas[1];
      var codigoa = arregloDeSubCadenas[2];
      var descripciona = arregloDeSubCadenas[3];
      var cantidada = arregloDeSubCadenas[4];
      var medidaa = arregloDeSubCadenas[5];

      if (codigoa == x){
       document.getElementById('quimicos').selectedIndex = i;
       document.getElementById("pcantidad").value=cantidada;
       document.getElementById("descripciona").value=descripciona;
       document.getElementById("scantidad").value = "1";
       break;
     }
     i++;
   }
 }

}
function limpiar(){
  document.getElementById("scantidad").value="1";
}

function save() {
  var t = document.getElementById("total").value;
      if (t > 0){
var x = 1
var arreglo2 = [];
var table2 = document.getElementById('detalles');
for (var r = 1, n = table2.rows.length-1; r < n; r++) {
  for (var c = 1, m = table2.rows[r].cells.length; c < m; c++) {
   if (x == 1){
        //alert(z)
       // document.getElementById("id_materialk").id=z;
      // document.getElementById("id_materialk").value=table.rows[r].cells[c].innerHTML;
      arreglo2.push(table2.rows[r].cells[c].innerHTML);
      x ++;
    }else if (x== 2){
      arreglo2.push(table2.rows[r].cells[c].innerHTML);
      x ++;

    }else if (x == 3){
      arreglo2.push(table2.rows[r].cells[c].innerHTML);
      x ++;

    }else {
      arreglo2.push(table2.rows[r].cells[c].innerHTML);

      document.getElementById("codigo2").value=arreglo2;
      x = 1;

    }

  }
}
var tam = arreglo2.length / 4;
document.getElementById("total").value=tam;
var auxy = document.getElementById('fumigador');
var nombx = auxy.options[auxy.selectedIndex].text;
document.getElementById('nombre_fum').value=nombx;
}else{
 // alert('No hay Elementos Agregados, Para Poder Guardar');
  swal("Error!","No hay Elementos Agregados en la Tabla de Fumigaciones, Para Poder Guardar", "error");
  return false;

}
}
    </script>

@endsection