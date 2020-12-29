<?php
    //require_once("compra.php");
    class detalle_compra extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }

        public function insertar_detalle_compra(){
            $data = $this->modelo->modelo_insertar_detalle_compra(1,1,5,6);
            #$this->vistas->obten_vista(new Compra(),"ver_compra",$data);
        }

        public function modificar_detalle_compra(){
            $data = $this->modelo->modelo_actualizar_detalle_compra(1,1,10,6);
            #$this->vistas->obten_vista(new Compra(),"ver_compra",$data);
        }

        public function listar_detalle_compras(){
            $data = $this->modelo->modelo_listar_detalle_compras();
            #$this->vistas->obten_vista(new Compra(),"ver_compra",$data);
        }
        
        public function busca_detalle_compra_id(){
            $data = $this->modelo->modelo_busca_detalle_compra_id(1,2);
            #$this->vistas->obten_vista(new Compra(),"ver_compra",$data);
        }

        public function eliminar_detalle_compra_id(){
            $data = $this->modelo->modelo_elimina_detalle_compra(1,2);
            #$this->vistas->obten_vista(new Compra(),"ver_compra",$data);
        }
    }
?>