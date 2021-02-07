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
        public function desconecta($fecha,$id_usuario){
            $this->modelo->modelo_desconecta($fecha,$id_usuario);
        }
        public function gestionar_usuarios(){
            $data["titulo_pagina"] = "Agregar Usuario";
            $data["nombre_pagina"] = "Usuarios :: Agregar Usuario";
            $data["funciones_js"]="funciones_admin.js";
            //$data = $this->modelo->modelo_inserta_usuario("75541205","Juan","Ortelli","caja2","caja2","CAJERO");
            if($_SESSION['rol_usuario'] == 'ADMINISTRADOR'){
                $this->vistas->obten_vista($this,"gestionar_usuarios",$data);    
            }else{
                $this->vistas->obten_vista($this,"errores/sin_autorizacion",$data);    
            }
                
        }
        public function insertar_usuario(){
            /*$data["titulo_pagina"] = "Agregar Usuario";
            $data["nombre_pagina"] = "Usuarios :: Agregar Usuario";
            
            $this->vistas->obten_vista($this,"gestionar_usuarios",$data);*/
            $dni_usuario = limpiar_str($_POST['txt_dni']);
            $nombre_trabajador = limpiar_str($_POST['txt_nombre']);
            $apellidos_trabajador = limpiar_str($_POST['txt_apellido']);
            $nombre_usuario = limpiar_str($_POST['txt_nombre_usuario']);
            //Obteniendo la contraseña que a colocar
            $password_usuario = limpiar_str($_POST['txt_contraseña']);

            //Pasando contraseña texto a SHA-256
            $password_usuario = hash('sha256',$password_usuario);

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
            $bandera = $password_usuario == '' ? true:false;
            $rol_usuario = limpiar_str($_POST['select_tipo_act']);

            if($bandera){
                $password_usuario = '';
                $solicitud_modificar = $this->modelo->modelo_actualiza_usuario($dni_usuario,$nombre_trabajador,$apellidos_trabajador,$nombre_usuario,$password_usuario,$rol_usuario,1,$id_usuario);
            }else{
                $password_usuario = hash('sha256',$password_usuario);
                $solicitud_modificar = $this->modelo->modelo_actualiza_usuario($dni_usuario,$nombre_trabajador,$apellidos_trabajador,$nombre_usuario,$password_usuario,$rol_usuario,1,$id_usuario);
            }
            $array_respuesta = array('status' => true, 'msg' => "Datos actualizados correctamente.");
            
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die();
            
        }
        public function listar_usuarios(){
            $data = $this->modelo->modelo_listar_usuarios();
            for ($i=0; $i < count($data); $i++) { 
                $fecha = $data[$i]['fecha_creacion'];  
                $fecha_mostrar = date_create("$fecha");
                $data[$i]['fecha_creacion'] = date_format($fecha_mostrar,"Y/m/d H:i A");

                $fecha = $data[$i]['ultima_conexion'];  
                $fecha_mostrar = date_create("$fecha");
                $data[$i]['ultima_conexion'] = date_format($fecha_mostrar,"Y/m/d H:i A");

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
        public function devolver_usuarios(){
            $htmlOpciones="";
            $arrayDatos=$this->modelo->modelo_listar_usuarios();
            if(count($arrayDatos)>0){
                for ($i=0; $i <count($arrayDatos) ; $i++) { 
                    $htmlOpciones.='<option value="'.$arrayDatos[$i]['id_usuario'].'">'.$arrayDatos[$i]['nombre_trabajador'].' '.$arrayDatos[$i]['apellidos_trabajador'].'</option>';
                } 
            }
            echo $htmlOpciones;
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
        public function perfil(){
            $id_usuario = intval(limpiar_str($_SESSION['id_usuario']));
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
                $respuesta["titulo_pagina"] = "Perfil del Usuario";
                $respuesta["nombre_pagina"] = "Usuarios :: Perfil del Usuario";
                
                $this->vistas->obten_vista($this,"perfil",$respuesta);
            }
            die(); 
        }
        public function cambiar_password(){
            if($_POST){
                $password_usuario_antiguo = hash('sha256',$_POST['txt_password_antigua']);
                $password_usuario_nuevo = $_POST['txt_password_nueva'];
                $password_usuario_nuevo_rep = $_POST['txt_password_nueva_rep'];

                if($password_usuario_antiguo != $_SESSION['password_usuario']){
                    $array_respuesta = array('status' =>false, 'msg'=>'La contraseña indicada no coincide con su contraseña antigua');
                }else{
                    if($password_usuario_nuevo !== $password_usuario_nuevo_rep){
                        $array_respuesta = array('status' =>false, 'msg'=>'Las nuevas contraseñas no coinciden');        
                    }else{
                        $password_usuario_nuevo = hash('sha256',$password_usuario_nuevo);
                        
                        $_SESSION['password_usuario'] = $password_usuario_nuevo;

                        $solicita_modificar_password = $this->modelo->modelo_cambiar_password($_SESSION['id_usuario'],$password_usuario_nuevo);
                        $array_respuesta = array('status' =>true, 'msg'=>'Se ha modificado su contraseña');
                        
                    }
                }
            }
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>
