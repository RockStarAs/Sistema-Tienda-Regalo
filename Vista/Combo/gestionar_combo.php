<?php header_admin($data); 
    obtener_modal('modal_listaProducto',$data);
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-clipboard" aria-hidden="true"></i> <?= $data["titulo_pagina"];?></h1>
            <p>Registrar nuevo combo</p>
            <button class="btn btn-primary boton" type="button" onclick="abrir_form();"> <i class="fa fa-plus-square"
                    aria-hidden="true"></i>Añadir</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>combo/gestionar_combo"><?= $data["titulo_pagina"];?></a></li>
        </ul>

    </div>
    <div class="row dataTable_combo">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tabla_combos">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row frm_combo" style="display: none;">
        <div class="col-md-12 col-sd-12">
            <div class="tile p-md-4">
                <form id="frm_agregar_combo" class="frm" name="frm_agregar_combo">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nombre Combo:</label>
                                <input class="form-control" id="txt_nombre" name="txt_nombre" type="text"
                                    placeholder="Ingrese el nombre del Combo" required="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Stock</label>
                                <input class="form-control" type="number" value="0" id="txt_stock" name="txt_stock"
                                    min="0" required="" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Precio de Venta</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">S/.</div>
                                </div>
                                <input class="form-control" id="txt_precio_venta" name="txt_precio_venta" value="0.00"
                                    data-decimals="2" min="0" step="0.01" type="number" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Descripcion:</label>
                                <textarea class="form-control" name="txt_descripcion" id="txt_descripcion"
                                    style="resize:none;" rows="4"
                                    placeholder="Descripción de la categoria (Opcional)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="btnAgregarArt" type="button" onclick="abrir_modal();" class="btn btn-primary">
                                        <span class="fa fa-plus"></span>
                                        Agregar Productos
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#00635a">
                                    <tr style="color: white;">
                                        <th>Opciones</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Venta</th>
                                    </tr>
                                </thead>
                                <!-- <tfoot>
                                    <tr>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <h4 id="total">0</h4>
                                            <input type="hidden" name="total_compra" id="total_compra" value="">
                                        </th>
                                    </tr>
                                </tfoot> -->
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