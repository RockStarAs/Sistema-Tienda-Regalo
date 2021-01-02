 <!-- Modal -->
<div class="modal fade" id="modal_form_cambiar_contraseña" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header header_registro">
        <h5 class="modal-title" id="titulo_modal">Cambiando Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tile">
            <div class="tile-body">
              <form id="frm_cambia_password" name="frm_agregar_usuario">
                <input type="hidden" id="id_usuario" name="id_usuario">
                <!--ID PARA ACTUALIZAR EL USUARIO -->
                <div class="form-group">
                  <label class="control-label">Ingrese su contraseña:</label>
                  <input class="form-control" id="txt_password_antigua" name="txt_password_antigua" type="passsword" placeholder="Contraseña actual" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Ingrese su nueva contraseña:</label>
                  <input class="form-control" id="txt_password_nueva" name="txt_password_nueva" type="text" placeholder="Nueva contraseña" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Repita su nueva contraseña:</label>
                  <input class="form-control" id="txt_password_nueva_rep" name="txt_password_nueva_rep" type="text" placeholder="Repita su nueva contraseña" required="">
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
                </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>