<!-- Modal -->
<div class="modal fade" id="modal_form_actualiza_producto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modalHeaderActualizar">
                <h5 class="modal-title" id="titulo_Modal_act">Actualiza Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_actualiza_producto" name="frm_actualiza_producto" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" id="id_producto_act" name="id_producto_act" value="">
                    <input type="hidden" id="foto_actual" name="foto_actual" value="">
                    <input type="hidden" id="foto_remove" name="foto_remove" value="">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Nombre Producto:</label>
                                <input class="form-control" id="txt_nombre_act" name="txt_nombre_act" type="text"
                                    placeholder="Ingrese nombre del producto" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripcion Producto:</label>
                                <textarea class="form-control" name="txt_descripcion_act" id="txt_descripcion_act"
                                    style="resize:none;" rows="4"
                                    placeholder="Descripción del producto (Opcional)"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto">Actualizar Foto </label>
                                <div class="photo" id="actual">    
                                    <div class="prevPhoto prevPhoto1">
                                        <span class="delPhoto delPhoto1 notBlock">X</span>
                                        <label for="foto" id="text1" class="carga">&nbsp;&nbsp;<i class="fa fa-cloud-download" aria-hidden="true"></i>&nbsp;Buscar Foto...</label>
                                        
                                    </div>
                                    <div class="upimg">
                                        <input type="file" name="foto_act" id="foto_act">
                                    </div>
                                    <div id="form_alert_act"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Código</label>
                                <input class="form-control" id="txtCodigo_act" name="txtCodigo_act" type="text"
                                    placeholder="Código de barra">
                                <br>
                            </div>

                            <label class="control-label">Precio de Venta</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">S/.</div>
                                </div>
                                <input class="form-control" id="txt_precio_venta_act" name="txt_precio_venta_act" value="0.00"
                                    data-decimals="2" min="0" step="0.01" type="number" required="" />
                            </div>

                            <label class="control-label">Precio de Compra</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">S/.</div>
                                </div>
                                <input class="form-control" id="txt_precio_compra_act" name="txt_precio_compra_act" value="0.00"
                                    data-decimals="2" min="0" step="0.01" type="number" required="" />
                            </div>

                            <div class="form-group">
                                <label class="control-label">Stock</label>
                                <input class="form-control" required type="number" id="txt_stock_act" name="txt_stock_act" min="0" step="1"/>
                            </div>
                            <div class="form-group">
                                <label for="categoria_id">Categoria del Producto</label>
                                <select class="form-control" data-live-search="true" id="categoria_id_act"
                                    name="categoria_id_act" required>

                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="tile-footer text-center">
                        <button id="btnAccion_Form_act" class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i><span
                                id="btn_Text_act">Agregar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger"
                            href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>