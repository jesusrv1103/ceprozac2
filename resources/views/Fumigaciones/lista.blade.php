@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Fumigaciónes</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/fumigaciones')}}">Inicio</a></li>
			<li class="active">Lista Detallada de la Fumigación</a></li>
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
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Información de la Fumigación N°: {{$fumigaciones->id}} {{$fumigaciones->destino}}</strong></h4>
						</div>
						<div class="btn-group pull-right">
							<b>

								<div class="btn-group" style="margin-right: 10px;">
									<a class="btn btn-sm btn-success tooltips" href="{{URL::action('fumigacionesController@create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Compra  "> <i class="fa fa-plus"></i> Registrar </a>

									<a class="btn btn-sm btn-danger tooltips" href="/fumigaciones" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

									<a class="btn btn-sm btn btn-info" href="{{URL::action('fumigacionesController@invoice',$fumigaciones->id)}}" target="_blank" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Entrada"> <i class="fa fa-print"></i>Imprimir Etiquetas</a>

								</div> 
							</b>
						</div>

					</div>
				</div>
				<div class="porlets-content container clear_both padding_fix">

					<div class="col-lg-6"> 
						<section class="panel default blue_title h4">
							<div class="panel-heading"><span class="semi-bold">Informacion De la Fumigación</span> 
							</div>
							<div class="panel-body">
								<table class="table table-striped">
									<tbody>
										<tr>
											<th>Número de Fumigación: </th>
											<td>{{$fumigaciones->id}}</td>
										</tr>
										<tr>
											<th>Fecha de Inicio:</th>
											<td>{{$fumigaciones->horai}}</td>
										</tr>
										<tr>
											<th>Hora de Inicio:</th>
											<td>{{$fumigaciones->fechai}}</td>
										</tr>
										<tr>
											<th>Fecha de Termino:</th>
											<td>{{$fumigaciones->fechaf}}</td>
										</tr>

										<tr>
											<th>Hora de Termino:</th>
											<td>{{$fumigaciones->horaf}}</td>
										</tr>
										<tr>
											<th>Agroqumicos Aplicados: </th>
											<td>{{$fumigaciones->agroquimicos}}</td>
										</tr>
										<tr>
											<th>Cantidad Aplicada: </th>
											<td>{{$fumigaciones->cantidad_aplicada}}</td>
										</tr>
										<tr>
											<th>Destino: </th>
											<td>{{$fumigaciones->destino}}</td>
										</tr>
										<tr>
											<th>Almacén: </th>
											<td>{{$ubicacion->nombre}}</td>
										</tr>
										<tr>
											<th>Producto: </th>
											<td>{{$produ->nombre}}</td>
										</tr>
										<th>Fumigador: </th>
										<td>{{$empleado->nombre}} {{$empleado->apellidos}}</td>
										<tr>
											<th>Estado: </th>
											<td>{{$fumigaciones->status}}</td>
											<tr>
												<th>Observaciónes: </th>
												<td>{{$fumigaciones->observaciones}}</td>

											</tr>
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
