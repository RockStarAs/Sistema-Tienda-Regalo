<?php
    class Combo extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }

        public function gestionar_combo()
        {
            $data["titulo_pagina"] = "Gestion de Combos";
            $data["nombre_pagina"] = "Productos :: Gestión Combos";
            $data["funciones_js"]="funciones_combos.js";
            $this->vistas->obten_vista($this, "gestionar_combo", $data);
        }

        public function insertar_combo(){
            $data = $this->modelo->modelo_insertar_combo("Combo 3","",18.30,6);
            $this->vistas->obten_vista($this,"ver_combo",$data);
        }

        public function modificar_combo(){
            $data = $this->modelo->modelo_actualizar_combo("1","Combo X","",11,1);
            $this->vistas->obten_vista($this,"ver_combo",$data);
        }

        public function listar_combos(){
            $data = $this->modelo->modelo_listar_combosActivos();
            for ($i=0; $i < count($data); $i++) { 
                if($data[$i]['estado_combo'] == 1){
                    $data[$i]['estado_combo'] = " <span class='badge badge-success'> Activo </span> ";
                }else{
                    $data[$i]['estado_combo'] = " <span class='badge badge-danger'>  Inactivo </span> ";
                }
                $id_crypt=encriptar ($data[$i]["id_combo"]);
                $data[$i]['precio_combo'] = SMONEY . formatea_moneda($data[$i]['precio_combo']);
                $data[$i]['opciones'] = mostrar_acciones($id_crypt,"btnEditar_Combo","btnEliminar_Combo");          
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
        
        public function busca_combo_id(){
            $data = $this->modelo->modelo_busca_combo_id(2);
            $this->vistas->obten_vista($this,"ver_combo",$data);
        }
    }
?>