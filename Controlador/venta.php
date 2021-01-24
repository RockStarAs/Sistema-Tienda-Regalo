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

        public function venta_normal(){
            //Pagina de la vista para las ventas normales
            $data["titulo_pagina"] = "Sistema Tienda :: Ventas";
            $data["nombre_pagina"] = "Venta de productos";
            $data["funciones_js"] = "funciones_venta_normal.js";
            
            $this->vistas->obten_vista($this,"venta_normal",$data); 
        } 
        public function insertar_venta_normal(){
            if($_POST){
                $dni_cliente = isset($_POST["cliente_dni"]) ? limpiar_str($_POST["cliente_dni"]) : '99999999' ; 
                $id_usuario_caja=$_SESSION['id_usuario'];
                $id_usuario_atiende=isset($_POST["id_vendedor"]) ? limpiar_str($_POST["id_vendedor"]) : $_SESSION['id_usuario'];
                $fecha_venta=limpiar_str($_POST["fecha_venta"]);
                
                $id_productos =  $_POST["idarticulo"];
                $cantidad_productos =  $_POST["cantidad"];
                $precio_venta_productos = $_POST["precio_venta"];
                $descuento = $_POST["descuento_venta"];
                //public function modelo_inserta_venta_mayor($id_usuario,$id_usuario_atiende,$dni_cliente,$fecha_venta,$tipo_venta=0)
                /*La function modelo_inserta_venta_mayor modificada para que el tipo de venta por defecto sea 0 la cuál hace referencia a una venta al por mayor, para la venta al por meno el tipo_venta = 1 --> en la base de datos este también se encuentra por defecto */

                $solicitud_agregar_venta = $this->modelo->modelo_inserta_venta_mayor($id_usuario_caja,$id_usuario_atiende,$dni_cliente,$fecha_venta,1);

                if($solicitud_agregar_venta > 0 ){
                    //El id se ha registrado
                    if(count($id_productos) <= 0){
                        $data = array("status" => false,"id" => null,"msg" =>"Error en la inserción de los detalles de la compra.");
                           
                    }else{
                        //Procediendo a agregar 
                        for ($i=0; $i < count($id_productos) ; $i++) { 
                            $solicitud_agrega_detalle_venta = $this->modelo-> modelo_inserta_detalles_venta($solicitud_agregar_venta,$id_productos[$i],$precio_venta_productos[$i],$cantidad_productos[$i],$descuento[$i]);        
                        }
                        $data = array("status" => true,"msg" =>"Se ha registrado la venta, con un total de ".count($id_productos)." productos.","id_venta"=>$solicitud_agregar_venta);
                    }
                }else{
                    $respuesta = array('status' => false, 'msg' => "Id agregado es $solicitud_agregar_venta");    
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                die();
            }
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
            $data = $this->modelo->modelo_listar_venta_mayor();
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function busca_venta_con_datos($id_venta){
            $data = $this->modelo->modelo_datos_venta($id_venta);
            $data["detalles_venta"] = $this->modelo->modelo_detalles_venta($id_venta);
            return $data;
            die();
        }
        public function ventas_realizadas(){
            $data["titulo_pagina"] = "Sistema Tienda :: Historial ventas";
            $data["nombre_pagina"] = "Historial de ventas";
            $data["funciones_js"] = "funciones_historial_ventas.js";
            $this->vistas->obten_vista($this,"ventas_realizadas",$data); 
            die();
        }
        public function lista_ventas(){
            $data = $this->modelo->lista_ventas_realizadas();
            for ($i=0; $i < count($data); $i++) {
                $fecha = $data[$i]["FECHA_VENTA"];
                $fecha_venta = date_create("$fecha");
                $data[$i]["FECHA_VENTA"] = date_format($fecha_venta,"d/m/Y H:i A");
                $data[$i]["TIPO_VENTA"] = $data[$i]["TIPO_VENTA"] == 0 ? "Al por mayor":"Venta normal";
                $data[$i]["TOTAL_PAGADO"] = round($data[$i]["TOTAL_PAGADO"],2);
                $total = $data[$i]["TOTAL_PAGADO"];
                $data[$i]["TOTAL_PAGADO"] = "S/. $total";
                $data[$i]["OPCIONES"] = mostrar_acciones($data[$i]["ID_VENTA"],"verVenta","eliminarVenta","verTicket",4);
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>