<?php 
    class Controladores{
        public function __construct(){
            $this->carga_modelo();
            $this->vistas = new Vistas();
        }
        public function carga_modelo(){
            //Home Modelo
            $modelo = get_class($this)."_modelo";
            $clase_ruta = "Modelos/".$modelo.".php";
            if(file_exists($clase_ruta)){
                require_once($clase_ruta);
                $this->modelo = new $modelo();
            }
        }
    }

?>