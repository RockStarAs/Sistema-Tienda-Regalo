<?php 
    class Usuario extends Controladores{
        function __construct(){
            parent::__construct();
        }
        /*
        public function inserta_categoria(){
            $data = $this->modelo->set_categoria("Detalles","Detalles para toda ocasión",1);
            print_r($data);
        }
        */
        public function insertar_usuario(){
            $data = $this->modelo->modelo_inserta_usuario("75541205","Juan","Ortelli","caja2","caja2","CAJERO");
            $this->vistas->obten_vista($this,"ver_usuario",$data);
        }
        public function modificar_usuario(){
            $data = $this->modelo->modelo_actualiza_usuario("75541205","Juan","Caicedo","caja2","caja2","CAJERO",0,9);
            $this->vistas->obten_vista($this,"ver_usuario",$data);
        }
        public function listar_usuarios(){
            $data = $this->modelo->modelo_listar_usuarios();
            $this->vistas->obten_vista($this,"ver_usuario",$data);
        }
        public function busca_usuario_dni(){
            $data = $this->modelo->modelo_busca_usuario_dni("75541203");
            $this->vistas->obten_vista($this,"ver_usuario",$data);
        }
        public function busca_usuario_id(){
            $data = $this->modelo->modelo_busca_usuario_id(6);
            $this->vistas->obten_vista($this,"ver_usuario",$data);
        }
        public function elimina_usuario_id(){
            $data = $this->modelo->modelo_elimina_usuario(4);
            $this->vistas->obten_vista($this,"ver_usuario",$data);
        }
    }
?>