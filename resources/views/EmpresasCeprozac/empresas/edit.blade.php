@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Empresas CEPROZAC</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('empresasCEPROZAC')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('empresasCEPROZAC')}}">Empresas CEPROZAC</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Empresa CEPROZAC</strong></h2> 
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
          <form action="{{url('empresasCEPROZAC', [$empresasCEPROZAC->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text"  onchange="mayus(this);"  class="form-control" maxlength="100" parsley-rangelength="[1,200]"  required value="{{$empresasCEPROZAC->nombre}}" placeholder="Ingrese nombre de la empresa"/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Representante Legal: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="representanteLegal" type="text"  onchange="mayus(this);"  class="form-control" maxlength="100" parsley-rangelength="[1,200]"  required  value="{{$empresasCEPROZAC->representanteLegal}}" placeholder="Ingrese Representante legal de la empresa"/>
              </div>
            </div>

            <input name="rfcOculto" id="ocultoRFC"  hidden value="{{$empresasCEPROZAC->rfc}}" />

            <div class="form-group">
              <label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="rfc" type="text" id="rfc"  onchange="mayus(this);" onblur="validarEmpresaCEPROZAC()"  class="form-control" maxlength="13" id="RFC" type="text" required parsley-regexp="([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})"   required parsley-rangelength="[12,13]"  onkeyup="mayus(this);"   required value="{{$empresasCEPROZAC->rfc}}" placeholder="Ingrese RFC de la empresa"/>
                <span id="errorRFC" style="color:#FF0000;"></span>
              </div>
            </div>

            
            <div class="form-group">
              <label class="col-sm-3 control-label"> Regimen Fiscal: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
               <select name="idRegimenFiscal" class="form-control select2" required> 
                 <
                 @foreach($regimenFiscal as $regimen)
                 @if($empresasCEPROZAC->idRegimenFiscal== $regimen->id)
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
              <input type="text" placeholder="Ingrese el número de teléfono de la empresa" name="telefono" value="{{$empresasCEPROZAC->telefono}}" class="form-control mask" data-inputmask="'mask':'(999) 999-9999'" parsley-type="phone" maxlength="200">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Direccion de Facturacion: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="direcionFacturacion" type="text"  onchange="mayus(this);"  class="form-control" required placeholder="Ingrese Direccion de la empresa" value="{{$empresasCEPROZAC->direcionFacturacion}}" maxlength="200" parsley-rangelength="[1,200]"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Direccion Fisica: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="direcionFisica" type="text"  onchange="mayus(this);"  class="form-control" required value="{{$empresasCEPROZAC->direcionFisica}}" placeholder="Ingrese Direccion de la empresa" maxlength="200" parsley-rangelength="[1,200]"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="email" name="email" value="{{$empresasCEPROZAC->email}}" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de la empresa" maxlength="30" parsley-rangelength="[1,30]"/>

            </div>
          </div>

          



          <div class="form-group">
            <div class="col-sm-offset-7 col-sm-5">
              <button type="submit" class="btn btn-primary" id="submit">Guardar</button>
              <a href="{{url('/empresasCEPROZAC')}}" class="btn btn-default"> Cancelar</a>
            </div>
          </div><!--/form-group-->
        </form>
      </div><!--/porlets-content-->
    </div><!--/block-web-->
  </div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->

@include('EmpresasCeprozac.empresas.modalReactivar')

@endsection
