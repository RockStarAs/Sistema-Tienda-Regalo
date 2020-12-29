<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= media();?>images/icon.png" type="image/x-icon">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media();?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>css/style.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Inicio de sesión</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Sistema Tienda</h1>
      </div>
      <div class="login-box">
        <form class="login-form" name="formulario_login" id="formulario_login" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Iniciar Sesión</h3>
          <div class="form-group">
            <label class="control-label">Usuario</label>
            <input class="form-control" type="text" placeholder="Usuario"  id="usuario_id" name="usuario_id" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Contraseña</label>
            <input class="form-control" type="password" id="usuario_password" name="usuario_password" placeholder="Contraseña">
          </div>
          <!--
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div>
        -->
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Acceder</button>
          </div>
        </form>
        <!--
        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
    -->
    </section>
    <!-- Essential javascripts for application to work-->
    <script>
        const base_url = "<?= base_url();?>";
    </script>
    <script src="<?= media();?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= media();?>js/popper.min.js"></script>
    <script src="<?= media();?>js/bootstrap.min.js"></script>
    <script src="<?= media();?>js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script type="text/javascript" src="<?= media();?>js/plugins/sweetalert.min.js"></script>
    <script src="<?= media();?>js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media();?>js/<?=$data['nombre_funciones_pag']; ?> "></script>
  </body>
</html>