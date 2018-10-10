@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Almacenes Generales </h1>
		<h2 class="">Almacén General </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/almacen/general')}}">Inicio</a></li>
			<li class="active">Almacén General: {{ $almacen2->nombre}} </a></li>
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
							<h2 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Producto Actual: {{ $almacen2->nombre}} </strong></h2>
						</div>
						<div class="col-md-12">
							<div class="btn-group pull-right">
								<b>
									 <div class="btn-group" style="margin-right: 10px;">
									              <a class="btn btn-sm btn-danger"  href="{{ route('almacen.salidas.agroquimicos.index')}}"  style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Salida"> <i class="fa fa-plus"></i>Salidas de Almacén </a>

                    <a class="btn btn-sm btn btn-info" href="{{URL::action('entradas_almacengeneralController@verEntradas',$almacen2->id)}}""  style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Entrada"> <i class="fa fa-plus"></i>Entradas de Almacén </a>
</div>


								</b>
							</div>
						</div>
					</div>
				</div>

				<div class="porlets-content">
					<div class="table-responsive">
						 <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered " id="hidden-table-info9">
							<thead>
								<tr>                 
									<th style="display:none;" >N° Espacio Asignado</th>
									<th>Lote Actual</th>
									<th>Producto </th>
									<th>Calidad </th>
									<th>Humedad </th>
									<th>Empaque </th>
									<th>Cantidad Actual</th>
									<th>Provedor </th>
									<th>Observaciónes </th>
									 <th style="display:none;" >Fecha de Entrada </th>
									 <th style="display:none;" >Ultima Fumigación </td>
									 <th style="display:none;" >Número de Fumigaciónes </td>
									<td><center><b>Borrar</b></center></td>
									<td><center><b>Mover Producto</b></center></td>                            
								</tr>
							</thead>
							<tbody>
								@foreach($almacen  as $almacenes)
								<tr class="gradeX">
 
									<th style="display:none;" >{{$almacenes->num_espacio}} </td>
									<td>{{$almacenes->nombre_lote}} </td>      
									<td>{{$almacenes->nomprod}} </td>   
									<td>{{$almacenes->calidadnombre}} </td>
									<td>{{$almacenes->humedad}} %</td>
									<td>{{$almacenes->empnombre}} </td>
									<td>{{$almacenes->cantidad_act}} {{$almacenes->medida}}</td>
									
									<td>{{$almacenes->nombreprov}} {{$almacenes->apellidos}} </td>
									<td>{{$almacenes->observaciones}} </td>
									 <th style="display:none;" >{{$almacenes->fecha_entrada}} </td>
									 <th style="display:none;" >{{$almacenes->ultima_fumigacion}} </td>
									 <th style="display:none;" >{{$almacenes->num_fumigaciones}} </td>

									<td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$almacenes->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
									</td>
									   <td>  <a href="{{URL::action('AlmacenGeneralController@movimientos',$almacenes->loteid)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a> 
                  </td>

								</td>
							</td>

						</tr>
						@include('almacen.general.modal')
						@endforeach
					</tbody>
					<tfoot>
						<tr>                              
                                     <th> </th>
									<th style="display:none;" >N° Espacio Asignado</th>
									<th>Lote Actual</th>
									<th>Producto </th>
									<th>Calidad </th>
									<th>Humedad </th>
									<th>Empaque </th>
									<th>Cantidad Actual</th>
									<th>Provedor </th>
									<th>Observaciónes </th>
									 <th style="display:none;" >Fecha de Entrada </th>
									 <th style="display:none;" >Ultima Fumigación </td>
									 <th style="display:none;" >Número de Fumigaciónes </td>
									<td><center><b>Borrar</b></center></td>    
									<td><center><b>Mover Producto</b></center></td>   

						</tr>
					</tfoot>
				</table>
			</div><!--/table-responsive-->
		</div><!--/porlets-content-->
	</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>


@endsection
