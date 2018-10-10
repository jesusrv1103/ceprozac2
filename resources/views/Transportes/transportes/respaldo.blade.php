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
                      <button class="btn btn-sm btn-success tooltips" data-toggle="dropdown"><i class="fa fa-plus"></i> Registrar <span class="caret"></span> </button>
                      <ul class="dropdown-menu">
                        <li> <a href="transportes/create" data-toggle="tooltip" data-placement="bottom" data-original-title="Registrar nuevo Vehículo">Transportes</a> </li>
                        <li> <a href="#">Trailers</a> </li>
                        <li> <a href="#">Tractores</a> </li>  
                      </ul>
                    </div> 
                    
                    <a class="btn btn-sm btn-warning tooltips" href="{{ route('transportes.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" 
                    data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

                    
                  </div>
                  
                </a>
              </b>
            </div>
          </div>
        </div>
      </div>

      <div class="porlets-content">
        <div class="table-responsive">
          
        </div><!--/table-responsive-->
      </div><!--/porlets-content-->
    </div><!--/block-web-->
  </div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
