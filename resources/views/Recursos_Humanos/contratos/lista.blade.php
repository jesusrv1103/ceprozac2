@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Informacion de Contrato</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/empleados')}}">Inicio</a></li>
      <li class="active">Informacion de Contrato</a></li>
    </ol>
  </div>
</div>
<div class="container clear_both padding_fix">
  <div class="row">
    <div class="col-md-12">
      <div class="block-web">
        <div class="header">
          <div class="row" style="margin-top: 15px; margin-bottom: 12px;">
            <div class="col-sm-7">
              <div class="actions"> </div>
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>INFORMACION DE: {{$empleado->nombre}} {{$empleado->apellidos}}</strong></h4>
            </div>
            <div class="btn-group pull-right">
              <b>

                <div class="btn-group" style="margin-right: 10px;">  


                  @if($contrato->estado_Contrato=='Vencido')

                  <a class="btn btn-primary btn-sm tooltips" data-target="#modal-renovar-{{$empleado->id}}-{{$empresa->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-edit"></i>Renovar Contrato</a>


                  <a class="btn btn-sm btn-warning tooltips" href="{{URL::action('ContratosController@liquidacion',$contrato->id)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar Formato de Liquidacion"> <i class="fa fa-download"></i> Liquidacion</a>
                  @endif

                  <a class="btn btn-sm btn-danger tooltips" href="/contratos" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

                </div> 
              </b>
            </div>

          </div>
        </div>
        <div class="porlets-content container clear_both padding_fix">

          <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Informacion Personal</span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Nombre Empleado: </th>
                      <td>{{$empleado->nombre}}</td>
                    </tr>
                    <tr>
                      <th>Apellidos:</th>
                      <td>{{$empleado->apellidos}}</td>
                    </tr>
                    <tr>
                      <th>Fecha Nacimiento: </th>
                      <td>{{$empleado->fecha_Nacimiento}}</td>
                    </tr>
                    <tr>
                      <th>CURP: </th>
                      <td>{{$empleado->curp}}</td>
                    </tr>
                    <tr>
                      <th>Sexo: </th>
                      <td>{{$empleado->sexo}}</td>
                    </tr>
                    <tr>
                      <th>Telefono: </th>
                      <td>{{$empleado->telefono}}</td>
                    </tr>
                    <tr>
                      <th>Correo: </th>
                      <td>{{$empleado->email}}</td>
                    </tr>

                    <tr>
                      <th>Domicilio: </th>
                      <td>{{$empleado->domicilio}}</td>
                    </tr>


                  </tbody>
                </table>
              </div>
            </section>
          </div>

          <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Informacion Laboral</span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Fecha Ingreso: </th>
                      <td>{{$empleado->fecha_Ingreso}}</td>
                    </tr>
                    <tr>
                      <th>Numero Seguro Social</th>
                      <td>{{$empleado->numero_Seguro_Social}}</td>
                    </tr>
                    <tr>
                      <th>Fecha Alta Seguro:</th>
                      <td>{{$empleado->fecha_Alta_Seguro}}</td>
                    </tr>
                    <tr>
                      <th>Sueldo Fijo: </th>
                      <td>{{$empleado->sueldo_Fijo}}</td>
                    </tr>
                    <tr>
                      <th> <div style="visibility: hidden"> Dato Nulo</div></th>
                      <td></td>
                    </tr>
                    <tr>
                      <th> <div style="visibility: hidden"> Dato Nulo</div></th>
                      <td></td>
                    </tr>
                    <tr>
                      <th> <div style="visibility: hidden"> Dato Nulo</div></th>
                      <td></td>
                    </tr>
                    <tr>
                      <th> <div style="visibility: hidden"> Dato Nulo</div></th>
                      <td></td>
                    </tr>
                    <tr>
                      <th> <div style="visibility: hidden"> Dato Nulo</div></th>
                      <td></td>
                    </tr>
                  </tr>
                  <tr>
                    <th> <div style="visibility: hidden"> Dato Nulo</div></th>
                    <td></td>
                  </tr>


                </tbody>
              </table>
            </div>
          </section>
        </div>

        <div class="col-lg-6"> 
          <section class="panel default blue_title h4">
            <div class="panel-heading"><span class="semi-bold">Informacion de Contrato </span> 
            </div>
            <div class="panel-body">
              <table class="table table-striped">
                <tbody>
                 <tr>
                   <th>Empresa que Contrata: </th>
                   <td>{{$empresa->nombre}}</td>
                 </tr>

                 <tr>
                  <th>Contratista: </th>
                  <td>{{$empresa->representanteLegal}}</td>
                </tr>
                <tr>
                  <th>Fecha Inicio: </th>
                  <td>{{$contrato->fechaInicio}}</td>
                </tr>
                <tr>
                  <th>Fecha Fin</th>
                  <td>{{$contrato->fechaFin}}</td>
                </tr>
                <tr>
                  <th>Horas Descanso:</th>
                  <td>{{$contrato->horas_Descanso}}</td>
                </tr>
                <tr>
                  <th>Duracion Contrato:</th>
                  <td>{{floor($contrato->duracionContrato/30)}} Meses {{$contrato->duracionContrato%30}} Dias</td>
                </tr>

                <tr>
                  <th>Estado de Contrato:</th>
                  <td>{{$contrato->estado_Contrato}}</td>
                </tr>

              </tbody>
            </table>
          </div>
        </section>
      </div>

      <div class="col-lg-6"> 
        <section class="panel default blue_title h4">
          <div class="panel-heading"><span class="semi-bold">Roles de Empleado</span> 
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <tbody>
                @foreach($roles as $rol)
                <tr>
                  <th>Rol: </th>
                  <td>{{$rol->rol_Empleado}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </section>
      </div>


      @include('Recursos_Humanos.contratos.renovarContrato')



    </div><!--/porlets-content-->
  </div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">


  function calcularTiempo(){
    var fecha1 =document.getElementById('fechaInicio').value;
    var fecha2= document.getElementById('fechaFin').value;
    var ano1 = fecha1.substring(0, 2);
    var mes1 = fecha1.substring(3, 5);
    var dia1 = fecha1.substring(6, 10);
    fech1 =ano1+"-"+mes1+"-"+dia1;
    var ano2 = fecha2.substring(0, 2);
    var mes2 = fecha2.substring(3, 5);
    var dia2 = fecha2.substring(6, 10);
    fech2 =ano2+"-"+mes2+"-"+dia2;
    fecha1m=moment(fech1);
    fecha2m=moment(fech2);
      var diff = fecha2m.diff(fecha1m, 'd'); // Diff in days
      document.getElementById("duracionContrato").value = diff;


    }
  </script>


  @endsection
