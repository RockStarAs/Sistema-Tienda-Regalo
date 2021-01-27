<?php
    header_admin($data);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> <?= $data["nombre_pagina"];?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>venta/realizar_venta"><?= $data["nombre_pagina"];?></a>
            </li>
        </ul>
    </div>
    <!--Aqui va el formulario -->
    <div class="card-deck">
        <div class="card text-center">
            <img class="card-img-top" src="<?= media();?>images/venta1.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><i class="app-menu__icon fa fa-shopping-basket"></i>Realizar una venta normal</h5>
                <a href="<?= base_url();?>venta/venta_normal" class="btn btn-primary">Realizar</a>
            </div>
            <!-- <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div> -->
        </div>
        <div class="card text-center">
            <img class="card-img-top" src="<?= media();?>images/venta0.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    Realizar una venta al por mayor</h5>
                <a href="<?= base_url();?>venta/venta_mayor" class="btn btn-primary">Realizar</a>
            </div>
            <!-- <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div> -->
        </div>

    </div>

</main>

<?php footer_admin($data); ?>