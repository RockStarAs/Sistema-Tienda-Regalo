<?php
    class home_modelo extends conexion_bd{
        public function __construct(){
            parent::__construct();
        }
        /*public function get_carrito($parametros){
            return "Datos recibidos del carrito Nro." . $parametros;
        }
        public function set_categoria($nombre_cat,$descripcion_cat,$estado_cat){
            $query = "INSERT INTO categoria_producto(nombre_categoria,descripcion_categoria,estado_categoria) values (?,?,?)";
            $valores = array($nombre_cat,$descripcion_cat,$estado_cat);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        public function get_categoria($id_categoria){
            $query = "SELECT * FROM categoria_producto WHERE id_categoria = $id_categoria";
            $solicita_select = $this->select_one($query);
            return $solicita_select;
        }*/
    }
?>
