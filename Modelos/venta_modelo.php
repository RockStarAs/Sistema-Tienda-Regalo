<?php
    class venta_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }
        public function modelo_inserta_venta($id_usuario,$id_usuario_atiende,$dni_cliente)
        {
            $fecha_venta = date("Y-m-d H:i:s");
            $query = "INSERT INTO venta(
                id_usuario,
                id_usuario_atiende,
                fecha_venta,
                dni_cliente
                ) 
                values (?,?,?,?)";
            $valores = array($id_usuario,$id_usuario_atiende,$fecha_venta,$dni_cliente);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        public function modelo_inserta_venta_mayor($id_usuario,$id_usuario_atiende,$dni_cliente,$fecha_venta)
        {
            $fecha_venta = date("Y-m-d H:i:s");
            $query = "INSERT INTO venta(
                id_usuario,
                id_usuario_atiende,
                fecha_venta,
                dni_cliente,
                tipo_venta
                ) 
                values (?,?,?,?,?)";
            $valores = array($id_usuario,$id_usuario_atiende,$fecha_venta,$dni_cliente,0);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        public function modelo_inserta_detalles_venta($id_venta,$id_producto,$precio_venta,$cantidad,$descuento=0)
        {
            $query = "INSERT INTO detalle_venta(id_venta,id_producto,precio_venta,cantidad,descuento) VALUES (?,?,?,?,?)";
            $valores = array($id_venta, $id_producto, $precio_venta, $cantidad, $descuento);
            $solicita_insert = $this->insert($query, $valores);
            return $solicita_insert;
        }
        public function modelo_listar_venta_producto(){
            $query = "SELECT * FROM venta WHERE tipo_venta=1";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_listar_venta_mayor(){
            $query = "SELECT * FROM venta WHERE tipo_venta=0";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_busca_venta($id_venta){
            $query = "SELECT * FROM  venta WHERE id_venta = $id_venta";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        
        public function modelo_eliminar_venta($id_venta)
        {
            $return ="";
            $query = "UPDATE venta SET estado_venta=? WHERE id_venta=?";
            $valores = array(0,$id_venta);
            $return = $this->update($query,$valores);
            if ($return) {
                $return='ok';
            }else{
                $return='error';
            }      
            return $return;
        }
    }
?>