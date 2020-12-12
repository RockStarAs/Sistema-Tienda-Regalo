<?php 
    class Dashboard extends Controladores{
        function __construct(){
            parent::__construct();
        }
        public function dashboard(){
            $data["titulo_pagina"] = "Dashboard";
            $data["nombre_pagina"] = "Dashboard :: Sistema Venta";
            $this->vistas->obten_vista($this,"dashboard",$data);
        }
    }
?>