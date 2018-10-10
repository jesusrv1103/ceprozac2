@extends('layouts.principal')
@section('contenido')
<style type="text/css">
  .lbldetalle{
    color:#2196F3;
  }
  .h3titulo{
    margin-left: 30px;
    color:#2196F3;
    margin-top: 30px;
  }
</style>
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Recepción de Compra</h1>
    <h2 class="active"></h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a href="?c=Inicio">Inicio</a></li>
      <li><a href="?c=Beneficiario">Editar Recepción de Compra</a></li>
      <li class="active"></li>
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
              <h2 class="content-header theme_color" style="margin-top: -5px;"></h2>
            </div>
            <div class="col-md-4">
              <div class="btn-group pull-right">
                <div class="actions"> 
                </div>
              </div>
            </div>    
          </div>
        </div><!--header-->


        <div class="porlets-content">
          <div  class="form-horizontal row-border" > <!--acomodo-->
            <form class="" id="myForm" action="{{route('compras.recepcion.store')}}" method="post" role="form" enctype="multipart/form-data" parsley-validate novalidate data-toggle="validator">
              {{csrf_field()}}
              <div id="smartwizard">
                <ul>
                  <li><a href="#step-1">Recepción de Compra</a></li>
                  <li><a href="#step-2">Muestreo de Materia Prima</a></li>
                  <li><a href="#step-3">Pesaje</a></li>
                </ul>
                <div>
                  <div id="step-1" class="">
                    <div class="user-profile-content">

                      <div id="form-step-0" role="form" data-toggle="validator">
                        <h3 class="h3titulo">Editar :Informacion de la Compra {{$compra->nombre}}</h3>

                        <input  name="fecha_compra" type="hidden" id="fecha_compra"  />
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Fecha de Compra: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">

                           <input type="date" name="fecha" id="fecha" value="{{$compra->fecha_compra}}" required class="form-control mask" >
                         </div>
                       </div>

                       <div class="form-group">
                        <label class="col-sm-3 control-label">Proveedor: <strog class="theme_color">*</strog></label>
                        <div class="col-sm-6">
                          <select name="provedor"  id="provedor" class="form-control select2" required>  
                            @foreach($provedores as $empresa)
                            @if ($compra->id_provedor == $empresa->id)
                            <option value="{{$empresa->id}}">{{$empresa->nombre}} {{$empresa->apellidos}}</option>
                            @else
                             <option value="{{$empresa->id}}">{{$empresa->nombre}} {{$empresa->apellidos}}</option>
                            @endif
                           @endforeach              
                         </select>
                         <div class="help-block with-errors"></div>
                       </div>
                     </div><!--/form-group-->

                     <div class="form-group">
                      <label class="col-sm-3 control-label">Transporte Registrado en la Empresa: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-3">
                        <input type="radio" name="registrado" id="registrado" onchange="buscar1()" value="si"> Si<br>
                        <input type="radio" name="registrado" id="registrado" onchange="buscar2()" value="no"> No<br>
                      </div>
                    </div><!--/form-group-->

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Número de Transportes: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-1">
                        <input name="transporte_num" id ="transporte_num" type="number"  value="1" maxlength="5" onchange="mayus(this);"  class="form-control" onkeypress=" return soloNumeros(event);" required /><br></div>
                      </div>

                      <div class="form-group" id="transportediv" style='display:none;'>
                      <label class="col-sm-3 control-label">Seleccióne Transporte: <strog class="theme_color">*</strog></label>
                        <div class="col-sm-6">
                          <select name="transportei" id="transportei"  class="form-control select">  
                            @foreach($transportes as $trans)
                            <option value="{{$trans->nombre_Unidad}}_{{$trans->placas}}">
                             {{$trans->nombre_Unidad}} Placas: {{$trans->placas}}
                           </option>
                           @endforeach              
                         </select>
                         <div class="help-block with-errors"></div>
                       </div>
                       <a class="btn btn-sm btn-danger"   style="margin-right: 10px;"  onclick="transporte();" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Agregar transporte"> <i class="fa fa-plus"></i>Agregar</a>
                     </div><!--/form-group-->

                     <div class="form-group" id="transportediv2" style='display:none;'>
                      <label class="col-sm-3 control-label">Transporte: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-6">
                        <input name="transporte" id="transporte" type="text"  maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" value="" placeholder="Ingrese el Transporte"/>


                        <div class="help-block with-errors"></div>
                      </div>
                      <a class="btn btn-sm btn-danger"   style="margin-right: 10px;"  onclick="transporte();" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Agregar Agroquimico"> <i class="fa fa-plus"></i>Agregar</a>
                    </div><!--/form-group-->

                    <div class="form-group">
                     <label class="col-sm-3 control-label">Transportes: <strog class="theme_color">*</strog></label>
                     <div class="col-sm-6">
                      <table id="transportes" name="transportes[]"  class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                          <th>Opciones</th>
                          <th>Nombre del Transporte</th>
                          <th>Placas</th>

                        </thead>
                        <tfoot>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tfoot>
                        <tbody>

                        </tbody>

                      </table>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Recibe Empresa: <strog class="theme_color">*</strog></label>
                    <div class="col-sm-6">
                      <select name="empresa"  class="form-control select2" required>  
                        @foreach($empresas as $em)
                        @if ($compra->recibe == $em->id)
                        <option value="{{$em->id}}" selected>{{$em->nombre}}</option>
                        @else
                        <option value="{{$em->id}}">{{$em->nombre}}</option>
                        @endif
                       @endforeach              
                     </select>
                     <div class="help-block with-errors"></div>
                   </div>
                 </div><!--/form-group-->

                 <div class="form-group">
                  <label class="col-sm-3 control-label">Recibe Empleado: <strog class="theme_color">*</strog></label>
                  <div class="col-sm-6">
                    <select name="recibe_em"  class="form-control select2" required>  
                      @foreach($empleado as $em)
                      @if ($compra->entregado == $em->id)
                      <option value="{{$em->id}}" selected>{{$em->nombre}} {{$em->apellidos}}</option>
                     @else
                     <option value="{{$em->id}}">{{$em->nombre}} {{$em->apellidos}}</option>
                     @endif

                     @endforeach              
                   </select>
                   <div class="help-block with-errors"></div>
                 </div>
               </div><!--/form-group-->


             <div class="form-group">
              <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
              <div class="col-sm-6">

                <input name="observacionesc" type="text"   maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="{{$compra->observacionesc}}" placeholder="Ingrese Observaciónes de la Compra"/>
              </div>
            </div>

            <div class="form-row">    
              <label class="col-sm-3 control-label">Precio Total de La Compra: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <div class="input-group">
                 <div class="input-group-addon">$</div>
                 <input  name="precio" id="precio" maxlength="9" type="text"  min="0" max='9999999' class="form-control" required placeholder="Ingrese el Precio de la Compra"  value="{{$compra->total_compra}}" onkeypress=" return soloNumeros(event);"/>
               </div>
             </div>
           </div>


           <div class="form-group">
  <div class="col-sm-6">
    <input  id="transportes2" value="" name="transportes2[]" type="hidden"  class="form-control" />
  </div>
</div>



         </div><!--validator-->
       </div><!--user-profile-content-->
     </div><!--step-1-->

     <div id="step-2" class="">
      <div class="user-profile-content">
        <div id="form-step-1" role="form" data-toggle="validator">
          <h3 class="h3titulo">Editar: Materia Prima</h3>

          <div class="form-group">
            <label class="col-sm-3 control-label">Nombre de la Materia Prima: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="producto" id="producto" class="form-control select" required>  
                @foreach($productos as $pro)
                @if($compra->id_producto == $pro->id)
                <option value="{{$pro->id}}" selected>{{$pro->nombre}}</option>
                @else
                <option value="{{$pro->id}}" >{{$pro->nombre}}</option>
                @endif
               @endforeach              
             </select>
             <div class="help-block with-errors"></div>
           </div>
         </div><!--/form-group-->

         <div class="form-group">
          <label class="col-sm-3 control-label">Calidad: <strog class="theme_color">*</strog></label>
          <div class="col-sm-6">
            <select name="calidad"  id ="calidad" class="form-control select" required onclick="codifica()">  
              @foreach($calidad as $cal)
              @if ($compra->id_calidad == $cal->id)
              <option value="{{$cal->id}}" selected>{{$cal->nombre}}</option>
              @else
              <option value="{{$cal->id}}">{{$cal->nombre}}</option>
              @endif
             @endforeach              
           </select>
           <div class="help-block with-errors"></div>
         </div>
       </div><!--/form-group-->

       <div class="form-group">
        <label class="col-sm-3 control-label">Formato de Empaque: <strog class="theme_color">*</strog></label>
        <div class="col-sm-6">
          <select name="empaque"  class="form-control select" required>  
            @foreach($empaque as $em)
            @if ($compra->id_empaque == $em->id)
            <option value="{{$em->id}}" selected>{{$em->formaEmpaque}}</option>
            @else
            <option value="{{$em->id}}">{{$em->formaEmpaque}}</option>
            @endif
           @endforeach              
         </select>
         <div class="help-block with-errors"></div>
       </div>
     </div><!--/form-group-->

     <div class="form-group ">
      <label class="col-sm-3 control-label">Porcentaje de humedad<strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <input parsley-type="number"  value="{{$compra->humedad}}" type="text" maxlength="3" required name="humedad" id="humedad"  class="form-control"  onkeypress=" return soloNumeros(event);">
      </div>
    </div>

    <div class="form-group ">
      <label class="col-sm-3 control-label">Número de Pacas<strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <input parsley-type="number" type="text" value="{{$compra->pacas}}" maxlength="6" required  name="num_pacas" id="num_pacas"   class="form-control" onKeyUp="raiz()"  onkeypress=" return soloNumeros(event);">
      </div>
    </div>

    <div class="form-group ">
      <label class="col-sm-3 control-label">Número de Pacas a Revisar<strog class="theme_color">*</strog></label>
      <div class="col-sm-6">
        <input parsley-type="number" value="{{$compra->pacas_rev}}"  type="number" required maxlength="6" name="pacas_rev" id="pacas_rev"   class="form-control"  readonly onkeypress=" return soloNumeros(event);">
      </div>
    </div>

                            <div class="form-group">
              <label class="col-sm-3 control-label">Codificación de Lote: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="codificacion" id="codificacion" value="{{$compra->nombre}}" type="text"  maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes de la Compra" required/>
              </div>
            </div>


    <div class="form-group">
      <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
      <div class="col-sm-6">

        <input name="observacionesm" type="text"   maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="{{$compra->observacionesm}}" placeholder="Ingrese Observaciónes del Muestreo"/>
      </div>
    </div>




  </div><!--validator-->
</div><!--user-profile-content-->
</div><!--step-2-->

<div id="step-3" class="">
  <div class="user-profile-content">
    <div id="form-step-2" role="form" data-toggle="validator">
      <h3 class="h3titulo">Editar: Datos de Pesaje</h3>


      <div class="form-group">
       <label class="col-sm-3 control-label">Bascula: <strog class="theme_color">*</strog></label>
       <div class="col-sm-6">
        <select name="bascula"  class="form-control select" required>
          @foreach($servicio as $bascula)
          @if ($compra->id_bascula == $bascula->id)
          <option value="{{$bascula->id}}" selected>{{$bascula->nombreBascula}} </option>
          @else
          <option value="{{$bascula->id}}" >{{$bascula->nombreBascula}} </option>
          @endif

         @endforeach
       </select>
       <div class="help-block with-errors"></div>
     </div>
   </div><!--/form-group-->

   <div class="form-group">
    <label class="col-sm-3 control-label">Ticket: <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input name="numeroticket" type="text"  onchange="mayus(this);"  class="form-control" required value="{{$compra->ticket}}" placeholder="Ingrese numero de Ticket" />
    </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-3 control-label">KG Enviados<strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input parsley-type="number" type="text" maxlength="5" required parsley-range="[0, 10000]" name="enviados" id="enviados"  value="{{$compra->kg_enviados}}" class="form-control mask"  placeholder="Ingrese el numero de Kilogramos Enviados"  onKeyUp="calcula()" onkeypress="return soloNumeros(event);">
    </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-3 control-label">KG Recibidos<strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input parsley-type="number" type="text" maxlength="5" required parsley-range="[0, 10000]" name="recibidos"  onKeyUp="calcula()"  id ="recibidos" class="form-control mask"  placeholder="Ingrese el numero de Kilogramos Recibidos" value="{{$compra->kg_recibidos}}" onkeypress=" return soloNumeros(event);">
    </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-3 control-label">Diferencia<strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input parsley-type="number" type="text" maxlength="5" parsley-range="[0, 10000]" name="diferencia" required  readonly  value="{{$compra->diferencia}}" id="diferencia" class="form-control mask";>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
    <div class="col-sm-6">

      <input name="observacionesb" type="text"   maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="{{$compra->observacionesb}}" placeholder="Ingrese Observaciónes del Pesaje"/>
    </div>
  </div>   

                   <div class="form-group">
                  <label class="col-sm-3 control-label">Realizo Pesaje: <strog class="theme_color">*</strog></label>
                  <div class="col-sm-6">
                    <select name="pesaje"  class="form-control select" required>  
                      @foreach($empleado as $em)
                      @if ($compra->peso == $em->id)
                      <option value="{{$em->id}}" selected>{{$em->nombre}} {{$em->apellidos}}</option>
                      @else
                      <option value="{{$em->id}}">{{$em->nombre}} {{$em->apellidos}}</option>
                      @endif
                     @endforeach              
                   </select>
                   <div class="help-block with-errors"></div>
                 </div>
               </div><!--/form-group-->







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
  <div class="col-sm-offset-7 col-sm-5">
    <button type="submit" onclick="save();" class="btn btn-primary">Guardar</button>
    <a href="{{url('/compras/recepcion')}}" class="btn btn-default"> Cancelar</a>
  </div>
</div><!--/form-group--> 

</div><!--validator-->
</div><!--user-profile-content-->
</div><!--step-2-->

</div>
</div>  <!--smartwizard-->            
</form>
</div><!--/form-horizontal-->
</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script type="text/javascript">
  Array.prototype.sortNumbers = function(){
    return this.sort(
      function(a,b){
        return a - b
      }
      );
  }
  window.onload=function() {
    var num = {{$compra->num_transportes}};
    var cantidadtotal =  "{{$compra->transporte}}";
    limite = "10",
    separador = ",",
    arregloDeSubCadenas = cantidadtotal.split(separador, limite);
     var tabla = document.getElementById("transportes");
     y=0;
    for (var i =1 ; i <= num; i++) {
    var row = tabla.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
     cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminartrans(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = arregloDeSubCadenas[y];
    y= y++;
    cell3.innerHTML = arregloDeSubCadenas[y];
    y= y++;

    }

   }



var q = 1;
  var uno = 1;
  var uno2 = 1;

 function transporte(){
   var valida = document.getElementById("transporte_num");
   if (valida.value < q) {
    alert("Solo se han Seleccionado"+valida.value+" Transportes");

  }else{

var reg = document.getElementById("registrado").value;
if (reg == "si"){
   var select=document.getElementById('transportei');
    var cantidadtotal = select.value;
    limite = "3",
    separador = "_",
    arregloDeSubCadenas = cantidadtotal.split(separador, limite);
    var id2= uno++;
    var nombre =arregloDeSubCadenas[0];
    var placas =arregloDeSubCadenas[1];
    var tabla = document.getElementById("transportes");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(id2);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminartrans(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = nombre;
    cell3.innerHTML = placas;
    q=q+1;
}else{
  var id2= uno++;
    var tabla = document.getElementById("transportes");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(id2);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminartrans(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = document.getElementById('transporte').value;
    cell3.innerHTML = document.getElementById('transporte').value;
    q=q+1;

}
  }
}

function eliminartrans(value) {

  document.getElementById("transportes").deleteRow(value);
  q=q-1;
}

  
   

function calcula(){
  var var1 =document.getElementById('enviados').value;
  var var2 =document.getElementById('recibidos').value;
  document.getElementById('diferencia').value=var1-var2;
  var var3 = document.getElementById('diferencia').value;
  if (var3 > 0){
    document.getElementById("diferencia").style.border="1px solid #f00";
  }else{
    document.getElementById("diferencia").style.border="1px solid #00ff00";
  }
}



function save() {
 var z = 1
 var arreglo = [];
 var table = document.getElementById('transportes');
 for (var r = 1, n = table.rows.length-1; r < n; r++) {
  for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
   if (z == 1){
        //alert(z)
       // document.getElementById("id_materialk").id=z;
      // document.getElementById("id_materialk").value=table.rows[r].cells[c].innerHTML;
      arreglo.push(table.rows[r].cells[c].innerHTML);
     z ++;
   }else{
      arreglo.push(table.rows[r].cells[c].innerHTML);
      document.getElementById("transportes2").value=arreglo;
      z = 1;

    }

  }
}

}



function buscar1(){
  document.getElementById('registrado').value="si";
  document.getElementById('transportediv').style.display = 'block';
  document.getElementById('transportediv2').style.display = 'none';

}
function buscar2(){
  document.getElementById('registrado').value="no";
  document.getElementById('transportediv2').style.display = 'block';
  document.getElementById('transportediv').style.display = 'none';


}

function raiz(){
  var aux = document.getElementById('num_pacas').value;
  var z = Math.sqrt(aux) + 1 ;
  document.getElementById('pacas_rev').value=z;

}

function codifica(){
var prov = document.getElementById('provedor');
var proved = prov.options[prov.selectedIndex].text;
      limite = "2",
      separador = " ",
      separador2 = "",
      arregloDeSubCadenas = proved.split(separador, limite);
      var nombre =arregloDeSubCadenas[0];
      var apellido =arregloDeSubCadenas[1];

      arregloDeSubCadenas2 = nombre.split(separador2, limite);
      var nom1 =arregloDeSubCadenas2[0];
      var nom2 =arregloDeSubCadenas2[1];

            arregloDeSubCadenas3 = apellido.split(separador2, limite);
      var ape1 =arregloDeSubCadenas3[0];
      var ape2 =arregloDeSubCadenas3[1];




var prod = document.getElementById('producto');
var produ = prod.options[prod.selectedIndex].text;
      arregloDeSubCadenas3 = produ.split(separador, limite);
      var tipo =arregloDeSubCadenas3[0];
      var nombrep =arregloDeSubCadenas3[1];

      arregloDeSubCadenas4 = tipo.split(separador2, limite);
      var t1 =arregloDeSubCadenas4[0];
      var t2 =arregloDeSubCadenas4[1];

            arregloDeSubCadenas5 = nombrep.split(separador2, limite);
      var x1 =arregloDeSubCadenas5[0];
      var x2 =arregloDeSubCadenas5[1];


var cal = document.getElementById('calidad');
var cali = cal.options[cal.selectedIndex].text;
      arregloDeSubCadenas6 = cali.split(separador, limite);
      var calid1 =arregloDeSubCadenas6[0];
      var calid2 =arregloDeSubCadenas6[1];



var nombrecod=nom1+nom2+ape1+ape2+" "+t1+t2+x1+x2+" "+calid1;
document.getElementById('codificacion').value=nombrecod;



}





</script>

<script type="text/javascript">
  $(document).ready(function(){
        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-info')
        .on('click', function(){
          if( !$(this).hasClass('disabled')){
            var elmForm = $("#myForm");
            if(elmForm){
              elmForm.validator('validate');
              var elmErr = elmForm.find('.has-error');
              if(elmErr && elmErr.length > 0){
                alert('Oops we still have error in the form');
                return false;
              }else{
                alert('Great! we are ready to submit form');
                elmForm.submit();
                return false;
              }
            }
          }
        });
        var btnCancel = $('<button style="margin-left:-200px;"></button>').text('Cancel')
        .addClass('btn btn-danger')
        .on('click', function(){
          $('#smartwizard').smartWizard("reset");
          $('#myForm').find("input, textarea").val("");
        });


        // Smart Wizard
        $('#smartwizard').smartWizard({
          selected: 0,
          theme: 'arrows',
          transitionEffect:'fade',
          toolbarSettings: {toolbarPosition: 'bottom'},
          anchorSettings: {
            markDoneStep: true, // add done css
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
          }
        });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
          var elmForm = $("#form-step-" + stepNumber);
          // stepDirection === 'forward' :- this condition allows to do the form validation
          // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
          if(stepDirection === 'forward' && elmForm){
            elmForm.validator('validate');
            var x= document.getElementById('transportes').rows[1].cells[1].innerHTML;
            if(x !== ""){document.getElementById("transporte_num").style.border="1px solid #00ff00";}else{
              alert('No se ha Ingresado Ningun Transporte en la Tabla de Transporte');
              document.getElementById("transporte_num").style.border="1px solid #f00";
              return false;
            }
            if (document.getElementById('precio').value == ""){
                            alert('No se ha Ingresado el Precio Total de la Compra');
              document.getElementById("precio").style.border="1px solid #f00";
              return false;
            }

            if (stepNumber == 3){
              if (document.getElementById('asignado').value == ""){
                                            alert('Ingrese el Espacio , donde se Enviara la Materia Prima');
              document.getElementById("asignado").style.border="1px solid #f00";
              return false;
              }

            }
            var elmErr = elmForm.children('.has-error');
            if(elmErr && elmErr.length > 0){
              // Form validation failed
              return false;
            }
          }
          return true;
        });

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
          // Enable finish button only on last step
          if(stepNumber == 3){
            $('.btn-finish').removeClass('disabled');
          }else{
            $('.btn-finish').addClass('disabled');
          }
        });

      });

    </script>



    @endsection