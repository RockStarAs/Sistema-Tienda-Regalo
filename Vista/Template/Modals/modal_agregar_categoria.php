<!-- Modal -->
<div class="modal fade" id="modal_form_agrega_categoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header modalHeaderRegistro">
                <h5 class="modal-title" id="titulo_Modal">Nueva Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="frm_agregar_categoria" name="frm_agregar_categoria">
                            <input type="hidden" id="id_categoria" name="id_categoria">
                            <div class="form-group">
                                <label class="control-label">Nombre Categoria:</label>
                                <input class="form-control" id="txt_nombre" name="txt_nombre" type="text"
                                    placeholder="Ingrese el nombre de la Categoria" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripcion:</label>
                                <textarea class="form-control" name="txt_descripcion" id="txt_descripcion" style= "resize:none;" rows="4" placeholder="Descripción de la categoria (Opcional)"></textarea>
                            </div>

                            <div class="tile-footer">
                                <button id="btnAccion_Form" class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i><span id="btn_Text">Agregar</span></button>&nbsp;&nbsp;&nbsp;<a
                                    class="btn btn-danger" href="#" data-dismiss="modal"><i
                                        class="fa fa-fw fa-lg fa-times-circle" ></i>Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>