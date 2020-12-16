<!-- Modal -->
<div class="modal fade" id="modal_form_agrega_proveedor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header header_registro">
        <h5 class="modal-title" id="titulo_modal">Nuevo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tile">
            <div class="tile-body">
              <form id="frm_agregar_proveedor" name="frm_agregar_proveedor">
                <div class="form-group">
                  <label class="control-label">DNI o RUC:</label>
                  <input class="form-control" id="txt_dni_ruc" name="txt_dni_ruc" type="text" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombre del Proveedor:</label>
                  <input class="form-control" id="txt_nombre_proveedor" name="txt_nombre_proveedor" type="text" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Telefono del Proveedor:</label>
                  <input class="form-control" id="txt_telefono_proveedor" name="txt_telefono_proveedor" type="text" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Email proveedor:</label>
                  <input class="form-control" id="txt_email_proveedor" name="txt_email_proveedor" type="text" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Ciudad:</label>
                  <input class="form-control" id="txt_ciudad_proveedor" name="txt_ciudad_proveedor"type="text" placeholder="Enter full name" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Dirección:</label>
                  <input class="form-control" id="txt_direccion_proveedor" name="txt_direccion_proveedor"type="text" placeholder="Enter full name" required="">
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