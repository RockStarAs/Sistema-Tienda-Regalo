<?php
    class categoria extends Controladores
    {
        
        public function __construct()
        {
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }

        public function gestionar_categorias()
        {
            $data["titulo_pagina"] = "Gestión de Categorías";
            $data["nombre_pagina"] = "Productos :: Gestión Categorías";
            $data["funciones_js"]="funciones_categoria.js";
            $this->vistas->obten_vista($this, "gestionar_categorias", $data);
        }

        public function inserta_categoria()
        {
            $nombre_categoria = limpiar_str($_POST['txt_nombre']);
            $descripcion_categoria= limpiar_str($_POST['txt_descripcion']);
            if (isset($_POST['id_categoria'])) {
                $id_Categoria=desencriptar($_POST['id_categoria']);
                $id_Categoria=limpiar_str($id_Categoria);
                $id_Cat=false;
            }else{
                $id_Cat=true;
                $id_Categoria=0;
            }
            if ($id_Categoria!=false || $id_Cat) {
                if ($id_Categoria==0) {
                    //Insertar
                    $solicitud_insertar = $this->modelo->modelo_inserta_categoria($nombre_categoria,$descripcion_categoria);               
                    $opcion=1;
                }else{
                    //Actualizar
                    $solicitud_insertar=$this->modelo->modelo_actualiza_categoria($id_Categoria,$nombre_categoria,$descripcion_categoria);
                    $opcion=2;
                }
                if($solicitud_insertar > 0){
                    if ($opcion==1) {
                        $array_respuesta = array('status' => true, 'msg' => "Datos guardados correctamente.");                    
                    }else{
                        $array_respuesta = array('status' => true, 'msg' => "Datos actualizados correctamente.");
                    }
                }else{
                    if($solicitud_insertar == 'exist'){
                        $array_respuesta = array('status' => false, 'msg' => "Atención el Nombre de la categoria ya está registrado");
                    }else{
                        $array_respuesta = array('status' => false, 'msg' => "No es posible almacenar datos.");
                    }
                }
            }else{
                $array_respuesta = array('status' => false, 'msg' => "No es posible almacenar datos."); 
            }
            
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function seleccionar_categoria($id_Categoria){
            $int_id_cat=desencriptar($id_Categoria);
            if ($int_id_cat>0) {
                $arrayDatos=$this->modelo->modelo_seleccionar_categoria($int_id_cat);
                if (empty($arrayDatos)) {
                    $array_respuesta = array('status' => false, 'msg' => "Datos no encontrados.");
                }else{
                    $arrayDatos['id_categoria']=$id_Categoria;
                    $array_respuesta = array('status' => true, 'data' => $arrayDatos);
                }
            }else{
                $array_respuesta = array('status' => false, 'msg' => "Datos no encontrados.");
            }
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function listar_categorias(){
            $data = $this->modelo->modelo_listar_categoriasActivas();
            for ($i=0; $i < count($data); $i++) { 
                if($data[$i]['estado_categoria'] == 1){
                    $data[$i]['estado_categoria'] = " <span class='badge badge-success'> Activa </span> ";
                }else{
                    $data[$i]['estado_categoria'] = " <span class='badge badge-danger'>  Inactiva </span> ";
                }
                $id_crypt=encriptar ($data[$i]["id_categoria"]);
                $data[$i]['opciones'] = mostrar_acciones($id_crypt,"btnEditar_Categoria","btnEliminar_Categoria");          
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }

        

        public function devolver_categorias(){
            $htmlOpciones="";
            $arrayDatos=$this->modelo->modelo_listar_categoriasActivas();
            if(count($arrayDatos)>0){
                for ($i=0; $i <count($arrayDatos) ; $i++) { 
                    $htmlOpciones.='<option value="'.$arrayDatos[$i]['id_categoria'].'">'.$arrayDatos[$i]['nombre_categoria'].'</option>';
                } 
            }
            echo $htmlOpciones;
            die();
        }

        public function eliminar_categoria(){
            if ($_POST) {
                $int_id_cat=desencriptar($_POST['id_categoria']);
                if ($int_id_cat!=false) {
                    $int_id_cat=intval($int_id_cat);
                    $solicitud_eliminar=$this->modelo->modelo_eliminar_categoria($int_id_cat);
                    if ($solicitud_eliminar=='ok') {
                        $array_respuesta=array('status' => true, 'msg' => "Se ha eliminado la categoria");
                    }else if($solicitud_eliminar=='exist'){
                        $array_respuesta=array('status' => false, 'msg' => "No es posible eliminar una categoria asociada a un producto.");
                    }else{
                        $array_respuesta=array('status' => false, 'msg' => "Error al eliminar la categoria");
                    }
                }else{
                    $array_respuesta=array('status' => false, 'msg' => "Error al eliminar la categoria"); 
                }
                echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>
