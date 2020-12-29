<?php 
    class Compra extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }
        public function insertar_compra(){
            $data = $this->modelo->modelo_inserta_compra("12345678",null,null,null);
            $this->vistas->obten_vista($this,"ver_compra",$data);
        }
        public function listar_compra(){
            $data = $this->modelo->modelo_listar_compra();
            $this->vistas->obten_vista($this,"ver_compra",$data);
        }
        public function busca_compra(){
            $data = $this->modelo->modelo_busca_compra(1);
            $this->vistas->obten_vista($this,"ver_compra",$data);
        }
    }
?>