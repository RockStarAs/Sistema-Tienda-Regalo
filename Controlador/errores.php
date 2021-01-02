<?php 
    class Errores extends Controladores{
        public function __construct(){
            /*
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }*/
            parent::__construct();
        }
        public function no_encontrado($data = ""){
           $this->vistas->obten_vista($this,"sin_autorizacion",$data);
           die();
        }
    }
    $no_encontrado = new Errores();
    $no_encontrado->no_encontrado();
?>