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
        <!-- <div class="col-xl-3">
            <div class="small-box bg-success color">
                <div class="inner">
                    <h3>12</h3>
                    <p>Categorías</p>
                </div>
                <div class="icon">
                  <i class="fa fa-clipboard" aria-hidden="true"></i>
                </div>

                <a href="<?php base_url();?>categoria/gestionar_categorias" class="small-box-footer">
                    Más info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="small-box bg-danger color">
                <div class="inner">
                    <h3>22</h3>
                    <p>Productos</p>
                </div>
                <div class="icon">
                  <i class="fa fa-gift" aria-hidden="true"></i>
                </div>
                <a href="<?php base_url();?>producto/gestionar_productos" class="small-box-footer">
                    Más info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="small-box bg-warning color">
                <div class="inner">
                    <h3>12</h3>
                    <p>Clientes</p>
                </div>

                <div class="icon">
                  <i class="fa fa-user" aria-hidden="true"></i>
                </div>

                <a href="<?php base_url();?>cliente/gestionar_clientes" class="small-box-footer">
                    Más info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="small-box bg-warning color">
                <div class="inner">
                    <h3>12</h3>
                    <p>Proveedores</p>
                </div>

                <div class="icon">
                    <i class="fa fa-truck" aria-hidden="true"></i>
                </div>

                <a href="<?php base_url();?>proveedor/gestionar_proveedores" class="small-box-footer">
                    Más info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        
    </div>

    <div class="row">
    <div class="col-lg-6 col-xl-6">
            <div class="small-box bg-primary color">
                <div class="inner">
                    <h3>S/.52521516</h3>
                    <p>Ventas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-usd" aria-hidden="true"></i>
                </div>
                <a href="<?php base_url();?>venta/ventas_realizadas" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <div class="col-lg-6 col-xl-6">
            <div class="small-box bg-primary color">
                <div class="inner">
                    <h3>S/.52521516</h3>
                    <p>Ventas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-usd" aria-hidden="true"></i>
                </div>
                <a href="<?php base_url();?>venta/ventas_realizadas" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div> -->
</main>
<?php footer_admin($data); ?>