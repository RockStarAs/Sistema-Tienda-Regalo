<?php
class Conexion{    
    //Servidor de la base de datos
    private $nombre_servidor = "servbd.database.windows.net";
    private $opciones_conexion = array(
        "Database" => "bd_tienda_v2", // update me
        "Uid" => "abel", // update me
        "PWD" => "cien100%" // update me
    );
    private $conexion;

    public function __construct(){
        $this->conexion  = sqlsrv_connect($this->nombre_servidor,$this->opciones_conexion);
    }
    
    public function obtener_usuario($usuario,$contraseña){
        $consulta = "select * from usuario where usuario = '$usuario' AND contraseña = '$contraseña'";
        $resultado= sqlsrv_query($this->conexion, $consulta);

        while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
            
        }

    }
}