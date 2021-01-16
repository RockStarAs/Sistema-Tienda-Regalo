<?php
    class compra_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }
        public function modelo_inserta_compra(
            $ruc_dni,
            $serie_factura_boleta,
            $correlativo_factura_boleta,
            $fecha_registro_compra,
            $fecha_compra_realizada,
            $estado_compra
        ){
            $query = "INSERT INTO compra(
                ruc_dni,
                serie_factura_boleta,
                correlativo_factura_boleta,
                fecha_registro_compra,
                fecha_compra_realizada,
                estado_compra
                ) 
                values (?,?,?,?,?,?)";
            $valores = array($ruc_dni,$serie_factura_boleta,$correlativo_factura_boleta,$fecha_registro_compra,$fecha_compra_realizada,$estado_compra);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        public function modelo_inserta_detalles_compra($id_producto,$id_compra,$cantidad_producto,$precio_compra){
            $query = "INSERT INTO detalle_compra_producto(
                id_producto,
                id_compra,
                cantidad_producto,
                precio_compra
            )
            values (?,?,?,?)
            ";
            $valores = array($id_producto,$id_compra,$cantidad_producto,$precio_compra);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        public function modelo_listar_compra(){
            $query = "SELECT * FROM compra";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_listar_compra_con_prov(){
            $query = "SELECT C.id_compra,P.ruc_dni,P.nombre_proveedor,C.fecha_registro_compra,C.estado_compra FROM compra AS C INNER JOIN proveedor AS P ON P.ruc_dni = C.ruc_dni";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_busca_compra($id_compra){
            $query = "SELECT * FROM  compra WHERE id_compra = $id_compra";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        //Directamente no se debe aplicar un delete from xd 
        /*public function modelo_elimina_cliente($id_venta){
            $query = "DELETE FROM venta WHERE id_venta = '$id_venta'";
            $solicita_borrado = $this->delete($query);
            return $solicita_borrado;
        }*/
    }
?>