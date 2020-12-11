<?php
    class Producto extends Controladores{
        function __construct(){
            parent::__construct();
        }

        public function insertar_producto(){
            $data = $this->modelo->modelo_insertar_producto(1,"Producto 2",20,4,17);
            $this->vistas->obten_vista($this,"ver_producto",$data);
        }

        public function modificar_producto(){
            $data = $this->modelo->modelo_actualizar_producto(1,1,"Producto X",20,8,17);
            $this->vistas->obten_vista($this,"ver_producto",$data);
        }

        public function listar_productos(){
            $data = $this->modelo->modelo_listar_productos();
            $this->vistas->obten_vista($this,"ver_producto",$data);
        }
        
        public function busca_producto_id(){
            $data = $this->modelo->modelo_busca_producto_id(2);
            $this->vistas->obten_vista($this,"ver_producto",$data);
        }
    }
?>