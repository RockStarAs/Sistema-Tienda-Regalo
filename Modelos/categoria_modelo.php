<?php
    class categoria_modelo extends sql_server{

        public function __construct(){
            parent::__construct();
        }

        public function modelo_inserta_categoria($nombre_categoria,$descripcion_categoria){
            $return ="";
            $query = "SELECT * FROM categoria_producto WHERE nombre_categoria = '$nombre_categoria'";
            $solicita_listado = $this->select_all($query);
            $descripcion_categoria = ($descripcion_categoria=="") ? "Ninguna" : $descripcion_categoria ;
            if(empty($solicita_listado)){
                $query = "INSERT INTO categoria_producto(nombre_categoria,descripcion_categoria) 
                    values (?,?)";
                $valores = array($nombre_categoria,$descripcion_categoria);
                $solicita_insert = $this->insert($query,$valores);
                $return = $solicita_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }

        public function modelo_listar_categorias(){
            $query = "SELECT * FROM categoria_producto";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }

        public function modelo_listar_categoriasActivas(){
            $query = "SELECT * FROM categoria_producto WHERE estado_categoria!=0";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }

        public function modelo_seleccionar_categoria($id_categoria){
            $query = "SELECT * FROM categoria_producto WHERE id_categoria=$id_categoria";
            $solicita_listado = $this->select_one($query);
            return $solicita_listado;
        }
    }
?>