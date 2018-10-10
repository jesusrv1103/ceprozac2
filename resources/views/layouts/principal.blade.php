<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>CEPROZAC</title>
  
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="icon" type="image/png" href="images/LOGOCEPROZAC.png" />
  {!!Html::style('css/font-awesome.css')!!}
  {!!Html::style('css/bootstrap.min.css')!!}
  {!!Html::style('css/animate.css')!!}
  {!!Html::style('css/admin.css')!!}
  {!!Html::style('css/MisEstilos.css')!!}
  {!!Html::style('plugins/advanced-datatable/css/demo_table.css')!!}
  {!!Html::style('plugins/advanced-datatable/css/demo_page.css')!!}
  {!!Html::style('plugins/toggle-switch/toggles.css')!!}
  <!--link href="css/select2.css" rel="stylesheet"-->
  {!!Html::style('plugins/bootstrap-editable/bootstrap-editable.css')!!}
  {!!Html::style('plugins/dropzone/dropzone.css')!!}
  {!!Html::style('plugins/data-tables/DT_bootstrap.css')!!}
  {!!Html::style('plugins/data-tables/DT_bootstrap.css')!!}
  {!!Html::style('plugins/advanced-datatable/css/demo_table.css')!!}
  {!!Html::style('plugins/advanced-datatable/css/demo_page.css')!!}
  {!!Html::style('plugins/bootstrap-fileupload/bootstrap-fileupload.min.css')!!}
  {!!Html::style('plugins/file-uploader/css/jquery.fileupload.css')!!}
  {!!Html::style('plugins/file-uploader/css/jquery.fileupload-ui.css')!!}
  {!!Html::style('plugins/bootstrap-datepicker/css/datepicker.css')!!}
  {!!Html::style('plugins/bootstrap-timepicker/compiled/timepicker.css')!!}
  {!!Html::style('plugins/bootstrap-colorpicker/css/colorpicker.css')!!}
  {!!Html::style('plugins/select2/dist/css/select2.css')!!}

  <!--Estilos Para radio buton y switch -->
  {!!Html::style('plugins/toggle-switch/toggles.css')!!}
  {!!Html::style('plugins/checkbox/icheck.css')!!}
  {!!Html::style('plugins/checkbox/minimal/blue.css')!!}
  {!!Html::style('plugins/checkbox/minimal/green.css')!!}
  {!!Html::style('plugins/checkbox/minimal/grey.css')!!}
  {!!Html::style('plugins/checkbox/minimal/orange.css')!!}
  {!!Html::style('plugins/checkbox/minimal/pink.css')!!}
  {!!Html::style('plugins/checkbox/minimal/purple.css')!!}
  {!!Html::style('plugins/bootstrap-fileupload/bootstrap-fileupload.min.css')!!}

  <!--Wizard  -->
  {!!Html::style('plugins/wizard/css/smart_wizard.css')!!}
  <!-- Optional SmartWizard theme -->
  {!!Html::style('plugins/wizard/css/smart_wizard_theme_dots.css')!!}
  <!-- Optional SmartWizard theme -->
  {!!Html::style('plugins/wizard/css/smart_wizard_theme_circles.css')!!}
  {!!Html::style('plugins/wizard/css/smart_wizard_theme_arrows.css')!!}
  {!!Html::style('plugins/wizard/css/smart_wizard_theme_dots.css')!!}

</head>
<style type="text/css">
.disabled {
  pointer-events:none; /*This makes it not clickable*/
  opacity:0.6;         /*This grays it out to look disabled*/
}
.lblheader{
  color:#2196F3;
}

a {
  color: #FFF;
  text-decoration: none;
}

b:hover{
  /*color: #428BCA;*/
  color: #66B5EB;
  /*background-color: lightblue;*/
}

</style>
<body class="blue_thm  fixed_header left_nav_fixed">
  <div class="wrapper">
    <!--\\\\\\\ wrapper Start \\\\\\-->
    <div class="header_bar">
      <!--\\\\\\\ header Start \\\\\\-->
      <div class="brand">
        <!--\\\\\\\ brand Start \\\\\\-->
        <div class="logo" style="display:block"><span class="light_theme">CEPROZAC</span> </div>
        <div class="small_logo" style="display:none"><img src="images/s-logo.png" width="50" height="47" alt="s-logo" /> <img src="images/r-logo.png" width="122" height="20" alt="r-logo" /></div>
      </div>
      <!--\\\\\\\ brand end \\\\\\-->
      <div class="header_top_bar">
        <!--\\\\\\\ header top bar start \\\\\\-->
        <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
        <div class="top_left">

        </div>

        <div class="top_right_bar">

          <div class="user_admin dropdown"> <a href="javascript:void(0);" data-toggle="dropdown"><img src="images/user.png" /><span class="user_adminname"><!--{{Route::getCurrentRoute()->getName()}}-->John Doe</span> <b class="caret"></b> </a>
            <ul class="dropdown-menu">
              <div class="top_pointer"></div>
              <li> <a href="profile.html"><i class="fa fa-user"></i> Profile</a> </li>
              <li> <a href="help.html"><i class="fa fa-question-circle"></i> Help</a> </li>
              <li> <a href="settings.html"><i class="fa fa-cog"></i> Setting </a></li>
              <li> <a href="{{url('/')}}""><i class="fa fa-power-off"></i> Logout</a> </li>
            </ul>
          </div>
        </div>
      </div>
      <!--\\\\\\\ header top bar end \\\\\\-->
    </div>
    <!--\\\\\\\ header end \\\\\\-->
    <div class="inner">
      <!--\\\\\\\ inner start \\\\\\--><div class="left_nav">

        <!--\\\\\\\left_nav start \\\\\\-->


        <div class="left_nav_slidebar">
          <ul >
            @if(str_contains(Route::getCurrentRoute()->getName(),['provedores','empresas','bancos','materiales/provedores','tipoProvedores']) && !str_contains(Route::getCurrentRoute()->getName(),['CEPROZAC']))
            <li class="left_nav_active theme_border"><a href="javascript:void(0);"><i class="fa fa-home"></i> Provedores<span class="plus"><i class="fa fa-plus"></i></span> </a>
              <ul class="opened" style="display:block;" >
                @else
                <li ><a href="javascript:void(0);"><i class="fa fa-home"></i> Provedores<span class="plus"><i class="fa fa-plus"></i></span> </a>
                  <ul>
                    @endif
                    <li> <a href="{{url('provedores')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                      @if(str_contains(Route::getCurrentRoute()->getName(),['provedores']) && !str_contains(Route::getCurrentRoute()->getName(),['materiales']))
                      <b class="theme_color">Proveedores</b></a> 
                      @else
                      <b>
                       Proveedores
                     </b></a>
                     @endif
                   </li>

                   <li><a href="{{url('empresas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                    @if(str_contains(Route::getCurrentRoute()->getName(),['empresas']) && !str_contains(Route::getCurrentRoute()->getName(),['CEPROZAC']))
                    <b  class="theme_color" >Empresas</b></a>
                    @else
                    <b>Empresas</b></a> 
                    @endif
                  </li>

                  <li> <a href="{{url('tipoProvedores')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                   @if(str_contains(Route::getCurrentRoute()->getName(),['tipoProvedores']))
                   <b  class="theme_color" >Tipo Proveedores</b></a>
                   @else
                   <b>Tipo Proveedores</b></a> 
                   @endif
                 </li>

                 <li> <a href="{{url('bancos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                   @if(str_contains(Route::getCurrentRoute()->getName(),['bancos']))
                   <b class="theme_color">Bancos</b> </a> 
                   @else 
                   <b >Bancos</b> </a> 
                   @endif
                 </li>

                 <li> <a href="{{url('materiales/provedores')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                   @if(str_contains(Route::getCurrentRoute()->getName(),['materiales']))
                   <b class="theme_color">Materiales</b> </a> 
                   @else
                   <b  >Materiales</b> </a> 
                   @endif
                 </li>

               </ul>
             </li>


             @if(str_contains(Route::getCurrentRoute()->getName(),['clientes']))
             <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Clientes<span class="plus"><i class="fa fa-plus"></i></span> </a>
               <ul class="opened" style="display:block">
                @else
                <li> <a href="javascript:void(0);"> <i class="fa fa-edit"></i> Clientes<span class="plus"><i class="fa fa-plus"></i></span> </a>
                 <ul>
                  @endif
                  <li> <a href="{{url('clientes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                    @if(str_contains(Route::getCurrentRoute()->getName(),['clientes']))
                    <b class="theme_color">Clientes</b></a>
                    @else
                    <b>Clientes</b></a>
                    @endif 
                  </li>
                </ul>
              </li>



              @if(str_contains(Route::getCurrentRoute()->getName(),['productos','calidad','empaques']))
              <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Productos <span class="plus"><i class="fa fa-plus"></i></span></a>
                <ul class="opened" style="display: block;">
                  @else
                  <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Productos<span class="plus"><i class="fa fa-plus"></i></span> </a>
                    <ul>
                      @endif
                      <li> <a href="{{url('productos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                        @if(str_contains(Route::getCurrentRoute()->getName(),['productos'])) 
                        <b class="theme_color">Productos</b> </a>
                        @else
                        <b >Productos</b></a>
                        @endif
                      </li>


                      <li> <a href="{{url('calidad')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                        @if(str_contains(Route::getCurrentRoute()->getName(),['calidad']))  
                        <b class="theme_color">Calidad</b> </a> 
                        @else
                        <b>Calidad</b> </a> 
                        @endif
                      </li>

                      <li> <a href="{{url('empaques')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                       @if(str_contains(Route::getCurrentRoute()->getName(),['empaques']))
                       <b class="theme_color">Empaques</b> </a> 
                       @else
                       <b>Empaques</b> </a> 
                       @endif
                     </li>
                   </ul>
                 </li>

                 @if(str_contains(Route::getCurrentRoute()->getName(),['empleados','rol','contratos']))
                 <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Recursos Humanos <span class="plus"><i class="fa fa-plus"></i></span></a>
                  <ul class="opened" style="display: block;">
                    @else
                    <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Recursos Humanos<span class="plus"><i class="fa fa-plus"></i></span> </a>
                      <ul>
                        @endif
                        <li> <a href="{{url('empleados')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                         @if(str_contains(Route::getCurrentRoute()->getName(),['empleados']))
                         <b class="theme_color">Empleados</b></a>
                         @else
                         <b >Empleados</b></a>
                         @endif
                       </li>

                       <li> <a href="{{url('rol')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                        @if(str_contains(Route::getCurrentRoute()->getName(),['rol']))
                        <b class="theme_color">Roles Empleados</b> </a> 
                        @else
                        <b>Roles Empleados</b> </a> 
                        @endif
                      </li>

                      <li> <a href="{{url('contratos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                       @if(str_contains(Route::getCurrentRoute()->getName(),['contratos']))
                       <b class="theme_color">Contratos</b> </a> </li>
                       @else
                       <b>Contratos</b> </a> </li>
                       @endif
                     </ul>
                   </li>


                   @if(str_contains(Route::getCurrentRoute()->getName(),['transportes','tractores','mantenimiento']))
                   <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-truck icon"></i> Transporte <span class="plus"><i class="fa fa-plus"></i></span></a>
                    <ul class="opened" style="display: block;">
                      @else
                      <li> <a href="javascript:void(0);"> <i class="fa fa-truck icon"></i> Transporte <span class="plus"><i class="fa fa-plus"></i></span> </a>
                        <ul>
                          @endif
                          <li> <a href="{{url('transportes')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                            @if(str_contains(Route::getCurrentRoute()->getName(),['transportes','tractores']))
                            <b class="theme_color">Vehículos</b> </a> </li>
                            @else
                            <b>Vehículos</b> </a> </li>
                            @endif

                            <li> <a href="{{url('mantenimiento')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                              @if(str_contains(Route::getCurrentRoute()->getName(),['mantenimiento'])) 
                              <b class="theme_color">Mantenimientos</b> </a> </li>
                              @else
                              <b>Mantenimientos</b> </a> </li>
                              @endif
                            </ul>
                          </li>


                          @if(str_contains(Route::getCurrentRoute()->getName(),['empresasCEPROZAC']))
                          <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-shopping-cart"></i> Empresas <span class="plus"><i class="fa fa-plus"></i></span></a>
                            <ul class="opened" style="display: block;">
                              @else
                              <li> <a href="javascript:void(0);"> <i class="fa fa-shopping-cart"></i> Empresas <span class="plus"><i class="fa fa-plus"></i></span> </a>
                                <ul>
                                 @endif
                                 <li> <a href="{{url('empresasCEPROZAC')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                  @if(str_contains(Route::getCurrentRoute()->getName(),['empresasCEPROZAC'])) 
                                  <b class="theme_color">Empresas</b> </a> </li>
                                  @else
                                  <b>Empresas</b> </a> </li>
                                  @endif
                                </ul>
                              </li>

                              @if(str_contains(Route::getCurrentRoute()->getName(),['almacen']))
                              <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Almacénes <span class="plus"><i class="fa fa-plus"></i></span></a>
                                <ul class="opened" style="display: block;">
                                  @else
                                  <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Almacénes <span class="plus"><i class="fa fa-plus"></i></span></a>
                                    <ul>
                                      @endif

                                      <li> <a href="{{url('almacenes/agroquimicos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                        @if(str_contains(Route::getCurrentRoute()->getName(),['almacenes.agroquimicos','entradas.agroquimicos','salidas.agroquimicos'])) 
                                        <b class="theme_color">Agroquímicos</b> </a> </li>
                                        @else
                                        <b>Agroquímicos</b> </a> </li>
                                        @endif

                                        <li> <a href="{{url('almacenes/limpieza')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i>
                                         @if(str_contains(Route::getCurrentRoute()->getName(),['almacenes.limpieza','entradas.limpieza','salidas.limpieza']))  
                                         <b class="theme_color">Limpieza</b> </a> </li>
                                         @else
                                         <b>Limpieza</b> </a> </li>
                                         @endif

                                         <li> <a href="{{url('almacen/materiales')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                          @if(str_contains(Route::getCurrentRoute()->getName(),['almacen.materiales','entradas.materiales','salidas.materiales'])) 
                                          <b class="theme_color">Materiales</b> </a> </li>
                                          @else
                                          <b>Materiales</b> </a> </li>
                                          @endif

                                          <li> <a href="{{url('almacenes/empaque')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                           @if(str_contains(Route::getCurrentRoute()->getName(),['almacenes.empaque','entradas.empaque','salidas.empaque'])) 
                                           <b class="theme_color">Empaque</b> </a> </li>
                                           @else
                                           <b>Empaque</b> </a> </li>
                                           @endif

                                           <li> <a href="{{url('almacen/general')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                            @if(str_contains(Route::getCurrentRoute()->getName(),['almacen.general'])) 
                                            <b class="theme_color">Generales</b> </a> </li>
                                            @else
                                            <b>Generales</b> </a> </li>
                                            @endif
                                          </ul>
                                        </li>


                                        @if(str_contains(Route::getCurrentRoute()->getName(),['basculas','precioBasculas','serviciosBascula']))
                                        <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Basculas <span class="plus"><i class="fa fa-plus"></i></span></a>
                                          <ul class="opened" style="display: block;">
                                            @else
                                            <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Basculas <span class="plus"><i class="fa fa-plus"></i></span></a>
                                              <ul>
                                                @endif
                                                <li> <a href="{{url('basculas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"
                                                  ></i> 
                                                  @if(str_contains(Route::getCurrentRoute()->getName(),['basculas'])) 
                                                  <b class="theme_color">Basculas</b> </a> </li>
                                                  @else
                                                  <b>Basculas</b> </a> </li>
                                                  @endif
                                                  <li> <a href="{{url('precioBasculas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                                    @if(str_contains(Route::getCurrentRoute()->getName(),['precioBasculas'])) 
                                                    <b class="theme_color">Precio Pesaje</b> </a> </li>
                                                    @else
                                                    <b>Precio Pesaje</b> </a> </li>
                                                    @endif

                                                    <li> <a href="{{url('serviciosBascula')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                                      @if(str_contains(Route::getCurrentRoute()->getName(),['serviciosBascula'])) 
                                                      <b class="theme_color">Servicio de Bascula</b> </a> </li>
                                                      @else
                                                      <b>Servicio de Bascula</b> </a> </li>
                                                      @endif
                                                    </ul>
                                                  </li>

                                                  @if(str_contains(Route::getCurrentRoute()->getName(),['basculas']))
                                                  <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Bitacoras <span class="plus"><i class="fa fa-plus"></i></span></a>
                                                    <ul class="opened" style="display: block;">
                                                      @else
                                                      <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Bitacoras <span class="plus"><i class="fa fa-plus"></i></span></a>
                                                        <ul>
                                                          @endif
                                                          <li> <a href="{{url('basculas')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                                            @if(str_contains(Route::getCurrentRoute()->getName(),['basculas'])) 
                                                            <b class="theme_color">Basculas</b> </a> </li>
                                                            @else
                                                            <b>Basculas</b> </a> </li>
                                                            @endif
                                                          </ul>
                                                        </li>

                                                        @if(str_contains(Route::getCurrentRoute()->getName(),['compras']))
                                                        <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-shopping-cart"></i> Compras <span class="plus"><i class="fa fa-plus"></i></span></a>
                                                          <ul class="opened" style="display: block;">
                                                            @else
                                                            <li> <a href="javascript:void(0);"> <i class="fa fa-shopping-cart"></i> Compras <span class="plus"><i class="fa fa-plus"></i></span> </a>
                                                              <ul>
                                                                @endif
                                                                <li> <a href="{{url('compras/recepcion/')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                                                 @if(str_contains(Route::getCurrentRoute()->getName(),['compras'])) 
                                                                 <b class="theme_color">Materia Prima</b> </a> </li>
                                                                 @else
                                                                 <b>Materia Prima</b> </a> </li>
                                                                 @endif
                                                               </ul>
                                                             </li>

                                                             @if(str_contains(Route::getCurrentRoute()->getName(),['fumigaciones']))
                                                             <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Compras <span class="plus"><i class="fa fa-plus"></i></span></a>
                                                              <ul class="opened" style="display: block;">
                                                                @else
                                                                <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Fumigaciones <span class="plus"><i class="fa fa-plus"></i></span> </a>
                                                                  <ul>
                                                                    @endif
                                                                    <li> <a href="{{url('fumigaciones')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                                                     @if(str_contains(Route::getCurrentRoute()->getName(),['fumigaciones'])) 
                                                                     <b class="theme_color">Fumigaciones</b> </a> </li>
                                                                     @else
                                                                     <b>Fumigaciones</b> </a> </li>
                                                                     @endif
                                                                   </ul>
                                                                 </li>

                                                                 @if(str_contains(Route::getCurrentRoute()->getName(),['invernaderos']))
                                                                 <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Invernaderos <span class="plus"><i class="fa fa-plus"></i></span></a>
                                                                  <ul class="opened" style="display: block;">
                                                                    @else
                                                                    <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Invernaderos <span class="plus"><i class="fa fa-plus"></i></span> </a>
                                                                      <ul>
                                                                        @endif
                                                                        <li> <a href="{{url('invernaderos')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                                                         @if(str_contains(Route::getCurrentRoute()->getName(),['invernaderos'])) 
                                                                         <b class="theme_color">Invernaderos</b> </a> </li>
                                                                         @else
                                                                         <b>Invernaderos</b> </a> </li>
                                                                         @endif
                                                                       </ul>
                                                                     </li>

                                                                     @if(str_contains(Route::getCurrentRoute()->getName(),['unidades_medida']))
                                                                     <li class="left_nav_active theme_border"> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Unidades de Medida <span class="plus"><i class="fa fa-plus"></i></span></a>
                                                                      <ul class="opened" style="display: block;">
                                                                        @else
                                                                        <li> <a href="javascript:void(0);"> <i class="fa fa-tasks"></i> Unidades de Medida <span class="plus"><i class="fa fa-plus"></i></span> </a>
                                                                          <ul>
                                                                            @endif
                                                                            <li> <a href="{{url('unidades_medida')}}"> <span>&nbsp;</span> <i class="fa fa-circle"></i> 
                                                                             @if(str_contains(Route::getCurrentRoute()->getName(),['unidades_medida'])) 
                                                                             <b class="theme_color">Catálogo</b> </a> </li>
                                                                             @else
                                                                             <b>Catálogo</b> </a> </li>
                                                                             @endif
                                                                           </ul>
                                                                         </li>


                                                                       </ul>
                                                                     </div>
                                                                   </div>
                                                                   <!--\\\\\\\left_nav end \\\\\\-->
                                                                   <div class="contentpanel">

                                                                    @yield('contenido')

                                                                    <div class="row col-md-6 col-md-offset-3"  style="height: 1000px;" >

                                                                    </div>

                                                                    <!--\\\\\\\ container  end \\\\\\-->
                                                                  </div>



                                                                  <!--\\\\\\\ content panel end \\\\\\-->
                                                                </div>
                                                                <!--\\\\\\\ inner end\\\\\\-->
                                                              </div>

                                                              {!!Html::script('js/jquery-2.1.0.js')!!}
                                                              {!!Html::script('js/script.js')!!}
                                                              {!!Html::script('js/moment.min.js')!!}
                                                              {!!Html::script('js/jquery-2.1.0.js')!!}
                                                              {!!Html::script('js/bootstrap.min.js')!!}
                                                              {!!Html::script('js/common-script.js')!!}
                                                              {!!Html::script('js/jquery.slimscroll.min.js')!!}
                                                              {!!Html::script('plugins/toggle-switch/toggles.min.js')!!} 
                                                              {!!Html::script('plugins/checkbox/zepto.js')!!}
                                                              {!!Html::script('plugins/checkbox/icheck.js')!!}
                                                              {!!Html::script('js/icheck-init.js')!!}
                                                              {!!Html::script('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')!!} 
                                                              {!!Html::script('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')!!} 
                                                              {!!Html::script('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')!!} 
                                                              {!!Html::script('plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')!!} 
                                                              {!!Html::script('js/form-components.js')!!} 
                                                              {!!Html::script('plugins/input-mask/jquery.inputmask.min.js')!!} 
                                                              {!!Html::script('plugins/input-mask/demo-mask.js')!!} 
                                                              {!!Html::script('plugins/bootstrap-fileupload/bootstrap-fileupload.min.js')!!} 
                                                              {!!Html::script('plugins/dropzone/dropzone.min.js')!!} 
                                                              {!!Html::script('plugins/ckeditor/ckeditor.js')!!}
                                                              {!!Html::script('js/jPushMenu.js')!!} 
                                                              {!!Html::script('plugins/validation/parsley.min.js')!!}
                                                              {!!Html::script('plugins/data-tables/jquery.dataTables.js')!!}
                                                              {!!Html::script('plugins/data-tables/DT_bootstrap.js')!!}
                                                              {!!Html::script('plugins/data-tables/dynamic_table_init.js')!!}
                                                              {!!Html::script('plugins/edit-table/edit-table.js')!!}
                                                              {!!Html::script('plugins/file-uploader/js/vendor/jquery.ui.widget.js')!!}
                                                              {!!Html::script('plugins/file-uploader/js/jquery.iframe-transport.js')!!}
                                                              {!!Html::script('plugins/file-uploader/js/jquery.fileupload.js')!!}
                                                              {!!Html::script('plugins/validation/parsley.min.js')!!}
                                                              {!!Html::script('plugins/select2/dist/js/select2.full.min.js')!!}
                                                              <!-- Include SmartWizard JavaScript source -->
                                                              {!!Html::script('plugins/wizard/js/jquery.smartWizard.js')!!}
                                                              <!-- Include jQuery Validator plugin -->
                                                              {!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js')!!}


                                                              {!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js')!!}
                                                              <script type="text/javascript">
                                                               $(document).on('ready', function()  {

          //Initialize Select2 Elements
          $('.select2').select2()

        })
      </script>

    </body>

    </html>
