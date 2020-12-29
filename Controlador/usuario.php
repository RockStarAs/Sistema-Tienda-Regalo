<?php 
    class Usuario extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }
        /*
        public function inserta_categoria(){
            $data = $this->modelo->set_categoria("Detalles","Detalles para toda ocasión",1);
            print_r($data);
        }
        */
        public function gestionar_usuarios(){
            $data["titulo_pagina"] = "Agregar Usuario";
            $data["nombre_pagina"] = "Usuarios :: Agregar Usuario";
            $data["funciones_js"]="funciones_admin.js";
            //$data = $this->modelo->modelo_inserta_usuario("75541205","Juan","Ortelli","caja2","caja2","CAJERO");
            $this->vistas->obten_vista($this,"gestionar_usuarios",$data);
        }
        public function insertar_usuario(){
            /*$data["titulo_pagina"] = "Agregar Usuario";
            $data["nombre_pagina"] = "Usuarios :: Agregar Usuario";
            
            $this->vistas->obten_vista($this,"gestionar_usuarios",$data);*/
            $dni_usuario = limpiar_str($_POST['txt_dni']);
            $nombre_trabajador = limpiar_str($_POST['txt_nombre']);
            $apellidos_trabajador = limpiar_str($_POST['txt_apellido']);
            $nombre_usuario = limpiar_str($_POST['txt_nombre_usuario']);
            $password_usuario = limpiar_str($_POST['txt_contraseña']);
            $rol_usuario = limpiar_str($_POST['select_tipo']);
            
            $solicitud_insertar = $this->modelo->modelo_inserta_usuario($dni_usuario,$nombre_trabajador,$apellidos_trabajador,$nombre_usuario,$password_usuario,$rol_usuario);

            if($solicitud_insertar > 0){
                $array_respuesta = array('status' => true, 'msg' => "Datos guardados correctamente.");
            }else{
                if($solicitud_insertar == 'exist'){
                    $array_respuesta = array('status' => false, 'msg' => "Atención el DNI ya está registrado");
                }else{
                    $array_respuesta = array('status' => false, 'msg' => "No es posible almacenar datos.");
                }
            }
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function modificar_usuario(){
            $id_usuario = $_POST['id_usuario'];
            $dni_usuario = limpiar_str($_POST['txt_dni_act']);
            $nombre_trabajador = limpiar_str($_POST['txt_nombre_act']);
            $apellidos_trabajador = limpiar_str($_POST['txt_apellido_act']);
            $nombre_usuario = limpiar_str($_POST['txt_nombre_usuario_act']);
            $password_usuario = $_POST['txt_contraseña_act'];
            $rol_usuario = limpiar_str($_POST['select_tipo_act']);
            $solicitud_modificar = $this->modelo->modelo_actualiza_usuario($dni_usuario,$nombre_trabajador,$apellidos_trabajador,$nombre_usuario,$password_usuario,$rol_usuario,1,$id_usuario);

            $array_respuesta = array('status' => true, 'msg' => "Datos actualizados correctamente.");
            
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die();
            
        }
        public function listar_usuarios(){
            $data = $this->modelo->modelo_listar_usuarios();
            for ($i=0; $i < count($data); $i++) { 
                if($data[$i]['estado_usuario'] == 1){
                    $data[$i]['estado_usuario'] = " <span class='badge badge-success'> Activo </span> ";
                }else{
                    $data[$i]['estado_usuario'] = " <span class='badge badge-danger'>  Inactivo </span> ";
                }
                $data[$i]['opciones'] = mostrar_acciones($data[$i]["id_usuario"],"btnEditarUsuario","btnEliminarUsuario");          
            }

            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
            //depurar($data);
            //$this->vistas->obten_vista($this,"ver_usuario",$data);
        }
        /*public function busca_usuario_dni(){
            $data = $this->modelo->modelo_busca_usuario_dni("75541203");
            $this->vistas->obten_vista($this,"ver_usuario",$data);
        }*/

        public function busca_usuario_id(int $id_user){
            $id_usuario = intval(limpiar_str($id_user));
            if($id_usuario > 0){
                $data = $this->modelo->modelo_busca_usuario_id($id_usuario); 
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
            }
            die();
        }
        public function elimina_usuario_id(){
            if($_POST){
                $id_usuario = intval($_POST['id_usuario']);
                $solicita_eliminar = $this->modelo->modelo_elimina_usuario($id_usuario);
                //Validar respuesta del controlador ok
                $array_respuesta = array('status' =>true, 'msg'=>'Se ha eliminado el usuario');
                echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>