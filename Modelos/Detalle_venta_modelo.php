<?php
    class detalle_venta_modelo extends conexion_bd{
        public function __construct(){
            parent::__construct();
        }

        public function modelo_insertar_detalle_venta($id_venta,$cantidad,$precio_venta,$descuento,$id_producto,$id_combo){
            $tipo_a_vender="";
            if ($id_producto!=NULL) {
                $tipo_a_vender="producto";
            } else {
                $tipo_a_vender="combo";
            }
            $query="INSERT INTO detalle_venta(id_venta,cantidad,precio_venta,tipo_a_vender,descuento,id_producto,id_combo) 
                VALUES (?,?,?,?,?,?,?)";
            $valores=array($id_venta,$cantidad,$precio_venta,$tipo_a_vender,$descuento,$id_producto,$id_combo);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        
        
       
        public function modelo_listar_detalle_ventas(){
            $query = "SELECT * FROM detalle_venta";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
 
        public function modelo_busca_detalle_venta_id($id_detalle_venta){
            $query = "SELECT * FROM detalle_venta WHERE id_detalle_venta=$id_detalle_venta";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_elimina_detalle_venta($id_detalle_venta){
            $query = "DELETE FROM detalle_venta WHERE id_detalle_venta=$id_detalle_venta";
            $solicita_busqueda = $this->delete($query);
            return $solicita_busqueda;
        }


    }

?>
