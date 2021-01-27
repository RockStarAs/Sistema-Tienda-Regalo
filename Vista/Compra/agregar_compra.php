<?php header_admin($data);
    obtener_modal("modal_agregar_detalle_compra",$data);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> <?= $data["titulo_pagina"];?></h1>
            <p>Añadir una compra</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>compra/agregar_compra"><?= $data["titulo_pagina"];?></a></li>
        </ul>
    </div>
    <!--Aqui va el formulario -->
    <div class="row">
        <div class="col-md-12 col-sd-12">
            <div class="tile p-md-4">
                <form id="formulario_agregar_compra_detalles" class="frm" name="">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Proveedor</label>
                                <select class="form-control" data-live-search="true" id="proveedor_id"
                                    name="proveedor_id" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fecha de compra</label>
                                <input class="form-control" id="fecha_compra" name="fecha_compra" type="date" placeholder="Ingrese fecha" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fecha de entrega(Opcional)</label>
                                <input class="form-control" id="fecha_entrega" name="fecha_entrega" type="date" placeholder="Ingrese fecha">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Estado de compra</label>
                            <select class="form-control" data-live-search="true" id="estado_compra" name="estado_compra" name="estado_compra"
                                required>
                                <option value="1" selected>Recibida</option>
                                <option value="0">Por recibir</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Serie de boleta o factura (Opcional)</label>
                                <input class="form-control" type="text" id="serie_boleta_factura" name="serie_boleta_factura" placeholder="Ingrese serie (opcional)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Correlativo(Opcional)</label>
                                <input class="form-control" type="text" id="correlativo_boleta_factura" name="correlativo_boleta_factura"  placeholder="Ingrese correlativo (opcional)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <a data-toggle="modal" href="#myModal">
                                    <button class="btn btn-info" type="button" onclick="abrir_modal();"><i
                                            class="fa fa-fw fa-lg fa-plus-square"></i>Añadir un producto</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="detalles_compra"
                                    class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color:#00635a">
                                        <tr style="color: white;">
                                            <th>Opciones</th>
                                            <th>Productos</th>
                                            <th>Cantidad</th>
                                            <th>Precio Compra</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <h4 id="total">S/. 0.00</h4>
                                            <input type="hidden" name="total_compra" id="total_compra">
                                        </th>
                                    </tfoot>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer text-center">
                        <button id="btnAccion_Form" class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i><span
                                id="btn_Text">Agregar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href=""
                            onclick="cerrar_form()"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>

<?php footer_admin($data); ?>