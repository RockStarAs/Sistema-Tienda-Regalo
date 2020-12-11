<?php
    class producto_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }
        public function modelo_insertar_producto($id_categoria,$nombre_producto,$precio_unitario_venta,$stock_producto,$precio_compra){
            $query="INSERT INTO producto(id_categoria,nombre_producto,precio_unitario_venta,stock_producto,precio_compra_actualizado) 
            VALUES (?,?,?,?,?)";
            $valores=array($id_categoria,$nombre_producto,$precio_unitario_venta,$stock_producto,$precio_compra);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        
        
        public function modelo_actualizar_producto($id_producto,$id_categoria,$nombre_producto,$precio_unitario_venta,$stock_producto,$precio_compra){
            $query="UPDATE producto SET id_categoria=?,nombre_producto=?,precio_unitario_venta=?,stock_producto=?,precio_compra_actualizado=? 
            WHERE id_producto=?";
            $valores=array($id_categoria,$nombre_producto,$precio_unitario_venta,$stock_producto,$precio_compra,$id_producto);
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }

        public function modelo_listar_productos(){
            $query = "SELECT * FROM producto";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
 
        public function modelo_busca_producto_id($id_producto){
            $query = "SELECT * FROM producto where id_producto = $id_producto";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_elimina_producto($id_producto){

        }    
    }
    
?>