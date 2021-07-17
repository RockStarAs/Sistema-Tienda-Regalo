<!-- Modal -->
<div class="modal fade" id="modal_actualiza_cliente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header modalHeaderActualizar">
                <h5 class="modal-title" id="exampleModalCenterTitle">Actualizar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="frm_actualiza_cliente" name="frm_actualiza_cliente">
                            <input type="hidden" name="txt_dni_antiguo_act" id="txt_dni_antiguo_act" value="">
                            <div class="form-group">
                                <label class="control-label">DNI:</label>
                                <input class="form-control" id="txt_dni_cliente_act" name="txt_dni_cliente_act" disabled type="text"
                                    placeholder="Ingrese DNI" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nombres:</label>
                                <input class="form-control" id="txt_nombre_cliente_act" name="txt_nombre_cliente_act" type="text"
                                    placeholder="Ingrese nombre" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Apellidos:</label>
                                <input class="form-control" id="txt_apellido_cliente_act" name="txt_apellido_cliente_act"
                                    type="text" placeholder="Ingrese apellidos" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Teléfono de Contacto:</label>
                                <input class="form-control" id="txt_telefono_contacto_act" name="txt_telefono_contacto_act" type="text"
                                    placeholder="Nro de teléfono" required="">
                            </div>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Agregar</button>&nbsp;&nbsp;&nbsp;<a
                                    class="btn btn-danger" href="#" data-dismiss="modal"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>