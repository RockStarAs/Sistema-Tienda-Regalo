<?php 
    class Compra extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }
        public function agregar_compra(){
            //Pagina de la vista
            $data["titulo_pagina"] = "Agregar una compra";
            $data["nombre_pagina"] = "Sistema Tienda :: Compras";
            $data["funciones_js"] = "funciones_compra_agregar.js";
            //$data = $this->modelo->modelo_inserta_usuario("75541205","Juan","Ortelli","caja2","caja2","CAJERO");
            
            $this->vistas->obten_vista($this,"agregar_compra",$data); 
        }
        public function insertar_compra(){
            $data = $this->modelo->modelo_inserta_compra("12345678",null,null,null);
            $this->vistas->obten_vista($this,"ver_compra",$data);
        }
        public function listar_compra(){
            $data = $this->modelo->modelo_listar_compra_con_prov();
            for($i=0; $i<count($data); $i++){
                $data[$i]['estado_compra'] = $data[$i]['estado_compra'] == 1 ? " <span class='badge badge-success'> Recibido </span> " : " <span class='badge badge-danger'>  No recibido </span> ";
                $data[$i]['opciones_compra'] =
                '<div class="text-center">
                    <button class="btn btn-outline-warning btn-sm verCompra" rl="'.$data[$i]['id_compra'].'" title="Ver detalles de la compra" type="button">¡👁️!</button>
                    <button class="btn btn-outline-danger btn-sm eliminarCompra" rl="'.$data[$i]['id_compra'].'" title="Eliminar" type="button">❌</button>
                </div>';
            }
            //Listar las opciones para compras 
            //Ver compra y eliminar una compra, solo ver compra por ahora disponible

            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function busca_compra(){
            $data = $this->modelo->modelo_busca_compra(1);
            $this->vistas->obten_vista($this,"ver_compra",$data);
        }
        public function ver_compras(){
           //Pagina de la vista
           $data["titulo_pagina"] = "Ver compras realizadas";
           $data["nombre_pagina"] = "Sistema Tienda :: Compras";
           $data["funciones_js"] = "funciones_compras_ver.js";
           //$data = $this->modelo->modelo_inserta_usuario("75541205","Juan","Ortelli","caja2","caja2","CAJERO");
           
           $this->vistas->obten_vista($this,"listar_compra",$data);  
        }
    }
?>