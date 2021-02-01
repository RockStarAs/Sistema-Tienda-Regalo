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
        public function modelo_inserta_venta_mayor($id_usuario,$id_usuario_atiende,$dni_cliente,$fecha_venta,$tipo_venta=0)
        {
            $fecha_venta = date("Y-m-d H:i:s");
            if(VERSION_BD == "MySQL"){
                //EN MYSQL No deja agregar directamente porque dice que hay un erro de string con el bit D: 
                $query ="INSERT INTO venta(id_usuario,id_usuario_atiende,fecha_venta,dni_cliente,tipo_venta) VALUES ('$id_usuario','$id_usuario_atiende','$fecha_venta','$dni_cliente',$tipo_venta)";
                $valores = array();   
            }else{
            $query = "INSERT INTO venta(
                id_usuario,
                id_usuario_atiende,
                fecha_venta,
                dni_cliente,
                tipo_venta
                ) 
                values (?,?,?,?,?)";
            $valores = array($id_usuario,$id_usuario_atiende,$fecha_venta,$dni_cliente,$tipo_venta);
            }
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
        public function modelo_listar_venta_producto($tipo = 1){
            $query = "SELECT * FROM vista_datos_venta WHERE ESTADO_VENTA = $tipo AND tipo_venta=1";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_listar_venta_mayor($tipo = 0){
            $query = "SELECT * FROM vista_datos_venta WHERE tipo_venta=$tipo AND estado_venta = 1";
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
        public function modelo_datos_venta($id_venta)
        {
            $query = "SELECT * FROM vista_datos_venta WHERE ID_VENTA = $id_venta";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_detalles_venta($id_venta){
            $query= "SELECT (P.id_producto) as CODIGO_PRODUCTO, (P.nombre_producto) as NOMBRE_PRODUCTO, (DV.precio_venta) as PRECIO, (DV.cantidad) as CANTIDAD_VENDIDA,(DV.descuento) as DESCUENTO_APLICADO FROM venta as V INNER JOIN detalle_venta as DV ON  DV.id_venta = V.id_venta INNER JOIN producto as P ON P.id_producto = DV.id_producto WHERE DV.id_venta = $id_venta";
            $solicita_busqueda = $this->select_all($query);
            return $solicita_busqueda;
        }
        public function lista_ventas_realizadas(){
            $query = "SELECT * FROM vista_datos_venta WHERE ESTADO_VENTA = 1";
            $solicita_busqueda = $this->select_all($query);
            return $solicita_busqueda;
        }
        public function ventas_realizadas_por_vendedor($nombre_usuario){
            if(VERSION_BD == "MySQL"){
                $query = "SELECT FECHA_VENTA,ID_VENTA,TIPO_VENTA,TOTAL_PAGADO FROM vista_datos_venta WHERE ESTADO_VENTA!=0 AND NOMBRE_CAJERO='$nombre_usuario' AND YEAR(FECHA_VENTA)=YEAR(CURDATE())
                        ORDER BY FECHA_VENTA DESC";
            }else{
                $query = "SELECT FECHA_VENTA,ID_VENTA,TIPO_VENTA,TOTAL_PAGADO
                FROM vista_datos_venta WHERE ESTADO_VENTA!=0 AND NOMBRE_CAJERO='$nombre_usuario' AND YEAR(FECHA_VENTA)=YEAR(GETDATE())
                            ORDER BY FECHA_VENTA DESC"; 
            }
            $solicita_busqueda = $this->select_all($query);
            return $solicita_busqueda;
        }
        public function lista_ventas_realizadas_eliminadas(){
            $query = "SELECT * FROM vista_datos_venta WHERE ESTADO_VENTA = 0";
            $solicita_busqueda = $this->select_all($query);
            return $solicita_busqueda;
        }
        public function buscar_id($id){
            $query = "SELECT id_venta FROM venta WHERE id_venta = $id";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function saca_dni($id_venta){
            $query = "SELECT dni_cliente FROM venta WHERE id_venta = $id_venta";
            $solicitud = $this->select_one($query);
            return $solicitud;
        }
        public function modelo_det_ventas($id_venta){
            $query ="SELECT P.imagen_producto,P.id_producto,P.nombre_producto,P.descripcion_producto,DV.precio_venta,DV.descuento,DV.cantidad FROM detalle_venta as DV INNER JOIN producto as P ON DV.id_producto = P.id_producto WHERE DV.id_venta = $id_venta";
            $solicita = $this->select_all($query);
            return $solicita;
        }
        public function eliminar_venta($id_venta){
            $query = "UPDATE venta SET estado_venta = 0,id_venta = ? WHERE id_venta = ?";
            $valores = array($id_venta,$id_venta);
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }
    }
?>