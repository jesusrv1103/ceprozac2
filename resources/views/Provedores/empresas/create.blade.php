@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Empresas</h2>
  </div>
  <div class="pull-right">
    <ol class="breadcrumb">
      <li><a style="color: #808080" href="{{url('empresas')}}">Inicio</a></li>
      <li><a style="color: #808080" href="{{url('empresas')}}">Empresas</a></li>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Registrar Empresa</strong></h2> 
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
          <form action="{{route('empresas.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
            {{csrf_field()}}

            <input name="rfcOculto" id="oculto"  hidden  />
            <div class="form-group">
              <label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="nombre" type="text"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" maxlength="200" parsley-rangelength="[1,200]"  required value="" placeholder="Ingrese nombre de la empresa"/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <input name="rfc" type="text"  onchange="mayus(this);validarEmpresa();quitarEspacios(this);"  class="form-control" maxlength="13" id="RFC" type="text" required parsley-regexp="([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})" id="rfc"   required parsley-rangelength="[12,13]"  onkeyup="mayus(this);"   required value="" placeholder="Ingrese RFC de la empresa"/>

                <span id="errorRFC" style="color:#FF0000;"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label"> Regimen Fiscal: <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
               <select name="idRegimenFiscal" class="form-control select2" required> 
                 <option value="">
                   Selecione Regimen Fiscal
                 </option> 
                 @foreach($regimenFiscal as $regimen)
                 <option value="{{$regimen->id}}">
                   {{$regimen->nombre}}
                 </option>
                 @endforeach              
               </select>
               <div class="help-block with-errors"></div>
             </div>
           </div><!--/form-group-->


           <div class="form-group">
            <label class="col-sm-3 control-label">Telefono: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <input type="text" placeholder="Ingrese el número de teléfono de la empresa" name="telefono" value="" class="form-control mask" required="" data-inputmask="'mask':'(999) 999-9999'" parsley-type="phone" maxlength="200">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Direccion: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="direccion" type="text"  onchange="mayus(this);quitarEspacios(this);"  class="form-control" required  placeholder="Ingrese Direccion de la empresa" maxlength="200" parsley-rangelength="[1,200]"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Email: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">

              <input name="email" name="email" value="" required parsley-type="email" class="form-control mask" placeholder="Ingrese email de la empresa" maxlength="30" parsley-rangelength="[1,30]"/>

            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label"> Proveedor: <strog class="theme_color">*</strog></label>
            <div class="col-sm-6">
              <select name="provedor_id" class="form-control" required>  
                @foreach($provedores as $provedor)
                <option value="{{$provedor->id}}">
                 {{$provedor->nombre}} {{$provedor->apellidos}}
               </option>
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
