<?php
    class categoria extends Controladores
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function gestionar_categorias()
        {
            $data["titulo_pagina"] = "Gestion de Categorias";
            $data["nombre_pagina"] = "Productos :: Gestión Categorias";
            $data["funciones_js"]="funciones_categoria.js";
            $this->vistas->obten_vista($this, "gestionar_categorias", $data);
        }

        public function inserta_categoria()
        {
            $nombre_categoria = limpiar_str($_POST['txt_nombre']);
            $descripcion_categoria= limpiar_str($_POST['txt_descripcion']);
            
            $solicitud_insertar = $this->modelo->modelo_inserta_categoria($nombre_categoria,$descripcion_categoria);

            if($solicitud_insertar > 0){
                $array_respuesta = array('status' => true, 'msg' => "Datos guardados correctamente.");
            }else{
                if($solicitud_insertar == 'exist'){
                    $array_respuesta = array('status' => false, 'msg' => "Atención el Nombre de la categoria ya está registrado");
                }else{
                    $array_respuesta = array('status' => false, 'msg' => "No es posible almacenar datos.");
                }
            }
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function seleccionar_categoria($id_Categoria){
            $int_id_cat=intval(limpiar_str($id_Categoria));//convertir a entero
            if ($int_id_cat>0) {
                $arrayDatos=$this->modelo->modelo_seleccionar_categoria($int_id_cat);
                if (empty($arrayDatos)) {
                    $array_respuesta = array('status' => false, 'msg' => "Datos no encontrados.");
                }else{
                    $array_respuesta = array('status' => true, 'data' => $arrayDatos);
                }
                echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function listar_categorias(){
            $data = $this->modelo->modelo_listar_categorias();
            for ($i=0; $i < count($data); $i++) { 
                if($data[$i]['estado_categoria'] == 1){
                    $data[$i]['estado_categoria'] = " <span class='badge badge-success'> Activa </span> ";
                }else{
                    $data[$i]['estado_categoria'] = " <span class='badge badge-danger'>  Inactiva </span> ";
                }
                
                $data[$i]['opciones'] = mostrar_acciones($data[$i]["id_categoria"],"btnEditar_Categoria");          
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
    }
?>