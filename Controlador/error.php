<?php 
    class Errors extends Controladores{ 
        public function __construct(){
            parent::__construct();
        }
        public function no_encontrado(){
           $this->vistas->obten_vista($this,"error");
        }
    }
    $no_encontrado = new Errors();
    $no_encontrado->no_encontrado();
?>