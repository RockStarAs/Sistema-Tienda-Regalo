<?php
    require_once("combo.php");
    class detalle_combo extends Controladores{
        function __construct(){
            parent::__construct();
        }

        public function insertar_detalle_combo(){
            $data = $this->modelo->modelo_insertar_detalle_combo(2,1,5,6);
            $this->vistas->obten_vista(new Combo(),"ver_combo",$data);
        }

        public function modificar_detalle_combo(){
            $data = $this->modelo->modelo_actualizar_detalle_combo(2,1,10,6);
            $this->vistas->obten_vista(new Combo(),"ver_combo",$data);
        }

        public function listar_detalle_combos(){
            $data = $this->modelo->modelo_listar_detalle_combos();
            $this->vistas->obten_vista(new Combo(),"ver_combo",$data);
        }
        
        public function busca_detalle_combo_id(){
            $data = $this->modelo->modelo_busca_detalle_combo_id(1,2);
            $this->vistas->obten_vista(new Combo(),"ver_combo",$data);
        }

        public function eliminar_detalle_combo_id(){
            $data = $this->modelo->modelo_elimina_detalle_combo(1,2);
            $this->vistas->obten_vista(new Combo(),"ver_combo",$data);
        }
    }
?>