<!-- Modal -->
<div class="modal fade" id="modal_form_agrega_producto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="frm_agregar_producto" name="frm_agregar_producto">
                            <div class="form-group">
                                <label class="control-label">Nombres:</label>
                                <input class="form-control" id="txt_nombre" name="txt_nombre" type="text"
                                    placeholder="Enter full name" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Apellidos:</label>
                                <input class="form-control" id="txt_apellido" name="txt_apellido" type="text"
                                    placeholder="Enter full name" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nombre producto:</label>
                                <input class="form-control" id="txt_nombre_producto" name="txt_nombre_producto"
                                    type="text" placeholder="Enter full name" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contraseña:</label>
                                <input class="form-control" id="txt_contraseña" name="txt_contraseña" type="text"
                                    placeholder="Enter full name" required="">
                            </div>
                            <div class="form-group">
                                <label for="categoria_id">Rol de Ususario</label>
                                <select class="form-control" data-live-search="true" id="categoria_id" name="categoria_id" required>
                                    
                                </select>
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