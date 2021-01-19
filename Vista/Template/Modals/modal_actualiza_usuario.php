<!-- Modal -->
<div class="modal fade" id="modal_form_actualiza_usuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header modalHeaderActualizar">
        <h5 class="modal-title" id="titulo_modal">Actualizando Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tile">
            <div class="tile-body">
              <form id="frm_actualiza_usuario" name="frm_agregar_usuario">
                <!--ID PARA ACTUALIZAR EL USUARIO -->
                <input type="hidden" id="id_usuario" name="id_usuario">
                <div class="form-group">
                  <label class="control-label">DNI:</label>
                  <input class="form-control" id="txt_dni_act" name="txt_dni_act" type="text" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombres:</label>
                  <input class="form-control" id="txt_nombre_act" name="txt_nombre_act" type="text" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Apellidos:</label>
                  <input class="form-control" id="txt_apellido_act" name="txt_apellido_act" type="text" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombre usuario:</label>
                  <input class="form-control" id="txt_nombre_usuario_act" name="txt_nombre_usuario_act" type="text" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Contraseña:</label>
                  <input class="form-control" id="txt_contraseña_act" name="txt_contraseña_act" type="password" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                    <label for="select_tipo">Rol de Ususario</label>
                    <select class="form-control" id="select_tipo_act" name="select_tipo_act">
                      <option value="CAJERO">CAJERO</option>
                      <option value="ATENCION">ATENCION</option>
                    </select>
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