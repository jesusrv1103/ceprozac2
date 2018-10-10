@extends('layouts.principal')
@section('contenido')
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<style>
	table, th, td {
		border: 1px solid black;
	}
</style>
</head>
<body>
	<div class="pull-left breadcrumb_admin clear_both">
		<div class="pull-left page_title theme_color">
			<h1>Fumigaciones</h1>
			<h2 class="">Fumigaciones Realizadas</h2>

		</div>
		<div class="pull-right">
			<ol class="breadcrumb">
				<li ><a style="color: #808080" href="{{url('/almacenes/agroquimicos')}}">Inicio</a></li>
				<li class="active">Fumigaciones Realizadas</a></li>

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
								<div class="actions"> </div>

								<h2 class="content-header " id="demo" style="margin-top: -5px;">&nbsp;&nbsp;</h2>
								
							</div>

							<div class="col-md-12">

								<div class="btn-group pull-right">
									<b>


										<div class="btn-group" style="margin-right: 10px;">
											<a class="btn btn-sm btn-success tooltips" href="{{ route('fumigaciones.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Material"> <i class="fa fa-plus"></i> Registrar Fumigacion </a>

											<a class="btn btn-sm btn-warning tooltips" href="{{ route('almacen.agroquimicos.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>









										</div>
									</b>
								</div>

							</div>
						</div>
					</div>
					<div class="porlets-content">

						<div class="table-responsive">
							<table  cellpadding="0" cellspacing="0" border="0"  class="display table table-bordered" id="hidden-table-info8"" >
								<thead>
									<tr>
										<th style="display:none;" >N° Fumigación</th>
										<th>Fecha de Inicio </th>
										<th>Hora Inicial </th>
										<th>Fecha de Termino </th>
										<th>Hora de Termino </th>
										<th>Agroquimicos Aplicados </th>
										<td><center><b>Cantidad Aplicada</b></center></td>
										<th>Destino</th>
										<th style="display:none;" >Almacén</th>
										<th style="display:none;" >Producto</th>
										<th style="display:none;" >Fumigador</th> 
										<td><center><b>Estado</b></center></td>
										<th style="display:none;">Plaga que Combate</th> 
										<td><center><b>Observaciones</b></center></td>


										<td><center><b>Editar</b></center></td>
										<td><center><b>Borrar</b></center></td>
										<th>Ver &nbsp; &nbsp;</th>
										<th>Imprimir Etiquetas &nbsp; &nbsp;</th>       
										<td><center><b>Registrar Fumigación</b></center></td>                      
									</tr>
								</thead>
								<tbody>
									@foreach($fumigaciones  as $fumiga)

									@if ($fumiga->status == "Realizada")


									<tr class="gradeX">
										<th style="display:none;" >{{$fumiga->id}} </td>
											<td style="background-color: #C2FFC4;">{{$fumiga->fechai}} </td>
											<td style="background-color: #C2FFC4;">{{$fumiga->horai}} </td>
											<td style="background-color: #C2FFC4;">{{$fumiga->fechaf}} </td>
											<td style="background-color: #C2FFC4;">{{$fumiga->horaf}} </td>

											<td style="background-color: #C2FFC4;">{{$fumiga->agroquimicos}} </td>
											<td style="background-color: #C2FFC4;">{{$fumiga->cantidad_aplicada}} </td>
											<td style="background-color: #C2FFC4;">{{$fumiga->destino}} </td>
											<th style="display:none;" >{{$fumiga->almnom}} </td>
											<th style="display:none;" >{{$fumiga->produnom}} </td>
											<th style="display:none;" >{{$fumiga->nomfum}} {{$fumiga->apellidos}} </td>
											<td style="background-color: #C2FFC4;">{{$fumiga->status}} </td>
											<th style="display:none;" >{{$fumiga->plaga_combate}} </td>
											<td style="background-color: #C2FFC4;">{{$fumiga->observaciones}} </td>

											<td style="background-color: #C2FFC4;">  <a href="{{URL::action('fumigacionesController@edit',$fumiga->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a> 
											</td>
											<td style="background-color: #C2FFC4;"> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$fumiga->id}}" data-original-title="Agregar Stock" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
											</td>
											<td style="background-color: #C2FFC4;">
											<a href="{{URL::action('fumigacionesController@verInformacion',$fumiga->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>
                                                
															<td style="background-color: #C2FFC4;">Fumigacion Terminada </td>
															<td style="background-color: #C2FFC4;">Fumigacion Terminada </td>
														</td>
													</td>

												</tr>
												@elseif ($fumiga->status == "En Proceso")
												<?php
												$hoy = date('Y-m-d');
												$hora = date('H:i');
												?>
												@if ($fumiga->fechaf <= $hoy)

												<tr class="gradeX">
													<th style="display:none;" >{{$fumiga->id}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->fechai}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->horai}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->fechaf}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->horaf}} </td>

														<td style="background-color: #FFE4E1;">{{$fumiga->agroquimicos}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->cantidad_aplicada}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->destino}} </td>
														<th style="display:none;" >{{$fumiga->almnom}} </td>
															<th style="display:none;" >{{$fumiga->produnom}} </td>
																<th style="display:none;" >{{$fumiga->nomfum}} {{$fumiga->apellidos}} </td>

																	<td style="background-color: #FFE4E1;">{{$fumiga->status}} </td>
																	<th style="display:none;" >{{$fumiga->plaga_combate}} </td>
																	<?php
																	$fecha1= new DateTime($fumiga->fechaf);
																	$fecha2= new DateTime($hoy);

																	$dif=$fecha1->diff($fecha2);
																	$dias=$dif->format('%R%a días');

																	$fecha3= new DateTime($fumiga->horaf);
																	$fecha4= new DateTime($hora);
																	$dife=$fecha3->diff($fecha4);
																	$horas=$dife->format('%H Horas');
																	$minutos=$dife->format('%I Minutos');

																	?>

																	<td style="background-color: #FFE4E1;">La Fumigacion Vencio hace {{$dias}}, {{$horas}} y {{$minutos}}</td>

																	<td style="background-color: #FFE4E1;">  <a href="{{URL::action('fumigacionesController@edit',$fumiga->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a> 
																	</td>
																	<td style="background-color: #FFE4E1;"> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$fumiga->id}}" data-original-title="Agregar Stock" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
																	</td>
																	<td style="background-color: #FFE4E1;">
																		<a href="{{URL::action('fumigacionesController@verInformacion',$fumiga->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>

																		<td style="background-color: #FFE4E1;"><a href="{{URL::action('fumigacionesController@invoice',$fumiga->id)}}" target="_blank" class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i></a>     </td>
																		<td style="background-color: #FFE4E1;">Fumigacion Vencida </td>
																	</td>
																</td>

															</tr>

															@else
															<?php
															$fecha1= new DateTime($fumiga->fechaf);
															$fecha2= new DateTime($hoy);

															$dif=$fecha1->diff($fecha2);
															$dias=$dif->format('%R%a días');

															$fecha3= new DateTime($fumiga->horaf);
															$fecha4= new DateTime($hora);
															$dife=$fecha3->diff($fecha4);
															$horas=$dife->format('%H Horas');
															$minutos=$dife->format('%I Minutos');

															?>
															<tr class="gradeA">
																<th style="display:none;" >{{$fumiga->id}} </td>
																	<td style="background-color: #FDFFC2;">{{$fumiga->fechai}} </td>
																	<td style="background-color: #FDFFC2;">{{$fumiga->horai}} </td>
																	<td style="background-color: #FDFFC2;">{{$fumiga->fechaf}} </td>
																	<td style="background-color: #FDFFC2;">{{$fumiga->horaf}} </td>

																	<td style="background-color: #FDFFC2;">{{$fumiga->agroquimicos}} </td>
																	<td style="background-color: #FDFFC2;">{{$fumiga->cantidad_aplicada}} </td>
																	<td style="background-color: #FDFFC2;">{{$fumiga->destino}} </td>
																	<th style="display:none;" >{{$fumiga->almnom}} </td>
																		<th style="display:none;" >{{$fumiga->produnom}} </td>
																			<th style="display:none;" >{{$fumiga->nomfum}} {{$fumiga->apellidos}} </td>
																				<td style="background-color: #FDFFC2;">{{$fumiga->status}} </td>
																				<th style="display:none;" >{{$fumiga->plaga_combate}} </td>
																				<td style="background-color: #FDFFC2;">La Fumigacion Termina en {{$dias}}, {{$horas}} y {{$minutos}}  </td>

																				<td style="background-color: #FDFFC2;">  <a href="{{URL::action('fumigacionesController@edit',$fumiga->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a> 
																				</td>
																				<td style="background-color: #FDFFC2;"> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$fumiga->id}}" data-original-title="Agregar Stock" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
																				</td>
																				<td style="background-color: #FDFFC2;">
																					<a href="{{URL::action('fumigacionesController@verInformacion',$fumiga->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>

																					<td style="background-color: #FDFFC2;"><a href="{{URL::action('fumigacionesController@invoice',$fumiga->id)}}" target="_blank" class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i></a>     </td>
																					<td style="background-color: #FDFFC2;">Fumigacion en Proceso     </td>

																				</td>
																			</td>

																		</tr>


																		@endif
																		@else
																		<tr class="gradeX">
													<th style="display:none;" >{{$fumiga->id}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->fechai}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->horai}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->fechaf}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->horaf}} </td>

														<td style="background-color: #FFE4E1;">{{$fumiga->agroquimicos}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->cantidad_aplicada}} </td>
														<td style="background-color: #FFE4E1;">{{$fumiga->destino}} </td>
														<th style="display:none;" >{{$fumiga->almnom}} </td>
															<th style="display:none;" >{{$fumiga->produnom}} </td>
																<th style="display:none;" >{{$fumiga->nomfum}} {{$fumiga->apellidos}} </td>
																	<td style="background-color: #FFE4E1;">{{$fumiga->status}} </td>
																	<th style="display:none;" >{{$fumiga->plaga_combate}} </td>

																	<td style="background-color: #FFE4E1;">Fumigacion Pendiente  , Favor de Realizarla Lo antes posible</td>

																	<td style="background-color: #FFE4E1;">Fumigacion Pendiente   </td>
								<td style="background-color: #FFE4E1;"> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$fumiga->id}}" data-original-title="Agregar Stock" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
											</td>
																	<td style="background-color: #FFE4E1;">
																		<a href="{{URL::action('fumigacionesController@verInformacion',$fumiga->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>

																		<td style="background-color: #FFE4E1;">Fumigacion Pendiente   </td>
																		<td style="background-color: #FFE4E1;">
																		<a href="{{URL::action('fumigacionesController@registrar',$fumiga->id)}}" class="btn btn-sm btn-success tooltips" role="button"><i class="fa fa-plus"></i></a>    </td>
																	</td>
																</td>

															</tr>

																		@endif
																		@include('fumigaciones.modal')			
																		@endforeach
																	</tbody>
																	<tfoot>
																		<tr>
																			<th></th> 
																			<th style="display:none;" >N° de Fumigación </th>
																			<th>Fecha de Inicio </th>
																			<th>Hora Inicial </th>
																			<th>Fecha de Termino </th>
																			<th>Hora de Termino </th>
																			<th>Agroquimicos Aplicados </th>
																			<td><center><b>Cantidad Aplicada</b></center></td>
																			<th>Destino</th>
																			<th style="display:none;" >Almacén</th>
																			<th style="display:none;" >Producto</th>
																			<th style="display:none;" >Fumigador</th> 
																			<td><center><b>Estado</b></center></td>
																			<th style="display:none;" >Plaga que Combate</th> 
																			<td><center><b>Observaciones</b></center></td>


																			<td><center><b>Editar</b></center></td>
																			<td><center><b>Borrar</b></center></td>  
																			<th>Ver &nbsp; &nbsp;</th>
																			<th>Imprimir Etiquetas &nbsp; &nbsp;</th> 
																			<td><center><b>Registrar Fumigación</b></center></td>  
																		</tr>
																	</tfoot>
																</table>
															</div><!--/table-responsive-->
														</div><!--/porlets-content-->
													</div><!--/block-web-->
												</div><!--/col-md-12-->
											</div><!--/row-->
										</div>
										

										<script>
											var myVar = setInterval(myTimer, 1000);

											function myTimer() {
												var d = new Date();
												var t = d.toLocaleTimeString();
												var f = new Date();
												var g= f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
												document.getElementById("demo").innerHTML =  "Hora Actual: " +t+"              Fecha: "+g;
											}
										</script>
										@endsection
