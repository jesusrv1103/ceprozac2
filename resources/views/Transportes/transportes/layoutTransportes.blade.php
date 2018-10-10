@inject('metodo','CEPROZAC\Http\Controllers\TransporteController')
@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Vehículos</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/provedores')}}">Inicio</a></li>
      <li class="active"> Vehículos</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Vehículos</strong></h2>
            </div>
            <div class="col-md-5">
              <div class="btn-group pull-right">
                <b>

                  <div class="btn-group" style="margin-right: 10px;">



                   <div class="btn-group"  style="margin-right: 10px;">
                     <button class="btn btn-sm btn-info tooltips" data-toggle="dropdown"><i class="fa fa-eye"></i> Ver <span class="caret"></span> </button>
                     <ul class="dropdown-menu">
                       <li> <a href="{{URL::action('TransporteController@index')}}" data-toggle="tooltip" data-placement="bottom" data-original-title="Registrar nuevo Vehículo">Transportes</a> </li>
                       <li> <a href="{{URL::action('TractorController@index')}}">Tractores</a> </li>

                     </ul>
                   </div> 


                   <div class="btn-group"  style="margin-right: 10px;">
                    <button class="btn btn-sm btn-success tooltips" data-toggle="dropdown"><i class="fa fa-plus"></i> Registrar <span class="caret"></span> </button>
                    <ul class="dropdown-menu">
                      <li> <a href="transportes/create" data-toggle="tooltip" data-placement="bottom" data-original-title="Registrar nuevo Vehículo">Transportes</a> </li>
                      <li> <a href="tractores/create"  >Tractores</a> </li>

                    </ul>
                  </div> 

                  <div class="btn-group"  style="margin-right: 10px;">
                    <button class="btn btn-sm btn-warning tooltips" data-toggle="dropdown"><i class="fa fa-plus"></i> Descargar <span class="caret"></span> </button>
                    <ul class="dropdown-menu">
                      <li> <a href="{{ route('transportes.excel')}}" data-toggle="tooltip" data-placement="bottom" data-original-title="Registrar nuevo Vehículo">Transportes</a> </li>
                      <li> <a href="{{ route('tractores.excel')}}"  >Tractores</a> </li>

                    </ul>
                  </div> 

                </div>

              </a>
            </b>
          </div>
        </div>
      </div>
    </div>

    <div class="porlets-content">
      <div class="table-responsive">
       @yield('tablaContenido')
     </div><!--/table-responsive-->
   </div><!--/porlets-content-->
 </div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
