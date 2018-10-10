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
    <h1>Inicio </h1>
    <h2 class="active">Empleados</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li style="color: #808080"> <a>Inicio</a></li>
      <li style="color: #808080"><a>Empleados</a></li>

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
            <form action="{{url('empleados', [$empleado->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
              {{csrf_field()}}
              <input type="hidden" name="_method" value="PUT">
              <div id="smartwizard">
                <ul>
                  <li><a href="#step-1">Informacion Personal</a></li>
                  <li><a href="#step-2">Roles de  empleados</a></li>
                </ul>
                <div>
                  <div id="step-1" id="div">
                    <div class="user-profile-content">

                      <div id="form-step-0" role="form" data-toggle="validator">
                        <h3 class="h3titulo">Informacion Personal</h3>
                        <input  name="fecha_Nacimiento" value="{{$empleado->fecha_Nacimiento}}" type="hidden" id="fechaNacimiento"  />
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">

                            <input name="nombre" type="text"  maxlength="35" onchange="mayus(this);quitarEspacios(this);"  class="form-control" onkeypress=" return soloLetras(event);" required value="{{$empleado->nombre}}" placeholder="Ingrese nombre de el Empleado"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Apellidos: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">

                            <input name="apellidos" type="text"  maxlength="60" onchange="mayus(this);quitarEspacios(this);"  class="form-control" onkeypress=" return soloLetras(event);" required value="{{$empleado->apellidos}}" placeholder="Ingrese nombre de el Cliente"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Fecha Ingreso: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">

                           <input name="fecha_Ingreso" required type="text" value="{{$empleado->fecha_Ingreso}}" class="form-control mask" data-inputmask="'alias': 'date'" parsley-regexp="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$">
                         </div>
                       </div>

                       <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha Alta seguro: <strog class="theme_color">*</strog></label>
                        <div class="col-sm-6">

                         <input type="text" name="fecha_Alta_Seguro"  required class="form-control mask" data-inputmask="'alias': 'date'" value="{{$empleado->fecha_Alta_Seguro}}" parsley-regexp="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$">
                       </div>
                     </div>


                     <input type="text" name="ssnOculto" id="SSNOculto" value="{{$empleado->numero_Seguro_Social}}" hidden>
                     <div class="form-group">
                      <label class="col-sm-3 control-label">SSN</label>
                      <div class="col-sm-6 ">
                        <input type="text" name="numero_Seguro_Social" id="numero_Seguro_Social" onblur="validarSSN();" type="numero_Seguro_Social" class="form-control mask" data-inputmask="'mask':'999-99-9999'" required value="{{$empleado->numero_Seguro_Social}}"/>
                        <span id="errorSSN" style="color:#FF0000;"></span>
                      </div>
                    </div>


                    <input type="text" name="curpOculta" id="curpOculta" value="{{$empleado->curp}}" hidden>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">CURP<strog class="theme_color">*</strog></label>
                      <div class="col-sm-6">
                        <input name="curp"  maxlength="18" id="curp" type="text" required parsley-regexp="([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)"   required parsley-rangelength="[18,18]"  onkeypress="mayus(this);" onblur="curp2date();validarCURP();"  class="form-control"   placeholder="Ingrese CURP de el empleado" value="{{$empleado->curp}}"   />
                        <span id="errorCURP" style="color:#FF0000;"></span>
                      </div>
                    </div><!--/form-group-->

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Domicilio: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-6">
                        <input type="text" onchange="mayus(this);quitarEspacios(this);" name="domicilio" placeholder="Ingrese el domicilio" name="domicilio" required class="form-control mask" value="{{$empleado->domicilio}}" />

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-6">
                        <input type="text" name="telefono" placeholder="Ingrese el número de teléfono de Empleado" name="telefono" class="form-control mask" required data-inputmask="'mask':'(999) 999-9999'" value="{{$empleado->telefono}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-6">

                        <input name="email" value="{{$empleado->email}}" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de el cliente"/>

                      </div>
                    </div>


                    <div class="form-group">
                      <label class="col-sm-3 control-label">Sueldo empleados:</label>
                      <div class="col-sm-6">
                        <div class="input-group"> <span class="input-group-addon">$</span>
                          <input name="sueldo_Fijo" type="text" required class="form-control" placeholder="Ingrese el Sueldo empleado" onkeypress=" return soloNumeros(event);" value="{{$empleado->sueldo_Fijo}}">
                          <span class="input-group-addon">.00</span> </div>
                        </div>
                      </div><!--form-group end--> 



                    </div><!--validator-->
                  </div><!--user-profile-content-->
                </div><!--step-1-->

                <div id="step-2" class="">
                  <div class="user-profile-content">
                    <div id="form-step-3" role="form" >
                      <h3 class="h3titulo">Roles de empleados</h3>
                      <br>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th> 
                                Rol
                              </th> 
                              <th>Agregar Rol</th>
                              <th>Quitar Rol</th>
                            </tr>
                          </thead>
                          <tbody id="myTable">
                            <tr>
                              <td>
                                <div class="col-sm-8">
                                  <select   id="rol" class="form-control" required>  
                                    @foreach($roles as $rol)
                                    <option label="{{$rol->rol_Empleado}}" value="{{$rol->id}}">
                                     {{$rol->rol_Empleado}} 
                                   </option>
                                   @endforeach              
                                 </select>
                               </div>   
                             </td>
                              <span id="errorRoles" style="color:#FF0000;"></span>

                             <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                             <input type="hidden" value="{{ $empleado->id}}" id="idEmpleado">

                             <td colspan="2"><button type="button"  onclick="myCreateFunction1();" class="btn btn-success btn-icon"> Agregar <i class="fa fa-plus"></i> </button></td>
                           </tr>

                         </tbody>
                       </table>
                     </div>
                     <div class="form-group">
                      <div class="col-sm-offset-7 col-sm-5">
                      <button type="submit" id="submit" onclick="validarRoles();" class="btn btn-primary">Guardar</button>
                        <a href="/empleados" class="btn btn-default"> Cancelar</a>
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


@include('Recursos_Humanos.empleados.modalReactivar')

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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

    <script type="text/javascript">
      function eliminarArticulo(id) {
       $.ajax({
        url: 'url' + id,
        type: 'DELETE',
        success: function(result) {
        // bla bla
      }
    });
     }


   </script>

   @endsection
