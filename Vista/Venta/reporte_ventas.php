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
            <div class="row">
                
                <div class="col-md-6 col-xs-12">
                    
                    </div>
    
                    <div class="col-md-6 col-xs-12">
                        
                    </div>
    
                    <div class="col-md-6 col-xs-12">
                       
                    </div>
            </div>
        </div>
    </div>
</main>

<?php footer_admin($data); ?>