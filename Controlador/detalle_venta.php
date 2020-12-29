<?php
    class Detalle_venta extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }

        public function insertar_detalle_venta(){
            $data = $this->modelo->modelo_insertar_detalle_venta(1,3,20,0,NULL,1);
            $this->vistas->obten_vista($this,"ver_venta",$data);
        }

       

        public function listar_detalle_ventas(){
            $data = $this->modelo->modelo_listar_detalle_ventas();
            $this->vistas->obten_vista($this,"ver_venta",$data);
        }
        
        public function busca_detalle_venta_id(){
            $data = $this->modelo->modelo_elimina_detalle_venta(2);
            $this->vistas->obten_vista($this,"ver_venta",$data);
        }
    }
?>