<!-- Modal -->
<div class="modal fade" id="modal_form_agrega_usuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header modalHeaderRegistro">
        <h5 class="modal-title" id="titulo_modal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tile">
            <div class="tile-body">
              <form id="frm_agregar_usuario" name="frm_agregar_usuario">
                <div class="form-group">
                  <label class="control-label">DNI:</label>
                  <input class="form-control" id="txt_dni" name="txt_dni" type="text" placeholder="Ingrese DNI" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombres:</label>
                  <input class="form-control" id="txt_nombre" name="txt_nombre" type="text" placeholder="Ingrese nombre" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Apellidos:</label>
                  <input class="form-control" id="txt_apellido" name="txt_apellido" type="text" placeholder="Ingrese apellidos" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombre usuario:</label>
                  <input class="form-control" id="txt_nombre_usuario" name="txt_nombre_usuario" type="text" placeholder="Ingrese nombre de usuario" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Contraseña:</label>
                  <input class="form-control" id="txt_contraseña" name="txt_contraseña"type="text" placeholder="Ingrese contraseña" required="">
                </div>
                <div class="form-group">
                    <label for="select_tipo">Rol de Ususario</label>
                    <select class="form-control" id="select_tipo" name="select_tipo">
                      <option value="CAJERO">CAJERO</option>
                      <option value="ATENCION">ATENCION</option>
                    </select>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Agregar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
                </form>
                
            </div>
            
          </div>
      </div>
    </div>
  </div>
</div>