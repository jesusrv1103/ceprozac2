@inject('metodo','CEPROZAC\Http\Controllers\TransporteController')
@extends('Transportes.transportes.layoutTransportes')
@section('tablaContenido')
<table  class="display table table-bordered table-striped" id="dynamic-table">
  <thead>
    <tr>
      <th >Nombre Unidad </th>
      <th>Descripcion </th>
      <th>Mantenimientos</th>
      <th><center><b>Editar</b></center></th>
      <th><center><b>Borrar</b></center></th>
    </tr>
  </thead>
  <tbody>
    @foreach($vehiculos  as $vehiculo)
    <tr class="gradeA">
      <td>{{$vehiculo->nombre}} </td>
      <td> 
        @if($vehiculo->descripcion =="")
        No hay informacion disponible
        @else
        {{$vehiculo->descripcion}}
        @endif

      </td>
      <td><center><a class="btn btn-info btn-sm" href="{{URL::action('TractorController@verMantenimientos',$vehiculo->id)}}" role="button"><i class="fa fa-sign-in"></i></a></center></td>
      <td> 
        <center>
          <a href="{{URL::action('TractorController@edit',$vehiculo->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
        </center>
      </td>
      <td><center> <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$vehiculo->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
      </td>

    </tr>

    @include('Transportes.tractores.modal')
    @endforeach
  </tbody>
  <tfoot>
    <tr>

      <th>Nombre Unidad </th>
      <th>Descripcion </th> 
      <th><center><b>Mantenimientos</b></center></th>
      <th><center><b>Editar</b></center></th>
      <th><center><b>Borrar</b></center></th>
    </tr>
  </tfoot>
</table>
@endsection



