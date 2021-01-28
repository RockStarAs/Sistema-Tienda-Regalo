<?php 
    class Logout {
        public function __construct(){
            session_start();
            //Falta agregar al usuario su última conexión 
            require_once('usuario.php');
            $usuario = new Usuario();
            $fecha = date("Y-m-d H:i:s");
            $usuario->desconecta($fecha,$_SESSION['id_usuario']);

            session_unset();
            session_destroy();
            header('location: '.base_url().'login');
        }
    }
?>