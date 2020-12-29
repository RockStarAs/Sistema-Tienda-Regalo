<?php 
    class Dashboard extends Controladores{
        function __construct(){
            parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
        }
        public function dashboard(){
            $data["titulo_pagina"] = "Dashboard";
            $data["nombre_pagina"] = "Dashboard :: Sistema Venta";
            $this->vistas->obten_vista($this,"dashboard",$data);
        }
    }
?>