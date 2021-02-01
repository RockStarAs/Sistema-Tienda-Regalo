<?php 
    class Proveedor extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }
        public function gestionar_proveedores(){
            $data["titulo_pagina"] = "Gestión de Proveedores";
            $data["nombre_pagina"] = "Sistema Tienda :: Proveedores";
            $data["funciones_js"] = "funciones_proveedor.js";
            //$data = $this->modelo->modelo_inserta_usuario("75541205","Juan","Ortelli","caja2","caja2","CAJERO");
            if($_SESSION['rol_usuario'] == 'ADMINISTRADOR'){
                $this->vistas->obten_vista($this,"gestionar_proveedores",$data);  
            }else{
                $this->vistas->obten_vista($this,"errores/sin_autorizacion",$data);    
            }
        }
        public function insertar_proveedor(){
            $ruc_dni = limpiar_str($_POST['txt_dni_ruc']);
            $nombre_proveedor = limpiar_str($_POST['txt_nombre_proveedor']);
            $telefono_contacto = limpiar_str($_POST['txt_telefono_proveedor']);
            $email_proveedor = limpiar_str($_POST['txt_email_proveedor']);
            $ciudad_ubicacion = limpiar_str($_POST['txt_ciudad_proveedor']);
            $direccion_ubicacion = limpiar_str($_POST['txt_direccion_proveedor']);

            $solicitud_insertar = $this->modelo->modelo_inserta_proveedor($ruc_dni,$nombre_proveedor,$telefono_contacto,$email_proveedor,$ciudad_ubicacion,$direccion_ubicacion);
            if($solicitud_insertar > 0){
                $array_respuesta = array('status' => true, 'msg' => "Datos guardados correctamente.");
            }else{
                if($solicitud_insertar == 'exist'){
                    $array_respuesta = array('status' => false, 'msg' => "Atención el DNI o RUC ya está registrado");
                }else{
                    $array_respuesta = array('status' => false, 'msg' => "No es posible almacenar datos.");
                }
            }
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function modificar_proveedor(){
            $ruc_dni_antiguo = $_POST['txt_dni_ruc_cambiar'];

            $ruc_dni_nuevo = $_POST['txt_dni_ruc_act'];
            $nombre_proveedor = $_POST['txt_nombre_proveedor_act'];
            $telefono_proveedor = $_POST['txt_telefono_proveedor_act'];
            $email_proveedor = $_POST['txt_email_proveedor_act'];
            $ciudad_proveedor = $_POST['txt_ciudad_proveedor_act'];
            $direccion_proveedor = $_POST['txt_direccion_proveedor_act'];


            $solicitud_modificar = $this->modelo->modelo_actualiza_proveedor($ruc_dni_antiguo,$ruc_dni_nuevo,$nombre_proveedor,$telefono_proveedor,$email_proveedor,$ciudad_proveedor,$direccion_proveedor);

            $array_respuesta = array('status' => true, 'msg' => "Datos actualizados correctamente.");
            
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function listar_proveedores(){
            $data = $this->modelo->modelo_listar_proveedor();
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['opciones'] = mostrar_acciones($data[$i]["ruc_dni"],"actualizaProveedor","eliminaProveedor","compraAProveedor",3);          
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE); 
            die();
        }
        public function busca_proveedor($ruc_dni){

            $data = $this->modelo->modelo_busca_proveedor($ruc_dni);    
            if(empty($data)){
                $respuesta = array('status' => false,
                    'msg' => 'Datos no encontrados.'
                );
            }else{
                $respuesta = array('status'=>true,
                    'data' => $data
                );
            }
            echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
            die(); 
            //$this->vistas->obten_vista($this,"ver_proveedor",$data);
        }
        public function elimina_proveedor(){
            if($_POST){
                $ruc_dni_proveedor = intval($_POST['ruc_dni_proveedor']);
                $solicita_eliminar = $this->modelo->modelo_elimina_proveedor($ruc_dni_proveedor);
                //Validar respuesta del controlador ok
                $array_respuesta = array('status' =>true, 'msg'=>'Se ha eliminado el usuario');
                echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function devolver_proveedores(){
            $html_opciones="";
            $array_datos=$this->modelo->modelo_listar_proveedor();
            if(count($array_datos)){
                for ($i=0; $i < count($array_datos); $i++) { 
                    $html_opciones.='<option value="'.$array_datos[$i]['ruc_dni'].'">'.$array_datos[$i]['nombre_proveedor'].'</option>';  
                }    
            }
            echo $html_opciones;
            die();
        }
    }
?>