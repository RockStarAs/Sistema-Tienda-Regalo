<?php
    header_admin($data);
    obtener_modal("modal_listaProducto", $data);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> <?= $data["nombre_pagina"];?></h1>
            <p>Agregar venta</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url();?>venta/venta_mayor"><?= $data["nombre_pagina"];?></a>
            </li>
        </ul>
    </div>
    <!--Aqui va el formulario -->
    <div class="row">
        <div class="col-md-12 col-sd-12">
            <div class="tile p-md-4">
                <form id="form_venta_mayor" class="frm" name="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Dni Cliente</label>
                                <select class="form-control" data-live-search="true" id="cliente_dni" name="cliente_dni"
                                    onchange="mostar_nombre_cliente()">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nombre cliente</label>
                                <input class="form-control" id="cliente_nombre" name="cliente_nombre" type="text"
                                    value="Público General" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <a data-toggle="modal" href="#myModal">
                                    <button class="btn btn-info" type="button" onclick="abrir_modal_cliente();"><i
                                            class="fa fa-fw fa-lg fa-plus-square"></i>Añadir cliente</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Vendedor</label>
                                <select class="form-control" data-live-search="true" id="id_vendedor"
                                    name="id_vendedor">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Fecha de venta</label>
                                <input class="form-control" id="fecha_venta" name="fecha_venta" type="date"
                                    placeholder="Ingrese fecha" readonly>
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
                                <table id="detalles_venta"
                                    class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color:#00635a">
                                        <tr style="color: white;">
                                            <th>Opciones</th>
                                            <th>Productos</th>
                                            <th>Cantidad</th>
                                            <th>Precio Venta (S/.)</th>
                                            <th>Descuento (%)</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <h4 id="total">S/. 0.00</h4>
                                            <input type="hidden" name="total_venta" id="total_venta">
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