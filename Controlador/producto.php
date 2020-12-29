<?php
    class Producto extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }

        public function gestionar_productos(){
            $data["titulo_pagina"] = "Gestion de Productos";
            $data["nombre_pagina"] = "Productos :: Gestión Productos";
            $data["funciones_js"]="funciones_producto.js";
            $this->vistas->obten_vista($this,"gestionar_productos",$data);
        }

        public function insertar_producto(){
            $data = $this->modelo->modelo_insertar_producto(1,"Producto 2","",20,4,17);
            $this->vistas->obten_vista($this,"ver_producto",$data);
        }

        public function modificar_producto(){
            $data = $this->modelo->modelo_actualizar_producto(1,1,"Producto X",20,8,17);
            $this->vistas->obten_vista($this,"ver_producto",$data);
        }

        public function listar_productos(){
            $data = $this->modelo->modelo_listar_productos();
            for ($i=0; $i < count($data); $i++) { 
                $nombre=$this->modelo->modelo_nombre_Categorias($data[$i]['id_categoria']);
                $data[$i]['id_categoria']=$nombre['nombre_categoria'];
                if($data[$i]['estado_producto'] == 1){
                    $data[$i]['estado_producto'] = " <span class='badge badge-success'> Activo </span> ";
                }else{
                    $data[$i]['estado_producto'] = " <span class='badge badge-danger'>  Inactivo </span> ";
                }
                $data[$i]['precio_unitario_venta']=SMONEY.formatea_moneda($data[$i]['precio_unitario_venta']);
                $data[$i]['precio_compra_actualizado']=SMONEY.formatea_moneda($data[$i]['precio_compra_actualizado']);
                $data[$i]['opciones'] = mostrar_acciones($data[$i]["id_producto"]);          
            }

            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
        
        public function busca_producto_id(){
            $data = $this->modelo->modelo_busca_producto_id(2);
            $this->vistas->obten_vista($this,"ver_producto",$data);
        }
    }
?>