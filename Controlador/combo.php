<?php
    class Combo extends Controladores{
        function __construct(){
            parent::__construct();
        }

        public function insertar_combo(){
            $data = $this->modelo->modelo_insertar_combo("Combo 3","",18.30,6);
            $this->vistas->obten_vista($this,"ver_combo",$data);
        }

        public function modificar_combo(){
            $data = $this->modelo->modelo_actualizar_combo("1","Combo X","",11,1);
            $this->vistas->obten_vista($this,"ver_combo",$data);
        }

        public function listar_combos(){
            $data = $this->modelo->modelo_listar_combos();
            $this->vistas->obten_vista($this,"ver_combo",$data);
        }
        
        public function busca_combo_id(){
            $data = $this->modelo->modelo_busca_combo_id(2);
            $this->vistas->obten_vista($this,"ver_combo",$data);
        }
    }
?>