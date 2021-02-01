<?php 
    header_admin($data); 
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="app-menu__icon fa fa-usd"></i> <?= $data["titulo_pagina"];?></h1>
            <br>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url();?>venta/listar_ventas_general">Ventas Realizadas</a></li>
        </ul>
        
    </div>
    <?php 
        if ($data['status'] == false ){
            ?>
            <div class="card mb-3 text-white bg-danger">
                <div class="card-body">
                  <blockquote class="card-blockquote">
                    <p><?= $data["msg"]; ?></p>
                    
                  </blockquote>
                </div>
              </div>

              <div class="bs-component">
              <div class="alert alert-dismissible alert-danger">
              <label for="">TOTAL GENERADO EN VENTAS HOY ES  S/. <?= $data['TOTAL_PAGADO'] ?></label>
              </div>
            </div>
            <?php
        }else{
    ?>
    <div class="bs-component">
              <div class="alert alert-dismissible alert-success">
              <label for="">TOTAL GENERADO EN VENTAS HOY ES  S/. <?= $data['TOTAL_PAGADO']['TOTAL_VENTA'] ?></label>
              </div>
            </div>
    <?php  } ?>
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