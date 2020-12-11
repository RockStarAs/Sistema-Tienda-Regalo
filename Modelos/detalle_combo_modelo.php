<?php
    class detalle_combo_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }

        public function modelo_insertar_detalle_combo($id_combo,$id_producto,$cantidad_producto,$precio_venta){
            $query="INSERT INTO detalle_combo(id_combo,id_producto,cantidad_producto,precio_venta) 
            VALUES (?,?,?,?)";
            $valores=array($id_combo,$id_producto,$cantidad_producto,$precio_venta);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        
        
        public function modelo_actualizar_detalle_combo($id_combo,$id_producto,$cantidad_producto,$precio_venta){
            $query="UPDATE detalle_combo SET cantidad_producto=?,precio_venta=? 
            WHERE id_combo=? AND id_producto=?";
            $valores=array($cantidad_producto,$precio_venta,$id_combo,$id_producto);
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }

        public function modelo_listar_detalle_combos(){
            $query = "SELECT * FROM detalle_combo";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
 
        public function modelo_busca_detalle_combo_id($id_combo,$id_producto){
            $query = "SELECT * FROM detalle_combo WHERE id_combo=$id_combo AND id_producto=$id_producto";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_elimina_detalle_combo($id_combo,$id_producto){
            $query = "DELETE FROM detalle_combo WHERE id_combo=$id_combo AND id_producto=$id_producto";
            $solicita_busqueda = $this->delete($query);
            return $solicita_busqueda;
        }
    }

?>