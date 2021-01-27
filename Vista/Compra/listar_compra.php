<?php header_admin($data); 
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> <?= $data["titulo_pagina"];?></h1>
            <p>Ver compras realizadas</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>compra/ver_compras"><?= $data["titulo_pagina"];?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tabla_compras">
                            <thead>
                                <tr>
                                    <th>Documento del Proveedor</th>
                                    <th>Proveedor</th>
                                    <th>Fecha de la compra </th>
                                    <th>Estado de la compra</th>
                                    <th>Serie y Correlativo</th>
                                    <th>Opciones</th>
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
<?php footer_admin($data); ?>