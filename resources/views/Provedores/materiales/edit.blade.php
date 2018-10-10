@inject('metodo','CEPROZAC\Http\Controllers\ProvedorMaterialesController')
@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Provedores</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/materiales/provedores')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('/materiales/provedores')}}">Empresas</a></li>

    </ol>
    
  </div>
</div>
<div class="container clear_both padding_fix">
  <div class="row">
    <div class="col-md-12">
      <div class="block-web">
        <div class="header">
          <div class="row" style="margin-top: 15px; margin-bottom: 12px;">
            <div class="col-sm-8">
              <div class="actions"> </div>
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar proveedor: {{ $provedores->nombre}}</strong></h2> 
            </div>
            <div class="col-md-4">
              <div class="btn-group pull-right">
                <div class="actions"> 
                </div>
              </div>
            </div>    
          </div>
        </div>
        <div class="porlets-content">
          <form action="{{url('materiales/provedores', [$provedores->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text"  onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" required value="{{$provedores->nombre}}" maxlength="70" parsley-rangelength="[1,70]" placeholder="Ingrese nombre de la empresa"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="rfc" type="text"  onchange="mayus(this);"  class="form-control" maxlength="13" id="RFC" type="text" required parsley-regexp="([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})"   required parsley-rangelength="[12,13]"  onkeyup="mayus(this);"   required value="{{$provedores->rfc}}" placeholder="Ingrese RFC de la empresa"/>
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input type="text" parsley-type="phone" placeholder="Ingrese el número de teléfono de la empresa" name="telefono" value="{{ $provedores->telefono}}" required class="form-control mask" data-inputmask="'mask':'(999) 999-9999'">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Direccion: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="direccion" type="text"  onchange="mayus(this);"  class="form-control" required value="{{ $provedores->direccion}}" splaceholder="Ingrese Direccion de la empresa" maxlength="150" parsley-rangelength="[1,150]" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">

                <input name="email" name="email" value="{{ $provedores->email}}" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de la empresa" maxlength="30" parsley-rangelength="[1,30]"/>

              </div>
            </div>


            <div class="form-group">
             <label class="col-sm-3 control-label">Provedor: <strog class="theme_color">*</strog></label>
             <div class="col-sm-6">
               <div class="table-responsive">
                <span id="errorTipo" style="color:#FF0000;"></span><table class="table table-bordered">
                <thead>
                  <tr>
                    <th> 
                      Tipo Proveedores
                    </th> 
                    <th>Agregar Tipo</th>
                    <th>Quitar Tipo</th>
                  </tr>
                </thead>
                <tbody id="myTable">
                  <tr>
                    <td>
                      <div class="col-sm-10">

                        <select   id="tipo_provedor" class="form-control" required>  
                          @foreach($tipoProvedores as $tipo)
                          <option  label="{{$tipo->nombre}}" value="{{$tipo->id}}">

                            {{$tipo->nombre}} 
                          </option>

                          @endforeach              
                        </select>
                      </div>
                    </td>

                    <input type="hidden" name="_token" id="idProvedor">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <td colspan="2"><button type="button" onclick="agregarTipoProvedor1();" class="btn btn-success btn-icon"> Agregar <i class="fa fa-plus"></i> </button></td>
                  </tr>
                  @foreach($metodo->listadoTipoProvedor($provedores->id) as $tipo)


                  <tr><td style="display:none;"><input name="idProvedor[]" value="{{$tipo->tipo}}"></td><td colspan="2">{{ $tipo->nombreTipoProvedor}}</td><td> <button type="button" value="{{$tipo->idProvedorTipo}}" onclick="eliminarTipo(this);myDeleteFunction(this)" class="btn btn-danger btn-icon"> Quitar<i class="fa fa-times"></i> </button></td></tr>

                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>







        <div class="form-group">
          <div class="col-sm-offset-7 col-sm-5">
            <button type="submit" onclick="return save();" class="btn btn-primary">Guardar</button>
            <a href="{{url('/materiales/provedores')}}" class="btn btn-default"> Cancelar</a>
          </div>
        </div><!--/form-group-->
      </form>
    </div><!--/porlets-content-->
  </div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->



@endsection
