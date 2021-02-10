<?php header_admin($data); ?>
<?php 
    $bandera = $_SESSION['rol_usuario'] == "ADMINISTRADOR" ? true:false;
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> <?= $data["titulo_pagina"];?></h1>
            <p>Panel de control</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?php base_url();?>dashboard"><?= $data["titulo_pagina"];?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="small-box bg-success color">
                <div class="inner">
                    <h3>Venta Productos</h3>
                    <p>Ventas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-gift" aria-hidden="true"></i>
                </div>

                <a href="<?php base_url();?>venta/realizar_venta" class="small-box-footer">
                    Añadir venta <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-6">
            <div class="small-box bg-danger color">
                <div class="inner">
                    <h3>Agregar Clientes</h3>
                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-address-book-o" aria-hidden="true"></i>
                </div>
                <a href="<?php base_url();?>cliente/gestionar_clientes" class="small-box-footer">
                    Añadir cliente <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <dviv class="row">
        <div class="col-md-<?= $bandera ? '6' : '12';?>">
            <div class="tile">
                <h3 class="tile-title">Últimas ventas realizadas por el usuario</h3>
                <div class="tile-body">
                    <div class="table-responsive" style="height: 400px">
                        <table class="table table-hover table-bordered" id="tabla_ventas">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Tipo de venta</th>
                                    <th>Total de venta</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php if($bandera){ ?>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Ventas Realizadas Hoy (<?= date("d-m-Y") ?>)</h3>
                <div class="tile-body">
                <div class="table-responsive" style="height: 400px">
                        <table class="table table-hover table-bordered" id="tabla_ventas_hoy">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Hora</th>
                                    <th>Cajero</th>
                                    <th>Tipo de venta</th>
                                    <th>Total de venta</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </dviv>
</main>
<?php footer_admin($data); ?>