<?php 
    class Venta extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }
        public function insertar_venta(){
            $data = $this->modelo->modelo_inserta_venta(6,6,"73011517");
            $this->vistas->obten_vista($this,"ver_venta",$data);
        }
        public function listar_ventas(){
            $data = $this->modelo->modelo_listar_venta();
            $this->vistas->obten_vista($this,"ver_venta",$data);
        }
        public function busca_venta(){
            $data = $this->modelo->modelo_busca_venta(2);
            $this->vistas->obten_vista($this,"ver_venta",$data);
        }
    }
?>