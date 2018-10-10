@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Empresas</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('/empresas')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('/empresas')}}">Empresas</a></li>
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
              <div class="actions"><h3></h3> </div>
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Empresa: {{ $empresas->nombre}}</strong></h2> 
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
          <form action="{{url('empresas', [$empresas->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

            <input name="rfcOculto" id="oculto" value="{{$empresas->rfc}}" hidden  />
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" maxlength="200" parsley-rangelength="[1,200]"  required value="{{$empresas->nombre}}" placeholder="Ingrese nombre de la empresa"/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="rfc" type="text"  onchange="mayus(this);quitarEspacios(this);" onblur="validarEmpresa();" class="form-control" maxlength="13" id="RFC" type="text" required parsley-regexp="([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})"   required parsley-rangelength="[12,13]"  onkeyup="mayus(this);"   required value="{{$empresas->rfc}}" placeholder="Ingrese RFC de la empresa"/>

                <span id="errorRFC" style="color:#FF0000;"></span>
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label"> Regimen Fiscal: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
               <select name="idRegimenFiscal" class="form-control select2" required> 
                 <
                 @foreach($regimenFiscal as $regimen)
                 @if($empresas->idRegimenFiscal== $regimen->id)
                 <option value="{{$regimen->id}}" selected>
                   {{$regimen->nombre}}
                 </option>
                 @else
                 <option value="{{$regimen->id}}" >
                   {{$regimen->nombre}}
                 </option>
                 @endif
                 @endforeach              
               </select>
               <div class="help-block with-errors"></div>
             </div>
           </div><!--/form-group-->


           <div class="form-group">
            <label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <input type="text" placeholder="Ingrese el número de teléfono de la empresa" name="telefono"  class="form-control mask" data-inputmask="'mask':'(999) 999-9999'" parsley-type="phone" maxlength="200" value="{{$empresas->telefono}}">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Direccion: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="direccion" type="text"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" required value="{{$empresas->direccion}}" placeholder="Ingrese Direccion de la empresa" maxlength="200" parsley-rangelength="[1,200]"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input  name="email" value="{{$empresas->email}}" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de la empresa" maxlength="30" parsley-rangelength="[1,30]"/>

            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label"> Proveedor: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="provedor_id" class="form-control" required>  
                @foreach($provedores as $provedor)
                @if($provedor->id==$empresas->provedor_id)
                <option value="{{$provedor->id}}" selected>
                 {{$provedor->nombre}} {{$provedor->apellidos}}
               </option>
               @else
               <option value="{{$provedor->id}}">
                 {{$provedor->nombre}} {{$provedor->apellidos}}
                 @endif
                 @endforeach              
               </select>
               <div class="help-block with-errors"></div>
             </div>
           </div><!--/form-group-->

           <div class="form-group">
            <div class="col-sm-offset-7 col-sm-5">
              <button type="submit" class="btn btn-primary" id="submit">Guardar</button>
              <a href="{{url('/empresas')}}" class="btn btn-default"> Cancelar</a>
            </div>
          </div><!--/form-group-->
        </form>
      </div><!--/porlets-content-->
    </div><!--/block-web-->
  </div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->


@include('Provedores.empresas.modalReactivar')
@endsection
