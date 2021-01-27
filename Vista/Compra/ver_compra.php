<?php header_admin($data);
    
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> <?= $data["titulo_pagina"];?></h1>
            <p>Ver detalles de una compra</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>compra/ver_compras">Ver compras realizadas</a></li>
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
                                <input class="form-control" id="nombre_proveedor" name="nombre_proveedor" type="text" placeholder="Ingrese fecha" readonly value="<?= $data['datos_compra']['nombre_proveedor'] ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fecha de compra</label>
                                <input class="form-control" id="fecha_compra" name="fecha_compra" type="date" placeholder="Fecha Regritro" value=<?=$data['datos_compra']['fecha_registro_compra'] ?> readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fecha de entrega</label>
                                <?php 
                                
                                    $tipo =  $data['datos_compra']['fecha_compra_realizada'] == null ? "text":"date"; 
                                    $fecha = $data['datos_compra']['fecha_compra_realizada'] != null ? $data['datos_compra']['fecha_compra_realizada'] : "Sin registro"; 
                                ?> 
                                <input class="form-control" id="fecha_entrega" name="fecha_entrega" type=<?=$tipo?> placeholder="Ingrese fecha" value="<?=$fecha?>" readonly >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Estado de compra</label>
                            <input class="form-control" id="estado_compra" name="estado_compra" type="text" placeholder="Ingrese fecha" value="<?=$data['datos_compra']['estado_compra'] == 1 ? "Recibido" : "No recibido" ?>" readonly >
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Serie y Correlativo</label>
                                <input class="form-control" type="text" id="serie_boleta_factura" name="serie_boleta_factura" placeholder="Enter your name" value="<?=$data['datos_compra']['boleta_factura'] == null ? "No registrado":$data['datos_compra']['boleta_factura']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Documento del proveedor(DNI o RUC) </label>
                                <input class="form-control" type="text" id="correlativo_boleta_factura" name="correlativo_boleta_factura"  placeholder="Enter your name"  value="<?=$data['datos_compra']['ruc_dni']; ?>" readonly >
                            </div>
                        </div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="detalles_compra"
                                    class="table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color:#00635a">
                                        <tr style="color: white;">
                                            <th>Código</th>
                                            <th>Productos</th>
                                            <th>Descrip.</th>
                                            <th>Foto</th>
                                            <th>Cnt. Comp.</th>
                                            <th>Precio Compra</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $datos_detalles = $data['detalles_compra'];?>
                                        <?php  for ($i=0; $i < count($datos_detalles) ; $i++) { ?>
                                            <tr class="fila text-center" id="elementos" value="<?= $datos_detalles[$i]['id_producto'] ?>">
                                                <td>
                                                    <span>#</span>
                                                    <?= $datos_detalles[$i]['id_producto'] ?>
                                                </td>
                                                <td>
                                                    <?= $datos_detalles[$i]['nombre_producto'] ?>
                                                </td>
                                                <td>
                                                    <?= $datos_detalles[$i]['descripcion_producto'] == null ? "Sin desc.":  $datos_detalles[$i]['descripcion_producto']?>
                                                </td>
                                                <td>
                                                    <img id="img" width="50" height="50" src="<?= media().'images/uploads/'.$datos_detalles[$i]['imagen_producto'] ?>">
                                                </td>
                                                <td>
                                                <?= $datos_detalles[$i]['cantidad_producto'] ?>
                                                </td>
                                                <td>
                                                <span>S/.</span>
                                                <?= round($datos_detalles[$i]['precio_compra'],1) ?>
                                                </td>
                                                <td>
                                                <span>S/.</span>
                                                <span name="subtotal">
                                                <?= round($datos_detalles[$i]['precio_compra'],1) ?>
                                                </span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
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
                        </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-success" href="<?= base_url(). 'compra/ver_compras' ?>"
                        ><i class="fa fa-fw fa-lg fa-check-circle"></i>Volver al listado</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>
<?php footer_admin($data); ?>