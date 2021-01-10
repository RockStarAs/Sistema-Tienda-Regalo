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
                    href="<?= base_url();?>producto/gestionar_productos"><?= $data["titulo_pagina"];?></a></li>
        </ul>
    </div>
    <!-- Formulario para Añadir compra -->
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Datos de la compra</h3>
            <div class="tile-body">
                <form class="row">
                    <div class="form-group col-md-3">
                        <label class="control-label">Proveedor</label>
                        <select class="form-control" data-live-search="true" id="proveedor_id" name="proveedor_id"
                            required>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Fecha de compra</label>
                        <input class="form-control" type="date" placeholder="Ingrese fecha">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Estado de compra</label>
                        <select class="form-control" data-live-search="true" id="proveedor_id" name="categoria_id"
                            required>
                            <option value="1" selected>Recibida</option>
                            <option value="0">Por recibir</option>
                        </select>
                        <!--<button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Subscribe</button>-->
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Serie de boleta o factura (Opcional)</label>
                        <input class="form-control" type="text" placeholder="Enter your name">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Correlativo(Opcional)</label>
                        <input class="form-control" type="text" placeholder="Enter your name">
                    </div>
                    <div class="form-group col-md-3 align-self-end">
                        <button class="btn btn-info" type="button" onclick="abrir_modal();"><i
                                class="fa fa-fw fa-lg fa-plus-square"></i>Añadir un producto</button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Articulos</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <h4 id="total">$ 0.00</h4>
                                        <input type="hidden" name="total_compra" id="total_compra">
                                    </th>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group col-md-4 align-self-end">
                        <button class="btn btn-success" type="button"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>Registra la compra</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php footer_admin($data); ?>