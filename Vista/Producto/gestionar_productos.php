<?php header_admin($data); 
      obtener_modal('modal_am_producto',$data);
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> <?= $data["titulo_pagina"];?></h1>
            <p>Registrar nuevo producto</p>
            <button class="btn btn-primary" type="button" onclick="abrir_modal();"> <i class="fa fa-plus-square"
                    aria-hidden="true"></i>Añadir</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>producto/gestionar_productos"><?= $data["titulo_pagina"];?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tabla_productos1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>Precio Venta</th>
                                    <th>Precio Por Mayor</th>
                                    <th>Precio Compra</th>
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
<?php footer_admin($data); ?>