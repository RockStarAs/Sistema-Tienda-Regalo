<?php
    header_admin($data);
    obtener_modal("modal_listaProducto", $data);
    obtener_modal("modal_agregar_cliente",$data);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> <?= $data["nombre_pagina"];?></h1>
            <p>Agregar venta</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url();?>venta/realizar_venta">Realice una venta</a>
            </li>
        </ul>
    </div>
    <!--Aqui va el formulario -->
    <div class="row">
        <div class="col-md-12 col-sd-12">
            <div class="tile p-md-4">
                <form id="form_venta_mayor" class="frm" name="">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Dni Cliente</label>
                                <select class="form-control selectCliente" data-live-search="true" id="cliente_dni"
                                    name="cliente_dni" onchange="mostar_nombre_cliente()">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nombre cliente</label>
                                <input class="form-control" id="cliente_nombre" name="cliente_nombre" type="text"
                                    value="Público General" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Cambiar a (Sin DNI): </label>
                                <button type="button" class="btn btn-warning" onclick="fnc_cambia_gen()"><i
                                        class="fa fa-fw fa-lg fa-address-card"></i>Público General.</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Agregar nuevo Cliente: </label>
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
                                            <th>Descuento (S/.)</th>
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
                    <div class="row">
                        <div class="col-md-4">
                            <fieldset class="border p-2">
                                <legend class="w-auto">Elije una forma de pago:</legend>
                                <div class="form-group">

                                    <div class="col-md-9">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="pago_efectivo" name="tipo_pago"
                                                class="custom-control-input" value="0" checked>
                                            <label class="custom-control-label" for="pago_efectivo">Pago en
                                                efectivo</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="pago_tarjeta" name="tipo_pago"
                                                class="custom-control-input" value="1">
                                            <label class="custom-control-label" for="pago_tarjeta">Pago con
                                                tarjeta</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="pago_yape" name="tipo_pago"
                                                class="custom-control-input" value="2">
                                            <label class="custom-control-label" for="pago_yape">Pago con YAPE</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div class="col-md-8">
                            <fieldset class="border p-2">
                                <legend class="w-auto">PAGO <span id="lbl_forma_pago">EN EFECTIVO</span></legend>
                                <div class="row">
                                    <div class="col-sm-7">
                                        <label class="control-label" id="lbl_pagar_con">
                                            INGRESE EL MONTO
                                            CON EL QUE CANCELAN:</label>
                                        <div id="pagar_con">
                                            <input type="number" class="form-control" onchange="actualiza_vuelto()"
                                                name="monto_o_id" id="id_voucher_o_total_pago" step="0.1" required>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="col-sm-5" id="div_vuelto">
                                        <label class="control-label" id="lbl_devolucion">DEVOLUCIÓN o
                                            VUELTO:</label>
                                        <div id="devolucion">
                                            <input type="number" class="form-control" name="vuelto" id="vuelto"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

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