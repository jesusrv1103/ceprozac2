@inject('metodo','CEPROZAC\Http\Controllers\TransporteController')
@extends('Transportes.transportes.layoutMantenimientos')
@section('tablaMantenimiento')
<table  class="display table table-bordered table-striped" id="dynamic-table">
  <thead>
    <tr>
      <th>Nombre  Tractor</th>
      <th>Responsable de <br> Tractor</th>
      <th>Concepto </th>
      <th>Descripcion </th>
      <th>Fecha Manenimiento </th>
      <th>Responsable de <br>Mantenimiento </th>



      <th><center><b>Editar</b></center></th>
      <th><center><b>Borrar</b></center></th>
    </tr>
  </thead>
  <tbody>
    @foreach($mantenimientos  as $mantenimiento)
    <tr class="gradeA">
      <td>{{$mantenimiento->nombre_Unidad}}</td>
      <td> {{$mantenimiento->nc}} {{$mantenimiento->ac}} </td>
      <td>{{$mantenimiento->concepto}} </td>
      <td>{{$mantenimiento->descripcion}} </td>
      <td>{{$mantenimiento->fecha}}</td>
      <td>{{$mantenimiento->nm}} {{$mantenimiento->am}}  </td>

      <td>
        <center>
          <a href="{{URL::action('MantenimientoTransporteController@edit',$mantenimiento->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
        </center>
      </td>
      <td>
        <center>
         <a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$mantenimiento->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
       </td>
     </td>
   </tr>
   @include('Transportes.mantenimientoTractores.modal')
   @endforeach
 </tbody>
 <tfoot>
  <tr>
    <th>Nombre  Tractor</th>
    <th>Responsable de <br> Tractor</th>
    <th>Concepto </th>
    <th>Descripcion </th>
    <th>Fecha Manenimiento </th>
    <th>Responsable de <br>Mantenimiento </th>

    <th><center><b>Editar</b></center></th>
    <th><center><b>Borrar</b></center></th>
  </tr>
</tfoot>
</table>
@endsection