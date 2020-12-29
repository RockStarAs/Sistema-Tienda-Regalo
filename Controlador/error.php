<?php 
    class Errors extends Controladores{ 
        public function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }
        public function no_encontrado(){
           $this->vistas->obten_vista($this,"error");
        }
    }
    $no_encontrado = new Errors();
    $no_encontrado->no_encontrado();
?>