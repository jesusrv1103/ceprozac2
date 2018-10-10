@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Almacenes Generales</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/almacen/general')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('/almacen/general')}}">Almacenes Generales</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Almacén de {{ $almacen->nombre}}</strong></h2>
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
        <div class="porlets-content">
          <form action="{{url('/almacen/general', [$almacen->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">


            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text"  value="{{$almacen->nombre}}" maxlength="30"  onchange="mayus(this);"  class="form-control" required value="" placeholder="Ingrese nombre del producto" />

              </div>
            </div>

                                    <div class="form-group">
              <label class="col-sm-3 control-label">Ubicación: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="ubicacion" type="text"  value="{{$almacen->ubicacion}}" maxlength="30"  onchange="mayus(this);"  class="form-control" required value="" placeholder="Ingrese la Ubicación del Almacén" />

              </div>
            </div>


    <div class="form-group">
              <label class="col-sm-3 control-label">Tipo de Capacidad (Casillero,Cajon,Espacio,m2,etc..)) : <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="medida" id="medida" type="text"  value="{{$almacen->medida}}"  maxlength="70"  onchange="mayus(this);"  class="form-control" required value="" placeholder="Tipo de Capacidad (Cajon,m2,etc..):" />
              </div>
            </div>

                <div class="form-group">
              <label class="col-sm-3 control-label">Capacidad: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="capacidad" id="capacidad" onKeyUp="generar()" type="text"  value="{{$almacen->capacidad}}"  maxlength="70"  onchange="soloNumeros(this);"  class="form-control" required value="" placeholder="Ingrese Descripción del Material" />
              </div>
            </div>



                <div class="form-group">
              <label class="col-sm-3 control-label">Descripción: <strog class="theme_color"></strog></label>
              <div class="col-sm-6">
                <input name="descripcion" type="text"  value="{{$almacen->descripcion}}"  maxlength="70"  onchange="mayus(this);"  class="form-control" required value="" placeholder="Ingrese Descripción del Material" />
              </div>
            </div>

              <div class="form-group">
              <label class="col-sm-3 control-label">Espacio Ocupado Actualmente en Almacén: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="ocupado" id="ocupado" type="text"  value="{{$almacen->esp_ocupado}}"  maxlength="70"  onchange="soloNumeros(this);"  class="form-control" value="" placeholder="Ingrese el Espacio Ocupado Actualmente" readonly/>
              </div>
            </div>

             <div class="form-group">
              <label class="col-sm-3 control-label">Espacio Libre Actualmente en Almacén: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="libre" id="libre" type="text"  value="{{$almacen->esp_libre}}"  maxlength="70"  onchange="soloNumeros(this);"  class="form-control"  value="" placeholder="Ingrese el Espacio Ocupado Actualmente" readonly/>
              </div>
            </div>


                <div class="form-group">
      <div class="col-sm-6">
        <input  id="totallibre" value="" name="totallibre" type="hidden"  maxlength="50"  class="form-control"  />
      </div>
    </div>

                    <div class="form-group">
      <div class="col-sm-6">
        <input  id="totalocupado" value="" name="totalocupado" type="hidden"  maxlength="50"  class="form-control" />
      </div>
    </div>

    <div class="form-group">
                  <label class="col-sm-3 control-label">Espacio Actualmente: <strog class="theme_color">*</strog></label>
  <div class="col-sm-6">
    <div class="form-group"> 
<table id="myTable" name="myTable" value=""   class="table table-striped table-bordered table-condensed table-hover">
        <thead style="background-color:#A9D0F5">

        </thead>
  <tr>
  </tr>
</table>
<br>
</div>
</div>
</div>

               


   

   <div class="form-group">
    <div class="col-sm-offset-7 col-sm-5">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <a href="{{url('/almacen/general')}}" class="btn btn-default"> Cancelar</a>
    </div>
  </div><!--/form-group-->


</form>
</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script type="text/javascript">

    Array.prototype.sortNumbers = function(){
    return this.sort(
        function(a,b){
            return a - b
        }
    );
}
function generar(){
    var arreglolibre = [];
  var arregloocupado = [];
  var tamaño_libre;
  var tamaño_ocupado;
  var cantidad = document.getElementById('capacidad').value;
  if (cantidad > 0){
  for (var i = 1; cantidad >= i ; i++) {
    var menos =document.getElementById("myTable").rows.length-1
    if (menos > 0) {
      var suma = 1;
      for (var l = 1; l <= menos; l++){        
document.getElementById("myTable").deleteRow(0);
suma++;
      }
     
    }

    //document.getElementById("myTable").deleteRow(i);
     //row.deleteRow(0);
  }
  
  var suma = cantidad / 4; //8
  var cuenta;
  var valor = 1;

  for (cuenta = 1; cuenta <= cantidad ; cuenta++) {
       var table = document.getElementById("myTable");
       var med = document.getElementById("medida");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = med.value+" N° "+valor;
    var agregaHTML = "<input type=button value=Libre class=agrega id="+(valor)+">";
    cell2.innerHTML = agregaHTML;
     document.getElementById(""+valor).style.color = "#00ff00";
    valor++;
    arreglolibre.push(cuenta);
     document.getElementById('libre').value=arreglolibre;
     tamaño_libre = arreglolibre.length;
     document.getElementById('totallibre').value=tamaño_libre;
     tamaño_ocupado = arregloocupado.length;
     document.getElementById('totalocupado').value=tamaño_ocupado;




    cell2.addEventListener("click", function(event) {
    var currentId = event.target.id;
    var z =  document.getElementById('capacidad').value;
    // Change the id (last character, some tweak)
  //  alert(event.target.id); // Before
    //event.target.id = event.target.id[event.target.id.length - 1];
    //alert(event.target.id); // After
    var aux = event.target.id;
    var calcula = document.getElementById(""+aux).value;
    var arr = document.getElementById(""+aux).id;


    if (calcula == "Ocupado") {
      for (var i = 0; i < arregloocupado.length; i++) {
  if (arr == arregloocupado[i]) {
    arregloocupado.splice(i, 1);
  }
}

      document.getElementById(""+aux).value = "Libre";
    document.getElementById(""+aux).style.color = "#00ff00";



    arreglolibre.push(arr);
    arregloocupado.sortNumbers();
arreglolibre.sortNumbers();
    document.getElementById('libre').value=arreglolibre;
    document.getElementById('ocupado').value=arregloocupado;
         tamaño_libre = arreglolibre.length;
     document.getElementById('totallibre').value=tamaño_libre;
     tamaño_ocupado = arregloocupado.length;
     document.getElementById('totalocupado').value=tamaño_ocupado;
    }else{

      for (var i = 0; i < arreglolibre.length; i++) {
  if (arr == arreglolibre[i]) {
    arreglolibre.splice(i, 1);
  }
}



          document.getElementById(""+aux).value = "Ocupado";
    document.getElementById(""+aux).style.color = "#ff0000";
    arregloocupado.push(arr);
    arregloocupado.sortNumbers();
arreglolibre.sortNumbers();
    document.getElementById('ocupado').value=arregloocupado;
    document.getElementById('libre').value=arreglolibre;
         tamaño_libre = arreglolibre.length;
     document.getElementById('totallibre').value=tamaño_libre;
     tamaño_ocupado = arregloocupado.length;
     document.getElementById('totalocupado').value=tamaño_ocupado;
    }
  }); 

}
}
}

window.onload = function() {
      var arreglolibre2 = [];
  var arregloocupado2 = [];
        var arreglolibre = [];
  var arregloocupado = [];


  arregloocupado2= document.getElementById("ocupado").value;
  arreglolibre2= document.getElementById("libre").value;
  var tamaño_libre;
  var libres = arreglolibre2.split(",");
    tamaño_libre = libres.length;
  var tamaño_ocupado;
  var ocupado = arregloocupado2.split(",");
  tamaño_ocupado = ocupado.length;


 // alert(tamaño_libre);
  //alert(libres[1]);
  if (arreglolibre2.length > 0){
      for (var i = 0; i < tamaño_libre; i++){
  arreglolibre.push(libres[i]);
  }
var valor = 0;
    for (var cuenta = 1; cuenta <= tamaño_libre ; cuenta++) {
       var table = document.getElementById("myTable");
       var med = document.getElementById("medida");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = med.value+" N° "+libres[valor];
    var agregaHTML = "<input type=button value=Libre class=agrega id="+libres[(valor)]+">";
    cell2.innerHTML = agregaHTML;
     document.getElementById(""+libres[valor]).style.color = "#00ff00";
    valor++;

         cell2.addEventListener("click", function(event) {
    var currentId = event.target.id;
    var z =  document.getElementById('capacidad').value;
    var aux = event.target.id;
    var calcula = document.getElementById(""+aux).value;
    var arr = document.getElementById(""+aux).id;


    if (calcula == "Ocupado") {
      for (var i = 0; i < arregloocupado.length; i++) {
  if (arr == arregloocupado[i]) {
    arregloocupado.splice(i, 1);
  }
}

      document.getElementById(""+aux).value = "Libre";
    document.getElementById(""+aux).style.color = "#00ff00";
    arreglolibre.push(arr);
    arregloocupado.sortNumbers();
arreglolibre.sortNumbers();
    document.getElementById('libre').value=arreglolibre;
    document.getElementById('ocupado').value=arregloocupado;
         tamaño_libre = arreglolibre.length;
     document.getElementById('totallibre').value=tamaño_libre;
     tamaño_ocupado = arregloocupado.length;
     document.getElementById('totalocupado').value=tamaño_ocupado;
    }else{
      for (var i = 0; i < arreglolibre.length; i++) {
  if (arr == arreglolibre[i]) {
    arreglolibre.splice(i, 1);
  }
}

          document.getElementById(""+aux).value = "Ocupado";
    document.getElementById(""+aux).style.color = "#ff0000";
    arregloocupado.push(arr);
    arregloocupado.sortNumbers();
arreglolibre.sortNumbers();
    document.getElementById('ocupado').value=arregloocupado;
    document.getElementById('libre').value=arreglolibre;
         tamaño_libre = arreglolibre.length;
     document.getElementById('totallibre').value=tamaño_libre;
     tamaño_ocupado = arregloocupado.length;
     document.getElementById('totalocupado').value=tamaño_ocupado;
    }
  })
}
}

if (arregloocupado2.length >0){
      for (var x = 0; x < tamaño_ocupado; x++){
  arregloocupado.push(ocupado[x]);
  }
var valor2 = 0;
    for (var cuenta = 1; cuenta <= tamaño_ocupado ; cuenta++) {
       var table = document.getElementById("myTable");
       var med = document.getElementById("medida");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = med.value+" N° "+ocupado[valor2];
    var agregaHTML = "<input type=button value=Ocupado class=agrega id="+ocupado[(valor2)]+">";
    cell2.innerHTML = agregaHTML;
     document.getElementById(""+ocupado[valor2]).style.color = "#ff0000";
    valor2++;

         cell2.addEventListener("click", function(event) {
    var currentId = event.target.id;
    var z =  document.getElementById('capacidad').value;
    var aux = event.target.id;
    var calcula = document.getElementById(""+aux).value;
    var arr = document.getElementById(""+aux).id;


    if (calcula == "Ocupado") {
      for (var i = 0; i < arregloocupado.length; i++) {
  if (arr == arregloocupado[i]) {
    arregloocupado.splice(i, 1);
  }
}

      document.getElementById(""+aux).value = "Libre";
    document.getElementById(""+aux).style.color = "#00ff00";

    arreglolibre.push(arr);
    arregloocupado.sortNumbers();
arreglolibre.sortNumbers();
    document.getElementById('libre').value=arreglolibre;
    document.getElementById('ocupado').value=arregloocupado;
         tamaño_libre = arreglolibre.length;
     document.getElementById('totallibre').value=tamaño_libre;
     tamaño_ocupado = arregloocupado.length;
     document.getElementById('totalocupado').value=tamaño_ocupado;
    }else{
      for (var i = 0; i < arreglolibre.length; i++) {
  if (arr == arreglolibre[i]) {
    arreglolibre.splice(i, 1);
  }
}

          document.getElementById(""+aux).value = "Ocupado";
    document.getElementById(""+aux).style.color = "#ff0000";
    arregloocupado.push(arr);
    arregloocupado.sortNumbers();
arreglolibre.sortNumbers();
    document.getElementById('ocupado').value=arregloocupado;
    document.getElementById('libre').value=arreglolibre;
         tamaño_libre = arreglolibre.length;
     document.getElementById('totallibre').value=tamaño_libre;
     tamaño_ocupado = arregloocupado.length;
     document.getElementById('totalocupado').value=tamaño_ocupado;
    }
  })
}
}


  //funciones a ejecutar
};

</script>
@endsection


</head>