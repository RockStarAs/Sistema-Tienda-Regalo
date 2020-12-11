<?php 
    class Proveedor extends Controladores{
        function __construct(){
            parent::__construct();
        }
        public function insertar_proveedor(){
            $data = $this->modelo->modelo_inserta_proveedor("12345678","Detalles RMR",null,null,null,null);
            $this->vistas->obten_vista($this,"ver_proveedor",$data);
        }
        public function modificar_proveedor(){
            $data = $this->modelo->modelo_actualiza_proveedor("12345678","DETALLES rmr","969779755","rcalderonpe@unprg.edu.pe","Chiclayo","Av. 28 de Julio 456");
            $this->vistas->obten_vista($this,"ver_proveedor",$data);
        }
        public function listar_proveedores(){
            $data = $this->modelo->modelo_listar_proveedor();
            $this->vistas->obten_vista($this,"ver_proveedor",$data);
        }
        public function busca_proveedor(){
            $data = $this->modelo->modelo_busca_proveedor("12345678");
            $this->vistas->obten_vista($this,"ver_proveedor",$data);
        }
        public function elimina_proveedor(){
            $data = $this->modelo->modelo_elimina_proveedor("12345678");
            $this->vistas->obten_vista($this,"ver_proveedor",$data);
        }
    }
?>