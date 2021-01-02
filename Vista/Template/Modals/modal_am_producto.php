<!-- Modal -->
<div class="modal fade" id="modal_form_agrega_producto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modalHeaderRegistro">
                <h5 class="modal-title" id="titulo_Modal">Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_agregar_producto" name="frm_agregar_producto" class="form-horizontal"
                    enctype="multipart/form-data">
                    <input type="hidden" id="id_producto" name="id_producto" value="">
                    <input type="hidden" id="foto_actual" name="foto_actual" value="">
                    <input type="hidden" id="foto_remove" name="foto_remove" value="">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Nombre Producto:</label>
                                <input class="form-control" id="txt_nombre" name="txt_nombre" type="text"
                                    placeholder="Ingrese nombre del producto" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripcion Producto:</label>
                                <textarea class="form-control" name="txt_descripcion" id="txt_descripcion"
                                    style="resize:none;" rows="4"
                                    placeholder="Descripción del producto (Opcional)"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto">Agregar Foto </label>
                                <div class="photo">
                                    <div class="prevPhoto">
                                        <span class="delPhoto notBlock">X</span>
                                        <label for="foto" id="text">&nbsp;&nbsp;<i class="fa fa-cloud-download"
                                                aria-hidden="true"></i>&nbsp;Buscar Foto...</label>
                                    </div>
                                    <div class="upimg">
                                        <input type="file" name="foto" id="foto">
                                    </div>
                                    <div id="form_alert"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Código</label>
                                <input class="form-control" id="txtCodigo" name="txtCodigo" type="text"
                                    placeholder="Código de barra">
                                <br>
                            </div>

                            <label class="control-label">Precio de Venta</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">S/.</div>
                                </div>
                                <input class="form-control" id="txt_precio_venta" name="txt_precio_venta" value="0.00"
                                    data-decimals="2" min="0" step="0.01" type="number" required="" />
                            </div>

                            <label class="control-label">Precio de Compra</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">S/.</div>
                                </div>
                                <input class="form-control" id="txt_precio_compra" name="txt_precio_compra" value="0.00"
                                    data-decimals="2" min="0" step="0.01" type="number" required="" />
                            </div>

                            <div class="form-group">
                                <label class="control-label">Stock</label>
                                <input class="form-control" type="number" value="0" id="txt_stock" name="txt_stock"
                                    min="0" required="" />
                            </div>
                            <div class="form-group">
                                <label for="categoria_id">Categoria del Producto</label>
                                <select class="form-control" data-live-search="true" id="categoria_id"
                                    name="categoria_id" required>

                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="tile-footer text-center">
                        <button id="btnAccion_Form" class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i><span
                                id="btn_Text">Agregar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger"
                            href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>