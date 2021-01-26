<?php 
header_admin($data);    
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> <?= $data["nombre_pagina"];?></h1>
            <p>Ver detalles de una venta</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>producto/gestionar_productos"><?= $data["nombre_pagina"];?></a></li>
        </ul>
    </div>
    <?php 
        if($data["ESTADO_VENTA"] == 0){
            
        
    ?>
    <div class="card mb-3 text-white bg-danger">
                <div class="card-body">
                  <blockquote class="card-blockquote">
                    <p>Esta venta fue eliminada.</p>
                    <footer>La venta que se muestra ha sido eliminada por lo cual no se contará como ganancia, la cantidad vendida en esta venta fue respuesta en el stock de los productos que fueron listados.
                    </footer>
                  </blockquote>
                </div>
    </div>
    <?php }?>
    <!--Aqui va el formulario -->
    <div class="row">
        <div class="col-md-12 col-sd-12">
            <div class="tile p-md-4">
                <form id="formulario_agregar_compra_detalles" class="frm" name="">
                <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Dni Cliente</label>
                                <input type="text" value=<?=$data['DNI']["dni_cliente"]; ?> readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nombre cliente</label>
                                <input type="text" value=<?='"'.$data["NOMBRE_CLIENTE"].'"'; ?>' >
                            </div>
                        </div>
                        <?php 
                            $fecha = $data['FECHA_VENTA'];
                            $fecha_venta2 = date_create("$fecha");
                            $tipo_venta = $data['TIPO_VENTA'] == 1 ? "NORMAL":"AL POR MAYOR" 
                        ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fecha Realizada</label>
                                <input type="text" value=<?='"'.date_format($fecha_venta2,"d/m/Y H:i A").'"'; ?>' readonly >
                            </div>
                        </div>
                        <div class="col-md-3" >
                            <div class="form-group">
                                <label class="control-label">Realizada por: </label>
                                <input type="text" value=<?='"'.$data["NOMBRE_CAJERO"].'"'; ?>' readonly>
                            </div> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">ID de la venta</label>
                                <input type="text" value=<?=$data['ID_VENTA']; ?> readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tipo de venta</label>
                                <input type="text" value=<?='"'. $tipo_venta . '"'; ?> readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">TOTAL PAGADO (S/.)</label>
                                <input type="text" value=<?=round($data['TOTAL_PAGADO'],2); ?> readonly>
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
                                            <th>Desc.</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $datos_detalles = $data['detalles_venta'];?>
                                        <?php  for ($i=0; $i < count($datos_detalles) ; $i++) { ?>
                                            <tr class="fila text-center" id="elementos" value="<?= $datos_detalles[$i]['CODIGO_PRODUCTO'] ?>">
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
                                                <?= $datos_detalles[$i]['cantidad'] ?>
                                                </td>
                                                <td>
                                                <span>S/.</span>
                                                <?= round($datos_detalles[$i]['precio_venta'],2) ?>
                                                </td>
                                                <td>
                                                <span>S/.</span>
                                                <?= round($datos_detalles[$i]['descuento'],2)?>
                                                </td>
                                                <td>
                                                <span>S/.</span>
                                                <span name="subtotal">
                                                <?= round(($datos_detalles[$i]['precio_venta'] * $datos_detalles[$i]['cantidad']) - $datos_detalles[$i]['descuento'],2) ?>
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
                                        <th></th>
                                        <th>
                                            <h4 id="total"><span>S/.</span><?=round($data['TOTAL_PAGADO'],2);?> </h4>
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
                        </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-success" href="<?= base_url(). 'venta/listar_ventas_general' ?>"
                        ><i class="fa fa-fw fa-lg fa-check-circle"></i>Volver al listado</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main> 
<?php footer_admin($data); ?>