<!-- Modal -->
<div class="modal fade" id="modal_agregar_cliente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="frm_agregar_cliente" name="frm_agregar_cliente">
                            <div class="form-group">
                                <label class="control-label">DNI:</label>
                                <input class="form-control" id="txt_dni_cliente" name="txt_dni_cliente" type="text"
                                    placeholder="Enter full name" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nombres:</label>
                                <input class="form-control" id="txt_nombre_cliente" name="txt_nombre_cliente" type="text"
                                    placeholder="Enter full name" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Apellidos:</label>
                                <input class="form-control" id="txt_apellido_cliente" name="txt_apellido_cliente"
                                    type="text" placeholder="Enter full name" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Telefono de Contacto:</label>
                                <input class="form-control" id="txt_telefono_contacto" name="txt_telefono_contacto" type="text"
                                    placeholder="Enter full name" required="">
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