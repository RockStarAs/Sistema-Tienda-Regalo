<?php header_admin($data); 
    obtener_modal('modal_agregar_categoria',$data);
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> <?= $data["titulo_pagina"];?></h1>
            <p>Registrar nueva categoria</p>
            <button class="btn btn-primary" type="button" onclick="abrir_modal();"> <i class="fa fa-plus-square"
                    aria-hidden="true"></i>Añadir</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>categoria/gestionar_categorias"><?= $data["titulo_pagina"];?></a></li>
        </ul>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tabla_categorias">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
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