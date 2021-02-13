<!-- Modal -->
<div class="modal fade" id="modal_form_actualiza_proveedor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header modalHeaderActualizar">
        <h5 class="modal-title" id="titulo_modal">Nuevo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tile">
            <div class="tile-body">
              <form id="frm_actualiza_proveedor" name="frm_actualiza_proveedor">
                <input type="hidden" name="txt_dni_ruc_cambiar" id="txt_dni_ruc_cambiar" >
                <div class="form-group">
                  <label class="control-label">DNI o RUC:</label>
                  <input class="form-control" id="txt_dni_ruc_act" name="txt_dni_ruc_act" type="text" placeholder="Ingrese DNI o RUC" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombre del Proveedor:</label>
                  <input class="form-control" id="txt_nombre_proveedor_act" name="txt_nombre_proveedor_act" type="text" placeholder="Ingrese nombre" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Teléfono del Proveedor:</label>
                  <input class="form-control" id="txt_telefono_proveedor_act" name="txt_telefono_proveedor_act" type="text" placeholder="Ingrese número de teléfono">
                </div>
                <div class="form-group">
                  <label class="control-label">Email proveedor:</label>
                  <input class="form-control" id="txt_email_proveedor_act" name="txt_email_proveedor_act" type="text" placeholder="Ingrese email">
                </div>
                <div class="form-group">
                  <label class="control-label">Ciudad:</label>
                  <input class="form-control" id="txt_ciudad_proveedor_act" name="txt_ciudad_proveedor_act"type="text" placeholder="Ingrese ciudad">
                </div>
                <div class="form-group">
                  <label class="control-label">Dirección:</label>
                  <input class="form-control" id="txt_direccion_proveedor_act" name="txt_direccion_proveedor_act"type="text" placeholder="Ingrese dirección">
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
