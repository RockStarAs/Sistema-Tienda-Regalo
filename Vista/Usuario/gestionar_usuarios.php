<?php header_admin($data); 
      obtener_modal('modal_agregar_usuario',$data);
      obtener_modal('modal_actualiza_usuario',$data);
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> <?= $data["titulo_pagina"];?></h1>
          <p>Registrar nuevo usuario</p>
          <button class="btn btn-primary" type="button" onclick="abrir_modal();"> <i class="fa fa-plus-square" aria-hidden="true"></i>Añadir</button>
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
                <table class="table table-hover table-bordered" id="tabla_usuarios">
                  <thead>
                    <tr>
                      <th>DNI</th>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Username</th>
                      <th>Rol</th>
                      <th>Estado</th>
                      <th>Fecha y Hora Creacion</th>
                      <th>Fecha y Hora Ult. Con.</th>
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
<script src="<?= media();?>js/funciones_admin.js"></script>
