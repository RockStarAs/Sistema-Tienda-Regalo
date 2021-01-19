<?php 
    class Venta extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }
        public function venta_mayor(){
            //Pagina de la vista
            $data["titulo_pagina"] = "Sistema Tienda :: Ventas";
            $data["nombre_pagina"] = "Venta por mayor";
            $data["funciones_js"] = "funciones_venta_mayor.js";
            
            $this->vistas->obten_vista($this,"venta_mayor",$data); 
        }

        public function insertar_venta(){
            if($_POST){
                //Agregando la compra en la base de datos
                $dni_cliente = isset($_POST["cliente_dni"]) ? limpiar_str($_POST["cliente_dni"]) : '99999999' ; 
                $id_usuario_caja=$_SESSION['id_usuario'];
                $id_usuario_atiende=isset($_POST["id_vendedor"]) ? limpiar_str($_POST["id_vendedor"]) : $_SESSION['id_usuario'];
                $fecha_venta=limpiar_str($_POST["fecha_venta"]);
                //Datos de venta asignados
                //Array de detalles pero están separados
                $id_productos =  $_POST["idarticulo"];
                $cantidad_productos =  $_POST["cantidad"];
                $precio_venta_productos = $_POST["precio_venta"];

                //bandera
                $flag = false;

                $solicitud_agregar_venta=$this->modelo->modelo_inserta_venta_mayor($id_usuario_caja,$id_usuario_atiende,$dni_cliente,$fecha_venta);
                if($solicitud_agregar_venta > 0){
                    //El id se ha registrado
                    if(count($id_productos) <= 0){
                        $data = array("status" => false,"id" => null,"msg" =>"Error en la inserción de los detalles de la compra.");
                           
                    }else{
                        //Procediendo a agregar 
                        for ($i=0; $i < count($id_productos) ; $i++) { 
                            $solicitud_agrega_detalle_venta = $this->modelo-> modelo_inserta_detalles_venta($solicitud_agregar_venta,$id_productos[$i],$precio_venta_productos[$i],$cantidad_productos[$i]);        
                        }
                        $data = array("status" => true,"msg" =>"Se ha registrado la venta, con un total de ".count($id_productos)." productos.");
                    }     
                }else{
                    $data = array("status" => false,"id" => null,"msg" =>"Fallo inserción de la venta como tal.");         
                }
            }else{
                $data = array("status" => false, "msg" => "Error en la inserción de la venta.");
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function listar_ventas(){
            $data = $this->modelo->modelo_listar_venta();
            $this->vistas->obten_vista($this,"ver_venta",$data);
        }
        public function busca_venta(){
            $data = $this->modelo->modelo_busca_venta(2);
            $this->vistas->obten_vista($this,"ver_venta",$data);
        }
    }
?>