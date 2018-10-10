<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-reactivar">
  <div class="modal-dialog">
    <div class="modal-content panel default blue_border horizontal_border_1">
      <div class="modal-body"> 
        <div class="row">
          <div class="block-web">
            <div class="header">
              <h3 class="content-header theme_color">&nbsp;Reactivar Empleado</h3>
            </div>
            <div class="porlets-content" style="margin-bottom: -50px;">
            <h4>El empleado que intentas registrar ya se encuentra en el sistema pero se encuentra <strong>Inactivo</strong> ¿Deseas Reactivarlo?</h4>

            </div><!--/porlets-content--> 
          </div><!--/block-web--> 
        </div>
      </section>
    </div>
    <div class="modal-footer" style="margin-top: -10px;">
      <div class="row col-md-5 col-md-offset-7" style="margin-top: -5px;">
        <form action="{{ url('activarEmpleado') }}" method="POST"> 
         {{csrf_field()}}

         <input  name="idEmpleado" id="idEmpleadoModal" type="hidden"  />
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         <button type="submit" class="btn btn-primary">Aceptar</button>
       </form>
     </div>
   </div>
 </div><!--/modal-content--> 
</div><!--/modal-dialog--> 
</div><!--/modal-fade--> 



