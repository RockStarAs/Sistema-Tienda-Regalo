<?php 
    header_admin($data); 
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="app-menu__icon fa fa-usd"></i> <?= $data["nombre_pagina"];?></h1>
            <br>
            <a class="btn btn-primary" href="<?= base_url();?>venta/listar_ventas_general"> <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </i>Regresar</a>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>venta/listar_ventas_general">Ventas Realizadas</a></li>
        </ul>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tabla_ventas">
                            <thead>
                                <tr>
                                    <th>ID Venta</th>
                                    <th>Fecha</th>
                                    <th>Cajero</th>
                                    <th>Cliente</th>
                                    <th>Total Venta</th>
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
</main>
<script>
    const tipo=<?= $data["tipo"];?>;
</script>
<?php footer_admin($data); ?>