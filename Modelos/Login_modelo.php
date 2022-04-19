<?php

class login_modelo extends conexion_bd{
    public function __construct(){
        parent::__construct();
    }
    public function modelo_loguea_usuario($usuario,$contraseña){
        //Luego actualizar por el status (FALTA)
        $sql = "SELECT * FROM usuario WHERE nombre_usuario = '$usuario' AND password_usuario = '$contraseña'";
        $solicitud = $this->select_one($sql);
        return $solicitud;
    }
}

?>
