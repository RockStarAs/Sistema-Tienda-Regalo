<?php
    class detalle_compra_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }

        public function modelo_insertar_detalle_compra($id_compra,$id_producto,$cantidad_producto,$precio_compra){
            $query="INSERT INTO detalle_compra_producto(id_compra,id_producto,cantidad_producto,precio_compra) 
            VALUES (?,?,?,?)";
            $valores=array($id_compra,$id_producto,$cantidad_producto,$precio_compra);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        
        
        public function modelo_actualizar_detalle_compra($id_compra,$id_producto,$cantidad_producto,$precio_compra){
            $query="UPDATE detalle_compra_producto SET cantidad_producto=?,precio_compra=? 
            WHERE id_compra=? AND id_producto=?";
            $valores=array($cantidad_producto,$precio_compra,$id_compra,$id_producto);
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }

        public function modelo_listar_detalle_compras(){
            $query = "SELECT * FROM detalle_compra_producto";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
 
        public function modelo_busca_detalle_compra_id($id_compra,$id_producto){
            $query = "SELECT * FROM detalle_compra_producto WHERE id_compra=$id_compra AND id_producto=$id_producto";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_elimina_detalle_compra($id_compra,$id_producto){
            $query = "DELETE FROM detalle_compra_producto WHERE id_compra=$id_compra AND id_producto=$id_producto";
            $solicita_busqueda = $this->delete($query);
            return $solicita_busqueda;
        }

    }

?>