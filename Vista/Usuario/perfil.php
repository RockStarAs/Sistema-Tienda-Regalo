<?php header_admin($data);
    obtener_modal('modal_cambiar_password',$data);
?>
    <main class="app-content">
      <div class="app-title"> 
        <div>
          <h1><i class="fa fa-dashboard"></i> <?= $data["titulo_pagina"];?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>usuario/perfil"><?= $data["titulo_pagina"];?></a></li>
        </ul>
        
      </div>
      <div class="tab-content">
            <?php $array_datos = $data['data']; ?>
            <div class="tab-pane fade active show" id="user-settings">
              <div class="tile user-settings">
                <h4 class="line-head">Datos del usuario</h4>
                <form>
                    <div class="col-md-5 mb-4">
                      <label>DNI</label>
                      <input class="form-control" type="text" value=<?=$array_datos["dni_trabajador"];?> disabled>
                    </div>
                    <div class="col-md-5 mb-4">
                      <label>Nombre</label>
                      <input class="form-control" type="text" value=<?=$array_datos["nombre_trabajador"];?> disabled >
                    </div>
                    <div class="col-md-5 mb-4">
                      <label>Apellidos</label>
                      <input class="form-control" type="text" value=<?=$array_datos["apellidos_trabajador"];?> disabled>
                    </div>
                    <div class="col-md-5 mb-4">
                      <label>Usuario</label>
                      <input class="form-control" type="text" value=<?=$array_datos["nombre_usuario"];?> disabled>
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-primary" type="button" onclick="abrir_modal();"><i class="fa fa-fw fa-lg fa-check-circle"></i>Cambiar mi contraseña</button>
                    </div>
                  </div>
                
                </form>
              </div>
            </div>
          </div>


    </main>
<?php footer_admin($data); ?>
<script src="<?= media();?>js/funciones_perfil.js"></script>