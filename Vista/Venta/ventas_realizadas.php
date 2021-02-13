<?php header_admin($data);
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> <?= $data["nombre_pagina"];?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>venta/listar_ventas_general">Ventas Realizadas</a></li>
        </ul>
        
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tabla_ventas">
                  <thead>
                    <tr>
                      <th>Id.Venta:</th>
                      <th>Vendedor:</th>
                      <th>Cliente:</th>
                      <th>Fecha:</th>
                      <th>Tipo Vent.:</th>
                      <th>Medio de pago</th>
                      <th>Monto cancelado:</th>
                      <th>Opciones:</th>
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