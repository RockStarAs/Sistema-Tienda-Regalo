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
            if($_POST){
                //Agregando la compra en la base de datos
                $ruc_dni = limpiar_str($_POST["proveedor_id"]); 
                $estado_compra = limpiar_str($_POST["estado_compra"]);
                $serie_boleta_factura = limpiar_str($_POST["serie_boleta_factura"]) == "" ? null: limpiar_str($_POST["serie_boleta_factura"]);
                $correlativo_boleta_factura = limpiar_str($_POST["correlativo_boleta_factura"]) == "" ? null : limpiar_str($_POST["correlativo_boleta_factura"]);
                $fecha_registro_compra = limpiar_str($_POST["fecha_compra"]);
                $fecha_entrega_compra = limpiar_str($_POST["fecha_entrega"]) == "" ? null : limpiar_str($_POST["fecha_entrega"]);
                //Datos de compra asignados
                //Array de detalles pero están separados
                $id_productos =  $_POST["idarticulo"];
                $cantidad_productos =  $_POST["cantidad"];
                $precio_compra_productos = $_POST["precio_compra"];

                //bandera
                $flag = false;

                $solicitud_agregar_compra=$this->modelo->modelo_inserta_compra($ruc_dni,$serie_boleta_factura,$correlativo_boleta_factura,$fecha_registro_compra,$fecha_entrega_compra,$estado_compra);
                if($solicitud_agregar_compra > 0){
                    //El id se ha registrado
                    if(count($id_productos) <= 0){
                        $data = array("status" => false,"id" => null,"msg" =>"Error en la inserción de los detalles de la compra.");
                           
                    }else{
                        //Procediendo a agregar 
                        for ($i=0; $i < count($id_productos) ; $i++) { 
                            $solicitud_agrega_detalle_compra = $this->modelo->modelo_inserta_detalles_compra($id_productos[$i],$solicitud_agregar_compra,$cantidad_productos[$i],$precio_compra_productos[$i]);        
                        }
                        $data = array("status" => true,"msg" =>"Se ha registrado la compra, con un total de ".count($id_productos)." productos.");
                    }     
                }else{
                    $data = array("status" => false,"id" => null,"msg" =>"Fallo inserción de la compra compra como tal.");         
                }
            }else{
                $data = array("status" => false, "msg" => "Error en la inserción de la compra.");
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function listar_compra(){
            $data = $this->modelo->modelo_listar_compra_con_prov();
            for($i=0; $i<count($data); $i++){
                
                if($data[$i]['estado_compra']== 0 ){
                    $data[$i]['opciones_compra'] =
                    '<div class="text-center">
                        <button class="btn btn-outline-success btn-sm recibirCompra" rl="'.encriptar($data[$i]['id_compra']).'" title="Marcar compra como recibida" type="button">📦</button>
                        <button class="btn btn-outline-warning btn-sm verCompra" rl="'.encriptar($data[$i]['id_compra']).'" title="Ver detalles de la compra" type="button">¡👁️!</button>
                        <button class="btn btn-outline-danger btn-sm eliminarCompra" rl="'.encriptar($data[$i]['id_compra']).'" title="Eliminar" type="button">❌</button>
                    </div>';   
                }else{
                    $data[$i]['opciones_compra'] =
                    '<div class="text-center">
                        <button class="btn btn-outline-warning btn-sm verCompra" rl="'.encriptar($data[$i]['id_compra']).'" title="Ver detalles de la compra" type="button">¡👁️!</button>
                        <button class="btn btn-outline-danger btn-sm eliminarCompra" rl="'.encriptar($data[$i]['id_compra']).'" title="Eliminar" type="button">❌</button>
                    </div>';
                }
                $data[$i]['estado_compra'] = $data[$i]['estado_compra'] == 1 ? " <span class='badge badge-success'> Recibido </span> " : " <span class='badge badge-danger'>  No recibido </span> ";
            }
            //Listar las opciones para compras 
            //Ver compra y eliminar una compra, solo ver compra por ahora disponible

            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
        
        public function actualiza_compra($id_compra){
            $id_compra_dsc = desencriptar($id_compra);
            if($id_compra_dsc > 0){
                $this->modelo->modelo_actualiza_compra($id_compra_dsc);
                $array_respuesta = array('status' => true, "msg" => "Se actualizó la compra y los productos");
            }else{
                $array_respuesta = array('status' => false, "msg" => "No se pudo actualizar, ocurrió un problema con el servidor");
            }
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die(); 
        }
        public function ver_compra_con_detalles($id_compra){
            
            $id_compra_dsc =  desencriptar($id_compra); 
            if($id_compra_dsc > 0 ){
                $data["titulo_pagina"] = "Vista compra";
                $data["nombre_pagina"] = "Sistema Tienda :: Ver Compra";
                $data["funciones_js"] = "funcion_vista_compra.js";
                $data["datos_compra"] = $this->modelo->modelo_busca_compra($id_compra_dsc);
                $data["detalles_compra"] = $this->modelo->modelo_busca_detalles($id_compra_dsc);
                
                
                $this->vistas->obten_vista($this,"ver_compra",$data);
                //echo json_encode($data,JSON_UNESCAPED_UNICODE);
                

            }else{
                //Podría agregarse una vista de algo salió mal xd 
                header("location:".base_url() . "dashboard");
            }
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