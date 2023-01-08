<?php
    class venta_modelo extends conexion_bd{
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
        public function modelo_inserta_venta_mayor($id_usuario,$id_usuario_atiende,$dni_cliente,$fecha_venta,$tipo_venta,$tipo_pago,$campo_extra)
        {
            $tipo_venta = isset($tipo_venta) ? 0 : $tipo_venta;
            $fecha_venta = date("Y-m-d H:i:s");
            if(VERSION_BD == "MySQL"){
                if($tipo_pago == 0 ){
                    $query ="INSERT INTO venta(id_usuario,id_usuario_atiende,fecha_venta,dni_cliente,tipo_venta,tipo_pago,paga_con) VALUES ('$id_usuario','$id_usuario_atiende','$fecha_venta','$dni_cliente',$tipo_venta,$tipo_pago,$campo_extra)";
                }else{
                    if($tipo_pago == 1 ){
                        $query ="INSERT INTO venta(id_usuario,id_usuario_atiende,fecha_venta,dni_cliente,tipo_venta,tipo_pago,id_voucher_tarjeta) VALUES ('$id_usuario','$id_usuario_atiende','$fecha_venta','$dni_cliente',$tipo_venta,$tipo_pago,'$campo_extra')";
                    }else{
                        $query ="INSERT INTO venta(id_usuario,id_usuario_atiende,fecha_venta,dni_cliente,tipo_venta,tipo_pago) VALUES ('$id_usuario','$id_usuario_atiende','$fecha_venta','$dni_cliente',$tipo_venta,$tipo_pago)";
                    }
                }
                //EN MYSQL No deja agregar directamente porque dice que hay un erro de string con el bit D: 
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

        public function rango_fechas($fechaInicial, $fechaFinal){

            if($fechaInicial == null)
            {
                $query="SELECT * FROM vista_datos_venta WHERE YEAR(FECHA_VENTA)=YEAR(NOW()) AND ESTADO_VENTA!=0 ORDER BY FECHA_VENTA ASC";
                
            }else if($fechaInicial == $fechaFinal)
            {
                $query="SELECT * FROM vista_datos_venta WHERE fecha_venta like '%$fechaFinal%' AND ESTADO_VENTA!=0";
    
            }else{
    
                $fechaActual = new DateTime();
                $fechaActual ->add(new DateInterval("P1D"));
                $fechaActualMasUno = $fechaActual->format("Y-m-d");
    
                $fechaFinal2 = new DateTime($fechaFinal);
                $fechaFinal2 ->add(new DateInterval("P1D"));
                $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
    
                if($fechaFinalMasUno == $fechaActualMasUno){
    
                    $query="SELECT * FROM vista_datos_venta WHERE ESTADO_VENTA!=0 AND fecha_venta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'";
    
                }else{
    
                    $query = "SELECT * FROM vista_datos_venta WHERE ESTADO_VENTA!=0 AND fecha_venta BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
                }
            }
            $solicita=$this->select_all($query);
            return $solicita;	 
        }

        public function Suma_Total_Ventas(){	

            $query="SELECT SUM(TOTAL_PAGADO) as Total FROM vista_datos_venta";
            $solicitud = $this->select_one($query);
            return $solicitud;
        }

        public function reporte_cajeros($fechaInicial, $fechaFinal){
            if($fechaInicial == null)
            {
                $query="SELECT * FROM vista_datos_venta WHERE YEAR(FECHA_VENTA)=YEAR(NOW()) AND ESTADO_VENTA!=0 ORDER BY FECHA_VENTA ASC";
                
            }else if($fechaInicial == $fechaFinal)
            {
                $query="SELECT * FROM vista_datos_venta WHERE fecha_venta like '%$fechaFinal%' AND ESTADO_VENTA!=0";
    
            }else{
    
                $fechaActual = new DateTime();
                $fechaActual ->add(new DateInterval("P1D"));
                $fechaActualMasUno = $fechaActual->format("Y-m-d");
    
                $fechaFinal2 = new DateTime($fechaFinal);
                $fechaFinal2 ->add(new DateInterval("P1D"));
                $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
    
                if($fechaFinalMasUno == $fechaActualMasUno){
    
                    $query="SELECT * FROM vista_datos_venta WHERE ESTADO_VENTA!=0 AND fecha_venta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'";
    
                }else{
    
                    $query = "SELECT * FROM vista_datos_venta WHERE ESTADO_VENTA!=0 AND fecha_venta BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
                }
            }
            $solicita=$this->select_all($query);
            return $solicita;

        }
        public function ventas_realizadas_hoy(){
            $query="SELECT *,TIME(FECHA_VENTA) as Hora FROM vista_datos_venta WHERE DATE_FORMAT(FECHA_VENTA,'%Y-%m-%d')=CURDATE()
            ORDER BY Hora DESC";
            $solicita=$this->select_all($query);
            return $solicita;
        }

        public function reporte_vendedores($fechaInicial, $fechaFinal){
            $query="SELECT vista_datos_venta.*,usuario.apellidos_trabajador as Vendedor from vista_datos_venta
            INNER JOIN venta on vista_datos_venta.ID_VENTA=venta.id_venta
            INNER JOIN usuario on venta.id_usuario_atiende=usuario.id_usuario ";
            if($fechaInicial == null)
            {
                $query.="WHERE YEAR(vista_datos_venta.FECHA_VENTA)=YEAR(NOW()) AND vista_datos_venta.ESTADO_VENTA!=0 ORDER BY vista_datos_venta.FECHA_VENTA ASC";
                
            }else if($fechaInicial == $fechaFinal)
            {
                $query.="WHERE vista_datos_venta.FECHA_VENTA like '%$fechaFinal%' AND vista_datos_venta.ESTADO_VENTA!=0";
    
            }else{
    
                $fechaActual = new DateTime();
                $fechaActual ->add(new DateInterval("P1D"));
                $fechaActualMasUno = $fechaActual->format("Y-m-d");
    
                $fechaFinal2 = new DateTime($fechaFinal);
                $fechaFinal2 ->add(new DateInterval("P1D"));
                $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
    
                if($fechaFinalMasUno == $fechaActualMasUno){
    
                    $query.="WHERE vista_datos_venta.ESTADO_VENTA!=0 AND vista_datos_venta.FECHA_VENTA BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'";
    
                }else{
    
                    $query .= "WHERE vista_datos_venta.ESTADO_VENTA!=0 AND vista_datos_venta.FECHA_VENTA BETWEEN '$fechaInicial' AND '$fechaFinal'";
    
                }
            }
            $solicita=$this->select_all($query);
            return $solicita;
                        
        }
    }
?>
