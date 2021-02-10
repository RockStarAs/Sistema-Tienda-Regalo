<?php
header_admin($data); 
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-line-chart" aria-hidden="true"></i> <?= $data["nombre_pagina"];?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>venta/reporte_ventas"><?= $data["nombre_pagina"];?></a></li>
        </ul>
    </div>
    <div class="tile">
        <div class="form-group">
            <button type="button" class="btn btn-primary" id="daterange-btn2">
                <span>
                    <i class="fa fa-calendar"></i>
                    <?= $data["fecha"]; ?>
                </span>
                &nbsp; <i class="fa fa-caret-down"></i>
            </button>
        </div>
        <div class="tile-body">
            <div class="row">
                <div class="col-md-12">
                    <?php obtener_reporte("grafico_ventas",$data) ?>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-6">
                    <?php obtener_reporte("productos-mas-vendidos",$data) ?>
                </div>
                <div class="col-md-6">
                    <?php obtener_reporte("cajeros",$data) ?>
                    <?php obtener_reporte("vendedores",$data) ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <?php obtener_reporte("compradores",$data) ?>
                </div>
            </div>
        </div>
    </div>

</main>
<script>
const fechaInit = <?= '"'.$data["fechaInicial"].'"'?>;
const fechaFin = <?= '"'.$data["fechaFinal"].'"'?>;
</script>
<?php footer_admin($data); ?>