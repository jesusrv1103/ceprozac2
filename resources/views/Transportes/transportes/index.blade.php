@inject('metodo','CEPROZAC\Http\Controllers\TransporteController')
@extends('Transportes.transportes.layoutTransportes')
@section('tablaContenido')
<table  cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info3">
  <thead>
    <tr>
      <th >Nombre Unidad </th>
      <th>Numero Serie </th>
      <th>Placas </th>
      <th>Poliza Seguro </th>
      <th style="display: none;">Vigencia Seguro </th>
      <th style="display: none;">Aseguradora </th>
      <th style="display: none;">Metros cubicos Unidad </th>
      <th style="display: none;">Capacidad </th>
      <th style="display: none;">Chofer </th>
      <th><center><b>Estado</b></center></th>
      <th>Mantenimientos</th>

      <th><center><b>Editar</b></center></th>
      <th><center><b>Borrar</b></center></th>
    </tr>
  </thead>
  <tbody>
    @foreach($vehiculos  as $vehiculo)
    <!--{{$metodo->calcularFecha($vehiculo->vigencia_Seguro) }}-->
    @if( $metodo->calcularFecha($vehiculo->vigencia_Seguro) <= 0 )

    <tr class="gradeA">
      <td style="background-color: #FFE4E1;">{{$vehiculo->nombre_Unidad}} </td>
      <td style="background-color: #FFE4E1;">{{$vehiculo->no_Serie}} </td>
      <td style="background-color: #FFE4E1;">{{$vehiculo->placas}} </td>
      <td style="background-color: #FFE4E1;" >{{$vehiculo->poliza_Seguro}}</td>
      <td style="display: none;">{{$vehiculo->vigencia_Seguro}}</td>
      <td style="display: none;">{{$vehiculo->aseguradora}}</td>
      <td style="display: none;">{{$vehiculo->m3_Unidad}}</td>
      <td style="display: none;">{{$vehiculo->capacidad}}</td>
      <td style="display: none;">{{$vehiculo->nombre}} {{$vehiculo->apellidos}}</td>
      <td style="background-color: #FFE4E1;">Contrato vencido hace {{ abs($metodo->calcularFecha($vehiculo->vigencia_Seguro))}} dias</td>
      <td style="background-color: #FFE4E1;"><center><a class="btn btn-info btn-sm" href="{{URL::action('TransporteController@verTransportes',$vehiculo->id)}}" role="button"><i class="fa fa-sign-in"></i></a></center></td>


      <td style="background-color: #FFE4E1;"> 
        <a href="{{URL::action('TransporteController@edit',$vehiculo->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
      </td>
      <td style="background-color: #FFE4E1;"> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$vehiculo->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
      </td>

    </tr>
    @else 
    <tr class="gradeA">
      <td>{{$vehiculo->nombre_Unidad}} </td>
      <td>{{$vehiculo->no_Serie}} </td>
      <td>{{$vehiculo->placas}} </td>
      <td >{{$vehiculo->poliza_Seguro}}</td>
      <td style="display: none;">{{$vehiculo->vigencia_Seguro}}</td>
      <td style="display: none;">{{$vehiculo->aseguradora}}</td>
      <td style="display: none;">{{$vehiculo->m3_Unidad}}</td>
      <td style="display: none;">{{$vehiculo->capacidad}}</td>
      <td style="display: none;">{{$vehiculo->nombre}} {{$vehiculo->apellidos}}</td>
      <td>Contrato por vencer en {{ $metodo->calcularFecha($vehiculo->vigencia_Seguro)}} dias</td>
      <td><center><a class="btn btn-info btn-sm" href="{{URL::action('TransporteController@verTransportes',$vehiculo->id)}}" role="button"><i class="fa fa-sign-in"></i></a></center></td>


      <td> 
        <a href="{{URL::action('TransporteController@edit',$vehiculo->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
      </td>
      <td> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$vehiculo->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
      </td>

    </tr>
    @endif
    @include('Transportes.transportes.modal')
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th></th>
      <th>Nombre Unidad </th>
      <th>Numero Serie </th>
      <th>Placas </th>
      <th>Poliza Seguro </th>
      <th style="display: none;">Vigencia Seguro </th>
      <th style="display: none;">Aseguradora </th>
      <th style="display: none;">Metros cubicos Unidad </th>
      <th style="display: none;">Capacidad </th>
      <th style="display: none;">Chofer </th>
      <th><center><b>Estado</b></center></th>
      <th><center><b>Mantenimientos</b></center></th>

      <th><center><b>Editar</b></center></th>
      <th><center><b>Borrar</b></center></th>
    </tr>
  </tfoot>
</table>
@endsection


