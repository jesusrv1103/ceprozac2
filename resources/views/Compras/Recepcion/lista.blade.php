@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Compras</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/compras/recepcion')}}">Inicio</a></li>
      <li class="active">Lista Detallada de la Compra</a></li>
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
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>INFORMACION DE COMPRA N°: {{$compra->id}} {{$compra->nombre}}</strong></h4>
            </div>
            <div class="btn-group pull-right">
              <b>

                <div class="btn-group" style="margin-right: 10px;">
                  <a class="btn btn-sm btn-success tooltips" href="{{URL::action('RecepcionCompraController@create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Compra  "> <i class="fa fa-plus"></i> Registrar </a>

                  <a class="btn btn-sm btn-danger tooltips" href="/compras/recepcion" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

                   <a class="btn btn-sm btn btn-info" href="{{URL::action('RecepcionCompraController@invoice',$compra->id)}}" target="_blank" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Entrada"> <i class="fa fa-print"></i>Imprimir Etiquetas</a>

                </div> 
              </b>
            </div>

          </div>
        </div>
        <div class="porlets-content container clear_both padding_fix">

          <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Informacion De Compra</span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Número de Compra: </th>
                      <td>{{$compra->id}}</td>
                    </tr>
                     <tr>
                      <th>Nombre de Lote:</th>
                      <td>{{$compra->nombre}}</td>
                    </tr>
                    <tr>
                      <th>Fecha de Compra:</th>
                      <td>{{$compra->fecha_compra}}</td>
                    </tr>
                                         <tr>
                      <th>Empresa:</th>
                      <td>{{$emp_recibe->nombre}}</td>
                    </tr>

                        <tr>
                      <th>Provedor:</th>
                      <td>{{$provedor->nombre}}</td>
                    </tr>
                    <tr>
                      <th>Empleado que Recibio la Compra: </th>
                      <td>{{$entrega->nombre}}</td>
                    </tr>
                    <tr>
                      <th>N° de Transportes en que Llego la Compra: </th>
                      <td>{{$compra->num_transportes}} Unidad(es)</td>
                    </tr>
                    <tr>
                      <th>Nombre y Placas de Transportes: </th>
                      <td>{{$compra->transporte}}</td>
                    </tr>
                    <tr>
                      <th>N° De Ticket de Bascula: </th>
                      <td>{{$compra->ticket}}</td>
                    </tr>
                    <tr>
                      <th>Precio Total de Compra$: </th>
                      <td>${{$compra->total_compra}}.00 /MN</td>
                    </tr>
                    <th>Observaciónes de la Compra: </th>
                      <td>{{$compra->observacionesc}}</td>
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
                  </tbody>
                </table>
              </div>
            </section>
          </div>

          <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Informacion Del Muestreo de Materia Prima</span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th>Nombre de la Materia Prima: </th>
                      <td>{{$produ->nombre}}</td>
                    </tr>
                    <tr>
                      <th>Calidad:</th>
                      <td>{{$cali->nombre}}</td>
                    </tr>
                    <tr>
                      <th>Empaque:</th>
                      <td>{{$empaque->formaEmpaque}}</td>
                    </tr>
                    <tr>
                      <th>Humedad: </th>
                      <td>{{$compra->humedad}}% de Humedad</td>
                    </tr>
                      <tr>
                      <th>N° de Pacas: </th>
                      <td>{{$compra->pacas}} Unidad(es)</td>
                    </tr>
                       <tr>
                      <th>N° de Pacas a Revisar: </th>
                      <td>{{$compra->pacas_rev}} Unidad(es)</td>
                    </tr>
                    <tr>
                      <th>Observaciónes del Muestreo: </th>
                      <td>{{$compra->observacionesm}}</td>
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

                  </tbody>
                </table>
              </div>
            </section>
          </div>

          <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Información del Pesaje </span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                   <tr>
                     <th>Nombre de la Bascula Utilizada: </th>
                     <td>{{$bascula->nombreBascula}}</td>
                   </tr>
                     <tr>
                      <th>N° De Ticket: </th>
                      <td>{{$compra->ticket}}</td>
                    </tr>
                      <tr>
                      <th>Empleado que Realizo Pesaje: </th>
                      <td>{{$pesaje->nombre}}</td>
                    </tr>
                    <tr>
                      <th>KG Recibidos: </th>
                      <td>{{$compra->kg_recibidos}} KG.</td>
                    </tr>
                    <tr>
                      <th>KG Enviados </th>
                      <td>{{$compra->kg_enviados}} KG</td>
                    </tr>
                     <tr>
                      <th>Diferencia </th>
                      <td>{{$compra->diferencia}} KG</td>
                    </tr>

                   <tr>
                    <th>Observaciónes de Pesaje: </th>
                    <td>{{$compra->observacionesb}}</td>
                  </tr>

                                        <tr>
                      <th> <div style="visibility: hidden"> Dato Nulo</div></th>
                      <td></td>
                    </tr>
                    

                  <tr>

                </tbody>
              </table>
            </div>
          </section>
        </div>

          

                       <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Información de Fumigación Aplicada</span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                                     <tr>
                     <th>Fumigaciòn Nº: </th>
                     <td>{{$fumigacion->id}}</td>
                   </tr>
                   <tr>
                     <th>Agroquimicos Aplicados: </th>
                     <td>{{$fumigacion->agroquimicos}}</td>
                   </tr>
                     <tr>
                      <th>Cantidad: </th>
                      <td>{{$fumigacion->cantidad_aplicada}}</td>
                    </tr>
                      <tr>
                      <th>Empleado que Realizo Fumigaciòn: </th>
                      <td>{{$fumigador->nombre}}</td>
                    </tr>
                    <tr>
                      <th>Fecha y Hora Inicial: </th>
                      <td>{{$fumigacion->fechai}} {{$fumigacion->horai}} </td>
                    </tr>
                     <tr>
                      <th>Fecha y Hora Final: </th>
                      <td>{{$fumigacion->fechaf}} {{$fumigacion->horaf}} </td>
                    </tr>
                    <tr>
                      <th>Estado de la Fumigaciòn </th>
                      <td>{{$fumigacion->status}}</td>
                    </tr>
                     <tr>
                      <th>Observaciònes </th>
                      <td>{{$fumigacion->observaciones}}</td>
                    </tr>

                  <tr>

                </tbody>
              </table>
            </div>
          </section>
        </div>

         <div class="col-lg-6"> 
            <section class="panel default blue_title h4">
              <div class="panel-heading"><span class="semi-bold">Ubicación Actual</span> 
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <tbody>
                                     <tr>
                     <th>Ubicaciòn Actual </th>
                     <td>{{$ubicacion->nombre}}</td>
                   </tr>
                   <tr>
                     <th>Espacio Asignado: </th>
                     <td>{{$compra->espacio_asignado}}</td>
                   </tr>


                  <tr>

                </tbody>
              </table>
            </div>
          </section>
        </div>



      </div><!--/porlets-content-->
    </div><!--/block-web-->
  </div><!--/col-md-12-->
</div><!--/row-->
</div>


@endsection
