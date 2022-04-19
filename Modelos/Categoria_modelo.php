<?php
    class categoria_modelo extends conexion_bd{

        public function __construct(){
            parent::__construct();
        }

        public function modelo_inserta_categoria($nombre_categoria,$descripcion_categoria){
            $return ="";
            $query = "SELECT * FROM categoria_producto WHERE nombre_categoria = '$nombre_categoria' AND estado_categoria!=0";
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

        public function modelo_actualiza_categoria($id_categoria,$nombre_categoria,$descripcion_categoria){
            $return ="";
            $query = "SELECT * FROM categoria_producto WHERE nombre_categoria='$nombre_categoria' AND id_categoria != '$id_categoria' AND estado_categoria!=0";
            $solicita_listado = $this->select_all($query);

            if(empty($solicita_listado)){
                $query = "UPDATE categoria_producto SET nombre_categoria=?, descripcion_categoria=? WHERE id_categoria=?";
                $valores = array($nombre_categoria,$descripcion_categoria,$id_categoria);
                $solicita_insert = $this->update($query,$valores);
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

        public function modelo_eliminar_categoria($id_categoria){
            $return ="";
            $query = "SELECT * FROM producto WHERE id_categoria = '$id_categoria'";
            $solicita_listado = $this->select_all($query);

            if(empty($solicita_listado)){
                $query = "UPDATE categoria_producto SET estado_categoria= 0 WHERE id_categoria= '$id_categoria'";
                $valores = array();
                $return = $this->update($query,$valores);
                if ($return) {
                    $return='ok';
                }else{
                    $return='error';
                }      
            }else{
                $return = 'exist';
            }
            return $return;
        }
    }
?>
