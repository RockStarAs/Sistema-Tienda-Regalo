<?php 
    class Cliente extends Controladores{
        function __construct(){
            parent::__construct();
        }
        public function insertar_cliente(){
            $data = $this->modelo->modelo_inserta_cliente("73011516","Raisa","Orellana","955551476");
            $this->vistas->obten_vista($this,"ver_cliente",$data);
        }
        public function modificar_cliente(){
            $data = $this->modelo->modelo_actualiza_cliente("73011516","Raisa","ORELLANA","955551476");
            $this->vistas->obten_vista($this,"ver_cliente",$data);
        }
        public function listar_clientes(){
            $data = $this->modelo->modelo_listar_cliente();
            $this->vistas->obten_vista($this,"ver_cliente",$data);
        }
        public function busca_cliente(){
            $data = $this->modelo->modelo_busca_cliente("73011516");
            $this->vistas->obten_vista($this,"ver_cliente",$data);
        }
        public function elimina_cliente(){
            $data = $this->modelo->modelo_elimina_cliente("73011516");
            $this->vistas->obten_vista($this,"ver_cliente",$data);
        }
    }
?>