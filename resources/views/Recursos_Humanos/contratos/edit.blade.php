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
    <h1>Inicicio</h1>
    <h2 class="active">Contratos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080">Inicio</a></li>
      <li><a style="color: #808080">Contratos</a></li>
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
            <form action="{{url('contratos', [$contrato->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
              {{csrf_field()}}
              <input type="hidden" name="_method" value="PUT">


              <div id="smartwizard">
                <ul>
                  <li><a href="#step-1">Informacion Personal</a></li>
                  <li><a href="#step-2">Informacion Laboral</a></li>
                  <li><a href="#step-3">Datos de Contrato</a></li>
                  <li><a href="#step-4">Roles de trabajador</a></li>
                </ul>
                <div>
                  <div id="step-1" id="div">
                    <div class="user-profile-content">

                      <div id="form-step-0" role="form" data-toggle="validator">
                        <h3 class="h3titulo">Informacion Personal</h3>


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
                        <input  name="fecha_Nacimiento" type="hidden" id="fechaNacimiento"  value="{{$empleado->fecha_Nacimiento}}" />
                        <div class="form-group">
                          <label class="col-sm-3 control-label">CURP<strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">
                            <input name="curp"  maxlength="18" id="curp" type="text" required parsley-regexp="([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)"   required parsley-rangelength="[18,18]"  onkeypress="mayus(this);" onblur="curp2date();"  class="form-control"   placeholder="Ingrese CURP de el empleado"  value="{{$empleado->curp}}" />
                          </div>
                        </div><!--/form-group-->

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">
                            <input type="text" name="telefono" placeholder="Ingrese el número de teléfono de Empleado" name="telefono" required class="form-control mask" data-inputmask="'mask':'(999) 999-9999'" value="{{$empleado->telefono}}"  parsley-type="phone">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Domicilio: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">
                            <input type="text" onchange="mayus(this);quitarEspacios(this);" name="domicilio" placeholder="Ingrese el domicilio" name="domicilio" required class="form-control mask"  value="{{$empleado->domicilio}}" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">

                            <input name="email" value="{{$empleado->email}}" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de el cliente" />

                          </div>
                        </div>


                      </div><!--validator-->
                    </div><!--user-profile-content-->
                  </div><!--step-1-->

                  <div id="step-2" class="">
                    <div class="user-profile-content">
                      <div id="form-step-1" role="form" data-toggle="validator">
                        <h3 class="h3titulo">Informacion Laboral</h3>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Fecha Ingreso: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">

                            <input name="fecha_Ingreso" value="{{$empleado->fecha_Ingreso}}" required type="text" class="form-control mask" data-inputmask="'alias': 'date'" parsley-regexp="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Fecha Alta seguro: </label>
                          <div class="col-sm-6">

                            <input type="text" name="fecha_Alta_Seguro"   value="{{$empleado->fecha_Alta_Seguro}}"  class="form-control mask" data-inputmask="'alias': 'date'" parsley-regexp="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">SSN: </label>
                          <div class="col-sm-6 ">
                            <input type="text" name="numero_Seguro_Social" value="{{$empleado->numero_Seguro_Social}}"  type="numero_Seguro_Social" class="form-control mask" data-inputmask="'mask':'999-99-9999'">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Empresa contrata: <strog class="theme_color">*</strog></label>
                          <div class="col-sm-6">
                            <select name="idEmpresa" class="form-control" required>  
                              @foreach($empresas as $empresa)
                              <option value="{{$empresa->id}}">
                               {{$empresa->nombre}}
                             </option>
                             @endforeach              
                           </select>
                           <div class="help-block with-errors"></div>
                         </div>
                       </div><!--/form-group-->





                       <div class="form-row">    
                        <label class="col-sm-3 control-label">Sueldo empleado: <strog class="theme_color">*</strog></label>
                        <div class="col-sm-3">
                          <div class="input-group">
                           <div class="input-group-addon">$</div>


                           <input name="sueldo_Fijo" required parsley-range="[1,50000]" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" required value="{{$empleado->sueldo_Fijo}}" placeholder="189.00" onkeypress=" return soloNumeros(event);"/>
                         </div>
                       </div>
                     </div>


                   </div><!--validator-->
                 </div><!--user-profile-content-->
               </div><!--step-2-->

               <div id="step-3" class="">
                <div class="user-profile-content">
                  <div id="form-step-2" role="form" data-toggle="validator">
                    <h3 class="h3titulo">Datos de Contrato</h3>


                    <div class="form-group">
                      <label class="col-sm-3 control-label">Fecha Inicio: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-6">

                        <input name="fechaInicio" value="{{$contrato->fechaInicio}}"  id="fechaInicio"   type="text" required class="form-control mask" data-inputmask="'alias': 'date'" parsley-regexp="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Fecha Fin: <strog class="theme_color">*</strog></label>
                      <div class="col-sm-6">

                        <input name="fechaFin" id="fechaFin"  value="{{$contrato->fechaFin}}"  type="text" onblur="validarFecha2();validarFechas();" required class="form-control mask" data-inputmask="'alias': 'date'" parsley-regexp="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$">
                      </div>
                    </div>
                    <input type="hidden" name="duracionContrato" id="duracionContrato" value="{{$contrato->duracionContrato}}" />    

                  </div><!--validator-->
                </div><!--user-profile-content-->
              </div><!--step-3-->


              <div id="step-4" class="">
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
                      <button type="submit" class="btn btn-primary" onclick="validarRoles();">Guardar</button>
                      <a href="/contratos" class="btn btn-default"> Cancelar</a>
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





    @endsection