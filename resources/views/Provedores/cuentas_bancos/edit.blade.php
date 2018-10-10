<style type="text/css">
  textarea {
    resize: none;
  }
</style>
@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
  <div class="pull-left page_title theme_color">
    <h1>Inicio</h1>
    <h2 class="">Cuentas Bancarias de Empresas CEPROZAC</h2>
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
              <h2 class="content-header" style="margin-top: -5px;"><strong>Editar Cuentas {{$cuentas->num_cuenta}}</strong></h2> 
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


          <form action="{{url('cuentasBancoProvedores',[$cuentas->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate>
            {{csrf_field()}}

            <input type="hidden" name="_method" value="PUT">
            <input name="idEmpresa"  type="hidden"   class="form-control" value="{{$cuentas->idEmpresa}}" />
            <div class="form-group">
             <label class="col-sm-3 control-label"> Banco: <strog class="theme_color">*</strog></label>
             <div class="col-sm-6">
               <select name="idBanco" class="form-control" required>  
                @foreach($bancos as $banco)
                @if($banco->id ==$cuentas->idBanco)
                <option value="{{$banco->id}}">
                 {{$banco->nombre}}
               </option>
               @else
               <option value="{{$banco->id}}">
                 {{$banco->nombre}}
               </option>
               @endif
               @endforeach              
             </select>
             <div class="help-block with-errors"></div>
           </div>
         </div><!--/form-group-->

         <input name="ocultoNumCuenta" id="ocultoNumCuenta"  hidden  value="{{$cuentas->num_cuenta}}" />
         <div class="form-group">
           <label class="col-sm-3 control-label">Numero de cuenta:</label>
           <div class="col-sm-6">
             <input type="text" name="num_cuenta" class="form-control" required parsley-rangelength="[10,16]" placeholder="Número de cuenta bancaria" maxlength="16" minlength="10" id="num_cuenta"  onblur=" validarNumeroCuentaEmProvedor();" value="{{$cuentas->num_cuenta}}" />
             <span id="errorNumCuenta" style="color:#FF0000;"></span>
           </div>
         </div><!--/form-group--> 


         <input name="ocultoCve_Interbancaria" id="ocultoCve_Interbancaria" value="{{$cuentas->cve_interbancaria}}"  hidden  />

         <div class="form-group">
          <label class="col-sm-3 control-label">Número de CLABE Interbancaria: </label>
          <div class="col-sm-6">
            <input type="text"  name= "cve_Interbancaria" class="form-control" onblur="validarNumeroCveInterbancariaEmProvedor();" id="cve_Interbancaria" required parsley-rangelength="[18,19]" placeholder="Número de CLABE Interbancaria" maxlength="19" minlength="18" value="{{$cuentas->cve_interbancaria}}" />
            <span id="errorCveInterbancaria" style="color:#FF0000;"></span>
          </div>
        </div><!--/form-group--> 






        <div class="form-group">
          <div class="col-sm-offset-7 col-sm-5">
            <button type="submit" class="btn btn-primary" id="submit">Guardar</button>

            <a href="{{URL::action('EmpresaController@verCuentas',$cuentas->idEmpresa)}}" class="btn btn-default "> Cancelar</a> 

          </div>
        </div><!--/form-group-->
      </form>
    </div><!--/porlets-content-->
  </div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@include('Provedores.cuentas_bancos.modalReactivar')
@endsection
