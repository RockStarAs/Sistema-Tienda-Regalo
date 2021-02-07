<?php
    class Login extends Controladores{
        function __construct(){
            session_start();
            
            if(isset($_SESSION['login'])){
                header('location: '.base_url().'dashboard');
            }
            parent::__construct();
        }
        public function login(){
            $data['titulo_pagina']="Inicio de sesión :: Sistema Tienda";
            $data['nombre_pagina']= "Login";
            $data['nombre_funciones_pag']="funciones_login.js";
            $this->vistas->obten_vista($this,"login",$data);
        }
        public function loguea_usuario(){
            //depurar($_POST);
            if($_POST){
                if(empty($_POST['usuario_id']) || empty($_POST['usuario_password'])){
                    $array_respuesta = array('status' => false, 'msg' => 'Error en los datos');
                }else{
                    //Aun no usamos niguna encriptaciones como la SHA256 así que por ahora lo dejo así 
                    $usuario = limpiar_str($_POST['usuario_id']);
                    $contraseña = hash('sha256',$_POST['usuario_password']);
                    $solicitud_logueo = $this->modelo->modelo_loguea_usuario($usuario,$contraseña);
                    if(empty($solicitud_logueo)){
                        $array_respuesta = array('status' => false, 'msg' => 'Usuario o contraseña incorrecto.');
                    }else{
                        $array_data = $solicitud_logueo;
                        if($array_data['estado_usuario'] == 1 ){
                            $_SESSION['id_usuario'] = $array_data['id_usuario'];
                            $_SESSION['login'] = true;
                            $_SESSION['nombre_trabajador'] = $array_data['nombre_trabajador'];
                            $_SESSION['nombre_usuario'] = $array_data['nombre_usuario'];
                            //Falta actualizar SHA-256
                            $_SESSION['password_usuario'] = $array_data['password_usuario'];

                            $_SESSION['rol_usuario'] = $array_data['rol_usuario'] == "ADMIN" ? "ADMINISTRADOR": $array_data['rol_usuario'];
                            //Asignar ruta del icono de usuario
                            switch($_SESSION['rol_usuario']){
                                case "ADMINISTRADOR":
                                    $_SESSION['url_avatar'] = media() . 'images/admin.png';
                                    break;
                                case "CAJERO":
                                    $_SESSION['url_avatar'] = media() . 'images/cajero.png';
                                    break;
                                case "ATENCION":
                                    $_SESSION['url_avatar'] = media() . 'images/atencion.png';
                                    break;
                            }
                            

                            $array_respuesta = array('status' =>true, 'msg'=>'ok');
                        }else{
                            $array_respuesta = array('status' => false, 'msg' => 'Este usuario no tiene acceso al sistema.');        
                        }
                    }
                }
                echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>
