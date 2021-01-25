<?php header_admin($data); ?>
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
</main>
<?php footer_admin($data); ?>