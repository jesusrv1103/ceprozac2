@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Detalle de Producto</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li ><a style="color: #808080" href="{{url('/almacen/materiales')}}">Inicio</a></li>
      <li class="active">Producto Registrado</a></li>
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
              <h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Producto Registrado Correctamente</strong></h4>
            </div>
            <div class="btn-group pull-right">
              <b>
                <div class="btn-group" style="margin-right: 10px;">
                  <a class="btn btn-sm btn-danger tooltips" href="{{url('/almacen/materiales')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>
                </div> 
              </b>
            </div>

          </div>
        </div>
        <div class="porlets-content container clear_both padding_fix">


          @foreach($material as $mat)
          <div class="col-lg-6">
            <section class="panel green_border horizontal_border_2">
              <div class="block-web">
                <div class="header">

                  <h3>Producto: {{$mat->nombre}}</h3>
                </div>
                <div class="porlets-content" style="display: block;">
                 <p align="justify"><strong>Codigo de Barras:</strong> {{$mat->codigo}}</p>
                 @if (($mat->codigo)!="")
                 <td><?php echo DNS1D::getBarcodeHTML("$mat->codigo", "C128");?>
                  <div style="text-align:center;">              
                  </div>
                </td>
                @else
                <td>Codigo de Barras No Generado </td>
                @endif


<<<<<<< HEAD
                <p align="justify"><strong>Descripcion:</strong> {{$mat->descripcion}}</p>
                <p align="justify"><strong>Ubicación Actual:</strong> {{$mat->ubicacion}}</p>
                <p align="justify"><strong>Cantidad en Almacén:</strong> {{$mat->cantidad}}  </p>
                <p align="justify"><strong>Stock Minimo:</strong> {{$mat->stock_minimo}}   </p>
                <p align="justify"><strong>Creado el:</strong> {{$mat->created_at}}</p>
                <td>
=======
                 <p align="justify"><strong>Descripcion:</strong> {{$mat->descripcion}}</p>
                 <p align="justify"><strong>Ubicación Actual:</strong> {{$mat->ubicaciones2}}</p>
                 <p align="justify"><strong>Cantidad en Almacén:</strong> {{$mat->cantidad}}  </p>
                 <p align="justify"><strong>Stock Minimo:</strong> {{$mat->stock_minimo}}   </p>
                 <p align="justify"><strong>Creado el:</strong> {{$mat->created_at}}</p>
                   <td>
>>>>>>> d3d3c8de7d37cce1681f947cfbc718167259f896
                  @if (($mat->imagen)!="")
                  <img src="{{asset('imagenes/almacenmateriales/'.$mat->imagen)}}" alt="{{$mat->nombre}}" height="100px" width="100px" class="img-thumbnail">
                  @else
                  No Hay Imagen Disponible
                  @endif
                </td> 
              </div>
            </div>
          </section>
          @if (($mat->codigo)!="")
          <a class="btn btn-sm btn btn-info" href="{{URL::action('AlmacenMaterialController@invoice',$mat->id)}}" target="_blank" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nueva Entrada"> <i class="fa fa-print"></i>Imprimir Codigo de Barras</a>
          @endif
        </div>
        @endforeach




      </div><!--/porlets-content-->
    </div><!--/block-web-->
  </div><!--/col-md-12-->
</div><!--/row-->
</div>



@endsection