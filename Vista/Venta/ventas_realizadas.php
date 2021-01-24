<?php header_admin($data);
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> <?= $data["titulo_pagina"];?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>usuario/gestionar_usuarios"><?= $data["titulo_pagina"];?></a></li>
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
                      <th>ID VENTA:</th>
                      <th>REALIZADA POR:</th>
                      <th>CLIENTE:</th>
                      <th>FECHA:</th>
                      <th>TIPO VENTA:</th>
                      <th>TOTAL PAGADO:</th>
                      <th>OPCIONES:</th>
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