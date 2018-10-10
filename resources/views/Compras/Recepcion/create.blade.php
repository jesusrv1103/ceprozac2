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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Recepción de Compra</h1>
    <h2 class="active"></h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a href="?c=Inicio">Inicio</a></li>
      <li><a href="?c=Beneficiario">Recepción de Compra</a></li>
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
                  <li><a href="#step-4">Área de Recepción</a></li>
                  <li><a href="#step-5">Fumigación</a></li>
                </ul>
                <div>
                  <div id="step-1" class="">
                    <div class="user-profile-content">

                      <div id="form-step-0" role="form" data-toggle="validator">
                        <h3 class="h3titulo">Informacion de la Compra</h3>

                        <input  name="fecha_compra" type="hidden" id="fecha_compra"  />
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Fecha de Compra: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">

                           <input type="date" name="fecha" id="fecha" value="" required class="form-control mask" >
                         </div>
                       </div>

                       <div class="form-group">
                        <label class="col-sm-3 control-label">Proveedor: <strog class="theme_color">*</strog></label>
                        <div class="col-sm-6">
                          <select name="provedor"  id="provedor" class="form-control select2" required>  
                            @foreach($provedores as $empresa)
                            <option value="{{$empresa->id}}">
                             {{$empresa->nombre}} {{$empresa->apellidos}}
                           </option>
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
                           <span id="errornumtrans" style="color:#FF0000;"></span>
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
                      <a class="btn btn-sm btn-danger"   style="margin-right: 10px;"  onclick="transporte();" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Agregar"> <i class="fa fa-plus"></i>Agregar</a>
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
                   <label class="col-sm-3 control-label"> <strog class="theme_color"></strog></label>
                     <div class="col-sm-6">
                  <span id="errortransp" style="color:#FF0000;"></span>
                  </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-3 control-label">Recibe Empresa: <strog class="theme_color">*</strog></label>
                    <div class="col-sm-6">
                      <select name="empresa"  class="form-control select2" required>  
                        @foreach($empresas as $em)
                        <option value="{{$em->id}}">
                         {{$em->nombre}}
                       </option>
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
                      <option value="{{$em->id}}">
                       {{$em->nombre}} {{$em->apellidos}}
                     </option>
                     @endforeach              
                   </select>
                   <div class="help-block with-errors"></div>
                 </div>
               </div><!--/form-group-->


               <div class="form-group">
                <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
                <div class="col-sm-6">

                  <input name="observacionesc" type="text"   maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes de la Compra"/>
                </div>
              </div>

              <div class="form-row">    
                <label class="col-sm-3 control-label">Precio Total de La Compra: <strog class="theme_color">*</strog></label>
                <div class="col-sm-6">
                  <div class="input-group">
                   <div class="input-group-addon">$</div>
                   <input  name="precio" id="precio" maxlength="9" type="text"  min="0" max='9999999' class="form-control" placeholder="Ingrese el Precio de la Compra"  value="" onkeypress=" return soloNumeros(event);" readonly />
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
            <h3 class="h3titulo">Materia Prima</h3>

            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre de la Materia Prima: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <select name="producto" id="producto" class="form-control select" required>  
                  @foreach($productos as $pro)
                  <option value="{{$pro->id}}">
                   {{$pro->nombre}}
                 </option>
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
                <option value="{{$cal->id}}">
                 {{$cal->nombre}}
               </option>
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
              <option value="{{$em->id}}">
               {{$em->formaEmpaque}}
             </option>
             @endforeach              
           </select>
           <div class="help-block with-errors"></div>
         </div>
       </div><!--/form-group-->

       <div class="form-group ">
        <label class="col-sm-3 control-label">Porcentaje de humedad<strog class="theme_color">*</strog></label>
        <div class="col-sm-6">
          <input parsley-type="number"  type="text" maxlength="3" required name="humedad" id="humedad"  class="form-control"  onkeypress=" return soloNumeros(event);">
        </div>
      </div>


                           <div class="form-group">
                      <label class="col-sm-3 control-label">Seleccione el tipo de Recepción: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-3">
                        <input type="radio" name="tipo_rec" id="tipo_rec" onchange="buscar3()" value="pacas"> Pacas<br>
                        <input type="radio" name="tipo_rec" id="tipo_rec" onchange="buscar4()" value="granel"> Granel<br>
                           <span id="error_rec" style="color:#FF0000;"></span>
                      </div>
                    </div><!--/form-group-->

      <div class="form-group " style='display:none;' id="pacasdiv">
        <label class="col-sm-3 control-label">Número de Pacas<strog class="theme_color">*</strog></label>
        <div class="col-sm-6">
          <input parsley-type="number" type="text" maxlength="6"   name="num_pacas" id="num_pacas"   class="form-control" onKeyUp="raiz()"  onkeypress=" return soloNumeros(event);">
        </div>
      </div>

      <div class="form-group "  id="pacas_revdiv" style='display:none;'>
        <label class="col-sm-3 control-label">Número de Pacas a Revisar<strog class="theme_color">*</strog></label>
        <div class="col-sm-6">
          <input parsley-type="number" type="number"  maxlength="6" name="pacas_rev" id="pacas_rev"   class="form-control"  readonly onkeypress=" return soloNumeros(event);">
        </div>
      </div>

            <div class="form-group "  id="graneldiv" style='display:none;'>
        <label class="col-sm-3 control-label">Kilogramos a Granel<strog class="theme_color">*</strog></label>
        <div class="col-sm-6">
          <input parsley-type="number" type="text" maxlength="6"   name="granel" id="granel"   class="form-control"   onkeypress=" return soloNumeros(event);">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Codificación de Lote: <strog class="theme_color">*</strog></label>
        <div class="col-sm-6">

          <input name="codificacion" id="codificacion" type="text"  maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes de la Compra" required/>
        </div>
      </div>


      <div class="form-group">
        <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
        <div class="col-sm-6">

          <input name="observacionesm" type="text"   maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes del Muestreo"/>
        </div>
      </div>




    </div><!--validator-->
  </div><!--user-profile-content-->
</div><!--step-2-->

<div id="step-3" class="">
  <div class="user-profile-content">
    <div id="form-step-2" role="form" data-toggle="validator">
      <h3 class="h3titulo">Datos de Pesaje</h3>


      <div class="form-group">
       <label class="col-sm-3 control-label">Bascula: <strog class="theme_color">*</strog></label>
       <div class="col-sm-6">
        <select name="bascula"  class="form-control select" required>
          @foreach($servicio as $bascula)
          <option value="{{$bascula->id}}">
           {{$bascula->nombreBascula}} 
         </option>
         @endforeach
       </select>
       <div class="help-block with-errors"></div>
     </div>
   </div><!--/form-group-->

   <div class="form-group">
    <label class="col-sm-3 control-label">Ticket: <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input name="numeroticket" type="text"  onchange="mayus(this);"  class="form-control" required value="" placeholder="Ingrese numero de Ticket" />
    </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-3 control-label">KG Enviados<strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input parsley-type="number" type="text" maxlength="5" required parsley-range="[0, 10000]" name="enviados" id="enviados"  class="form-control mask"  placeholder="Ingrese el numero de Kilogramos Enviados"  onKeyUp="calcula()" onkeypress="return soloNumeros(event);">
    </div>
  </div>

  <div class="form-group ">
    <label class="col-sm-3 control-label">KG Recibidos<strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input parsley-type="number" type="text" maxlength="5" required parsley-range="[0, 10000]" name="recibidos"  onKeyUp="calcula()"  id ="recibidos" class="form-control mask"  placeholder="Ingrese el numero de Kilogramos Recibidos" onkeypress=" return soloNumeros(event);">
    </div> 
  </div>

  <div class="form-group ">
    <label class="col-sm-3 control-label">Diferencia<strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input parsley-type="number" type="text" maxlength="5" parsley-range="[-1000, 10000]" name="diferencia" required  readonly  id="diferencia" class="form-control mask";>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
    <div class="col-sm-6">

      <input name="observacionesb" type="text"   maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes del Pesaje"/>
    </div>
  </div>   

  <div class="form-group">
    <label class="col-sm-3 control-label">Realizo Pesaje: <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <select name="pesaje"  class="form-control select" required>  
        @foreach($empleado as $em)
        <option value="{{$em->id}}">
         {{$em->nombre}} {{$em->apellidos}}
       </option>
       @endforeach              
     </select>
     <div class="help-block with-errors"></div>
   </div>
 </div><!--/form-group-->

</div><!--validator-->
</div><!--user-profile-content-->
</div><!--step-3-->


<div id="step-4" class="">
  <div class="user-profile-content">
    <div id="form-step-3" role="form" >
      <h3 class="h3titulo">Enviar Materia Prima a Área de Recepción</h3>
      <br>

      <div class="form-group">
       <label class="col-sm-3 control-label">Ubicación a Enviar: <strog class="theme_color">*</strog></label>
       <div class="col-sm-6">
        <select name="almacen" id="almacen"  class="form-control select" data-live-search="true" >
          @foreach($almacengeneral as $almacen)
          <option value="{{$almacen->id}}_{{$almacen->capacidad}}_{{$almacen->medida}}_{{$almacen->total_ocupado}}_{{$almacen->total_libre}}_{{$almacen->esp_ocupado}}_{{$almacen->esp_libre}}_{{$almacen->descripcion}}">
           {{$almacen->nombre}} 
         </option>
         @endforeach
       </select>
       <div class="help-block with-errors"></div>
     </div>
   </div><!--/form-group-->

   <div class="form-group">
    <label class="col-sm-3 control-label">Descripción : <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input name="descripcion" id="descripcion" type="text"  onchange="mayus(this);"  class="form-control"  value="" readonly />
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Capacidad de Almacenamiento: <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input name="capacidad" id="capacidad" type="text"   onchange="mayus(this);"  class="form-control"  value=""  readonly/>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Espacio Ocupado: <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input name="ocupado" id="ocupado" type="text"   onchange="mayus(this);"  class="form-control"  value="" readonly/>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Espacio Libre: <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input name="libre" id="libre" type="text"   onchange="mayus(this);"  class="form-control"  value="" readonly/>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label">Espacio Asignado: <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input name="asignado" id="asignado" type="text"   onchange="mayus(this);"  class="form-control" required  readonly/>
       <span id="error_asig" style="color:#FF0000;"></span>
    </div>
  </div>


  <div class="form-group">
    <label class="col-sm-3 control-label">Seleccione el Espacio a Donde se Enviará la Materia Prima: <strog class="theme_color"></strog></label>
    <div class="col-sm-6">
      <div class="form-group"> 
        <table id="myTable" name="myTable" value=""  class="table table-striped table-bordered table-condensed table-hover" >
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
    <label class="col-sm-3 control-label">Observaciónes : <strog class="theme_color"></strog></label>
    <div class="col-sm-6">
      <input name="observacionesu" id="observacionesu" type="text"  onchange="mayus(this);"  class="form-control"  value=""  />
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
    <div class="col-sm-6">
      <input  id="espacio" value="" name="espacio" type="hidden"  maxlength="50"  class="form-control" />
    </div>
  </div>




</div><!--validator-->
</div><!--user-profile-content-->
</div><!--step-2-->

<div id="step-5" class="">
  <div class="user-profile-content">
    <div id="form-step-4" role="form" >
      <h3 class="h3titulo">Programar Fumigación</h3>
      <br>


                           <div class="form-group">
                      <label class="col-sm-3 control-label">Programar Fumigacion Ahora: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-3">
                        <input type="radio" name="programar" id="programar" onchange="buscar5()" value="si"> Si<br>
                        <input type="radio" name="programar" id="programar" onchange="buscar6()" value="no"> No<br>
                           <span id="error_rec" style="color:#FF0000;"></span>
                      </div>
                    </div><!--/form-group-->


      <div class="form-group">
       <label class="col-sm-3 control-label">Hora de Inicio de La Fumigación: <strog class="theme_color">*</strog></label>
       <div class="col-sm-6">
        <input id="inicio" name="inicio" type="time" >
        <div class="help-block with-errors"></div>
      </div>
    </div><!--/form-group-->

    <div class="form-group">
      <label class="col-sm-3 control-label">Fecha de Inicio: <strog class="theme_color">*</strog></label>
      <div class="col-sm-6">

       <input type="date" name="fechai" id="fechai" value="" class="form-control mask" >
     </div>
   </div>

   <div class="form-group">
    <label class="col-sm-3 control-label">Fecha de Termino: <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">

     <input type="date" name="fechaf" id="fechaf" value="" class="form-control mask"  >
   </div>
 </div>

 <div class="form-group">
   <label class="col-sm-3 control-label">Hora de Termino de La Fumigación: <strog class="theme_color">*</strog></label>
   <div class="col-sm-6">
    <input id="final" name="final" type="time" >
    <div class="help-block with-errors"></div>
  </div>
</div><!--/form-group-->

<div class="form-group">
 <label class="col-sm-3 control-label">Fumigador: <strog class="theme_color">*</strog></label>
 <div class="col-sm-6">
  <select name="fumigador" id="fumigador"  class="form-control select" >
    @foreach($empleado as $empleados)
    <option value="{{$empleados->id}}}">
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
  <select name="entrego_qui" id="entrego_qui"  class="form-control select" >
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
    <label class="col-sm-3 control-label">Plaga que Combate : <strog class="theme_color">*</strog></label>
    <div class="col-sm-6">
      <input name="plaga" id="plaga" type="text"  onchange="mayus(this);"  class="form-control"  />
    </div>
  </div>

<div class="form-group">
  <label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
  <div class="col-sm-6">

    <input name="observacionesf" id="observacionesf"  type="text"  maxlength="200" onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese Observaciónes de la Fumigación"/>
  </div>
</div>



<div class="col-lg-4 col-lg-offset-4">
 <div class="form-group">
  <label class="col-sm-6 control-label">Buscar Codigo de Barras: <strog class="theme_color">*</strog></label>
  <div class="col-sm-6">
    <input  id="codigo" value="" name="codigo" type="text" onKeyUp="codigos()"  maxlength="13"  class="form-control"  placeholder="Ingrese el Codigo de Barras"/>
  </div>
</div>
</div>

<div class="form-group">
</div>

<div class="form-group"  >
 <label class="col-sm-3 control-label">Agroquímicos a Aplicar: <strog class="theme_color">*</strog></label>
 <div class="col-sm-6">
  <select name="quimicos" id="quimicos"  class="form-control select" >
    @foreach($almacenagroquimicos as $quimico)
    <option value="{{$quimico->id}}_{{$quimico->nombre}}_{{$quimico->codigo}}_{{$quimico->descripcion}}_{{$quimico->cantidad}}_{{$quimico->medida}}">
     {{$quimico->nombre}} 
   </option>
   @endforeach
 </select>
   <span id="erroragro" style="color:#FF0000;"></span>
 <div class="help-block with-errors"></div>
</div>
<button id="agregar_agro" class="btn btn-sm btn-danger"  style="margin-right: 10px;"  onclick="return agroquimico();" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Agregar Agroquimico"> <i class="fa fa-plus"></i>Agregar</button>
</div><!--/form-group-->





<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
 <div class="form-group"> 
  <label for="scantidad">Cantidad Aplicada <strog class="theme_color">*</strog></label>
  <input name="scantidad" id="scantidad" type="number" value="1" max="1000000" min="1"  data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" maxlength="5"  />
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
    <select name="status" id="status" value="{{Input::old('status')}}" >
      @if(Input::old('status')=="Proceso")
      <option value='En Proceso' selected>En Proceso
      </option>
      <option value="Pendiente">Pendiente</option>
      @else
      <option value='Pendiente' selected>Pendiente
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
  <div class="col-sm-offset-7 col-sm-5">
    <button type="submit" onclick="return save();" class="btn btn-primary">Guardar</button>
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
    //  <option value="{{$quimico->id}}}_{{$quimico->nombre}}_{{$quimico->codigo}}_{{$quimico->descripcion}}_{{$quimico->cantidad}}_{{$quimico->medida}}">


    var select2 = document.getElementById('almacen');
    var z = select2.value;
    if (z != ""){
      var selectedOption2 = select2.selectedIndex;
      var cantidadtotal = select2.value;
      limite = "8",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
      capacidad=arregloDeSubCadenas[1];
      medida = arregloDeSubCadenas[2];
      ocupado=arregloDeSubCadenas[5];
      libre=arregloDeSubCadenas[6];
      descripcion=arregloDeSubCadenas[7];
      document.getElementById("capacidad").value=capacidad ;
      document.getElementById("ocupado").value=ocupado;
      document.getElementById("libre").value =libre;
      document.getElementById("descripcion").value =descripcion;
    }
    var arreglolibre2 = [];
    var arregloocupado2 = [];
    var arreglolibre = [];
    var arregloocupado = [];
    var arregloespacio= [] ;
    arregloocupado2= document.getElementById("ocupado").value;
    arreglolibre2= document.getElementById("libre").value;
    var tamaño_libre;
    var libres = arreglolibre2.split(",");
    tamaño_libre = libres.length;
    var tamaño_ocupado;
    var ocupado = arregloocupado2.split(",");
    tamaño_ocupado = ocupado.length;

    if (arregloocupado2.length >0){
      for (var x = 0; x < tamaño_ocupado; x++){
        arregloocupado.push(ocupado[x]);
      }}
      if (arreglolibre2.length > 0){
        for (var i = 0; i < tamaño_libre; i++){
          arreglolibre.push(libres[i]);
        }
        var valor = 1;
        for (var cuenta = 1; cuenta <= capacidad ; cuenta++) {
         var table = document.getElementById("myTable");
         var med = medida;
         var row = table.insertRow(0);
         var cell1 = row.insertCell(0);
         var cell2 = row.insertCell(1);
         cell1.innerHTML = med+" N° "+valor;
         var agregaHTML = "<input type=button value=Libre class=agrega id="+(valor)+">";
         cell2.innerHTML = agregaHTML;
         document.getElementById(""+valor).style.color = "#00ff00";
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
              if (arr == arregloespacio[i]){
                arregloespacio.splice(i,1);
              }
            }
            eliminateDuplicates(arregloocupado);


            document.getElementById(""+aux).value = "Libre";
            document.getElementById(""+aux).style.color = "#00ff00";
            arreglolibre.push(arr);
            arregloocupado.sortNumbers();
            arreglolibre.sortNumbers();
              eliminateDuplicates2(arreglolibre);
           // document.getElementById('libre').value=arreglolibre;
          //  document.getElementById('ocupado').value=arregloocupado;
            document.getElementById('asignado').value=arregloespacio;
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
             eliminateDuplicates2(arreglolibre);

            document.getElementById(""+aux).value = "Ocupado";
            document.getElementById(""+aux).style.color = "#ff0000";
            arregloocupado.push(arr);
            arregloespacio.push(arr);
            arregloespacio.sortNumbers();
            arregloocupado.sortNumbers();
            arreglolibre.sortNumbers();
             eliminateDuplicates(arregloocupado);
           // document.getElementById('ocupado').value=arregloocupado;
           // document.getElementById('libre').value=arreglolibre;
            document.getElementById('asignado').value=arregloespacio;
            tamaño_libre = arreglolibre.length;
            document.getElementById('totallibre').value=tamaño_libre;
            tamaño_ocupado = arregloocupado.length;
            document.getElementById('totalocupado').value=tamaño_ocupado;
          }
        })
       }
     }
     sortTable();
   }

   var selecto = document.getElementById('almacen');
  selecto.addEventListener('change',
    function(){
      var selectedOption = this.options[selecto.selectedIndex];
      
   //   console.log(selectedOption.value + ': ' + selectedOption.text);
   var cantidadtotal = selectedOption.value;
   limite = "8",
   separador = "_",
   arregloDeSubCadenas = cantidadtotal.split(separador, limite);
   capacidad=arregloDeSubCadenas[1];
   medida = arregloDeSubCadenas[2];
   ocupado=arregloDeSubCadenas[5];
   libre=arregloDeSubCadenas[6];
   descripcion=arregloDeSubCadenas[7];
   document.getElementById("capacidad").value=capacidad;
   document.getElementById("ocupado").value=ocupado;
   document.getElementById("libre").value =libre;
   document.getElementById("descripcion").value =descripcion;
   document.getElementById("asignado").value ="";
   generar();
 });

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

  function eliminateDuplicates(arr) {
 var i,
     len=arr.length,
     out=[],
     obj={};

 for (i=0;i<len;i++) {
    obj[arr[i]]=0;
 }
 for (i in obj) {
    out.push(i);
 }
 document.getElementById('ocupado').value=out;
 return out;
}

  function eliminateDuplicates2(arr) {
 var i,
     len=arr.length,
     out=[],
     obj={};

 for (i=0;i<len;i++) {
    obj[arr[i]]=0;
 }
 for (i in obj) {
    out.push(i);
 }
 document.getElementById('libre').value=out;
 return out;
}


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
}return false;
}

var q = 1;
function transporte(){
 var valida = document.getElementById("transporte_num");
 if (valida.value < q) {
 // alert("Solo se han Seleccionado"+valida.value+" Transportes");
  swal("Error!","Solo se han Seleccionado"+valida.value+" Transportes", "error");
 // document.getElementById("errornumtrans").innerHTML = "Error!","Solo se han Seleccionado"+valida.value+" Transportes";

}else{
  document.getElementById("errornumtrans").innerHTML = "";

  var reg = document.getElementById("registrado").value;
  if (reg == "si"){
    if (document.getElementById('transportei').value !== ""  ){
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
    //swal("Error!","No ha Seleccionado Ningun Transporte", "error");
     document.getElementById("errortransp").innerHTML = "No ha Seleccionado Ningun Transporte";
    //alert("No ha Seleccionado Ningun Transporte");
  }
}else{
  if (document.getElementById('transporte').value !== ""  ){
    var id2= uno++;
    var tabla = document.getElementById("transportes");
    document.getElementById("errortransp").innerHTML = "";
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(id2);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminartrans(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = document.getElementById('transporte').value;
    cell3.innerHTML = document.getElementById('transporte').value;
    q=q+1;
  }else{
   // alert("No ha Seleccionado Ningun Transporte");
   // swal("Error!","No ha Seleccionado Ningun Transporte", "error");
    document.getElementById("errortransp").innerHTML = "No ha Seleccionado Ningun Transporte";
  }

}
}
}

function eliminartrans(value) {

  document.getElementById("transportes").deleteRow(value);
  q=q-1;
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
  if (document.getElementById('programar').value == "si"){
    if (document.getElementById('total').value > 0){
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

}}else{
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
}}



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

function buscar3(){
    document.getElementById('tipo_rec').value="granel";
  document.getElementById('pacasdiv').style.display = 'block';
  document.getElementById('pacas_revdiv').style.display = 'block';
  document.getElementById('graneldiv').style.display = 'none';
    document.getElementById('num_pacas').required = true;
  document.getElementById('granel').required = false;


}
function buscar4(){
  document.getElementById('tipo_rec').value="pacas";
  document.getElementById('graneldiv').style.display = 'block';
  document.getElementById('pacasdiv').style.display = 'none';
  document.getElementById('pacas_revdiv').style.display = 'none';
  document.getElementById('num_pacas').required = false;
  document.getElementById('granel').required = true;


}

function buscar5(){
    document.getElementById('programar').value="si";
    document.getElementById('inicio').required = true;
  document.getElementById('fechai').required = true;
      document.getElementById('fechaf').required = true;
  document.getElementById('final').required = true;
      document.getElementById('fumigador').required = true;
  document.getElementById('entrego_qui').required = true; 
  document.getElementById('quimicos').required = true;
  document.getElementById('scantidad').required = true;
    document.getElementById('status').required = true;
    document.getElementById('plaga').required = true;


        document.getElementById('inicio').readOnly = false;
  document.getElementById('fechai').readOnly = false;
      document.getElementById('fechaf').readOnly = false;
  document.getElementById('final').readOnly = false;
      document.getElementById('fumigador').readOnly = false;
  document.getElementById('entrego_qui').readOnly = false; 
  document.getElementById('quimicos').disabled = false;
  document.getElementById('scantidad').disabled = false;
    document.getElementById('status').readOnly = false;
    document.getElementById('agregar_agro').disabled = false;
      document.getElementById('observacionesf').readOnly = false; 
         document.getElementById('plaga').readOnly = false; 





}
function buscar6(){
  document.getElementById('programar').value="no";
    document.getElementById('inicio').required = false;
     document.getElementById('inicio').readonly = false;
  document.getElementById('fechai').required = false;
      document.getElementById('fechaf').required = false;
  document.getElementById('final').required = false;
      document.getElementById('fumigador').required = false;
  document.getElementById('entrego_qui').required = false; 
  document.getElementById('quimicos').required = false;
  document.getElementById('scantidad').required = false;
    document.getElementById('status').required = false;
     document.getElementById('plaga').required = false;

        document.getElementById('inicio').readOnly = true;
  document.getElementById('fechai').readOnly = true;
      document.getElementById('fechaf').readOnly = true;
  document.getElementById('final').readOnly = true;
      document.getElementById('fumigador').readOnly = true;
  document.getElementById('entrego_qui').readOnly = true; 
  document.getElementById('quimicos').disabled = true;
  document.getElementById('scantidad').disabled = true;
    document.getElementById('status').readOnly = true;
       document.getElementById('agregar_agro').disabled = true;
     document.getElementById('observacionesf').readOnly = true;
        document.getElementById('status').value = "Pendiente";
              document.getElementById('plaga').readOnly = true; 


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






function generar(){
 document.getElementById('espacio').value = "";
 var arregloespacio= [] ;
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

  }
  var select2 = document.getElementById('almacen');
  var z = select2.value;
  if (z != ""){
    var selectedOption2 = select2.selectedIndex;
    var cantidadtotal = select2.value;
    limite = "8",
    separador = "_",
    arregloDeSubCadenas = cantidadtotal.split(separador, limite);
    capacidad=arregloDeSubCadenas[1];
    medida = arregloDeSubCadenas[2];
    ocupado=arregloDeSubCadenas[5];
    libre=arregloDeSubCadenas[6];
    descripcion=arregloDeSubCadenas[7];

  }
  var arreglolibre2 = [];
  var arregloocupado2 = [];
  var arreglolibre = [];
  var arregloocupado = [];
  var arregloespacio= [] ;
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
  if (arregloocupado2.length >0){
    for (var x = 0; x < tamaño_ocupado; x++){
      arregloocupado.push(ocupado[x]);
    }}
    if (arreglolibre2.length > 0){
      for (var i = 0; i < tamaño_libre; i++){
        arreglolibre.push(libres[i]);
      }
      var valor = 0;
      for (var cuenta = 1; cuenta <= tamaño_libre ; cuenta++) {
       var table = document.getElementById("myTable");
       var med = medida;
       var row = table.insertRow(0);
       var cell1 = row.insertCell(0);
       var cell2 = row.insertCell(1);
       cell1.innerHTML = med+" N° "+libres[valor];
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
            if (arr == arregloespacio[i]){
              arregloespacio.splice(i,1);
            }
          }

          document.getElementById(""+aux).value = "Libre";
          document.getElementById(""+aux).style.color = "#00ff00";
          arreglolibre.push(arr);
          arregloocupado.sortNumbers();
          arreglolibre.sortNumbers();
          arregloespacio.sortNumbers();
          document.getElementById('libre').value=arreglolibre;
          document.getElementById('ocupado').value=arregloocupado;
          document.getElementById('asignado').value=arregloespacio;
          document.getElementById('espacio').value=arregloespacio;
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
          arregloespacio.push(arr);
          arregloespacio.sortNumbers();
          document.getElementById('ocupado').value=arregloocupado;
          document.getElementById('libre').value=arreglolibre;
          document.getElementById('asignado').value=arregloespacio;
          tamaño_libre = arreglolibre.length;
          document.getElementById('totallibre').value=tamaño_libre;
          tamaño_ocupado = arregloocupado.length;
          document.getElementById('totalocupado').value=tamaño_ocupado;
          document.getElementById('espacio').value=arregloespacio;
        }
      })
     }
   }
 }
 sortTable();
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
            if(x !== ""){
              document.getElementById("errortransp").innerHTML = "";
            }else{
              //alert('No se ha Ingresado Ningun Transporte en la Tabla de Transporte');
              document.getElementById("errortransp").innerHTML = "No se ha Ingresado Ningun Transporte en la Tabla de Transporte";
             // swal("Error!", "No se ha Ingresado Ningun Transporte en la Tabla de Transporte!", "error");
              //document.getElementById("transporte_num").style.border="1px solid #f00";
              return false;
            }
            /*
            if (document.getElementById('precio').value == ""){
              swal("Error!", "No se ha Ingresado el Precio Total de la Compra!", "error");
              //alert('No se ha Ingresado el Precio Total de la Compra');
              document.getElementById("precio").style.border="1px solid #f00";
              return false;
            }*/

            if (stepNumber == 3){
              if (document.getElementById('asignado').value == ""){
                document.getElementById("error_asig").innerHTML = "Ingrese el Espacio , donde se Enviara la Materia Prima";
               // swal("Error!", "Ingrese el Espacio , donde se Enviara la Materia Prima!", "error");
                //alert('Ingrese el Espacio , donde se Enviara la Materia Prima');
                //document.getElementById("asignado").style.border="1px solid #f00";
                return false;
              }else{
                 document.getElementById("error_asig").innerHTML = "";
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

function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 0; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}


    </script>



    @endsection