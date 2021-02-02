<?php
    class reporte_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }
        public function modelo_busca_ventas_dia($anio,$mes,$dia){
            //Cuerpo de la función
            $query = "
                select SUM(TOTAL_PAGADO) AS TOTAL_VENTA from vista_datos_venta WHERE ESTADO_VENTA = 1 AND (YEAR(FECHA_VENTA) = $anio AND MONTH(FECHA_VENTA) = $mes AND DAY(FECHA_VENTA) = $dia) 
            ";
            $solicita_resultado = $this->select_one($query);
            return $solicita_resultado;
        }
        public function modelo_lista_ventas_dia($anio,$mes,$dia){
            //Cuerpo de la función
            $query = "
                select * from vista_datos_venta WHERE ESTADO_VENTA = 1 AND (YEAR(FECHA_VENTA) = $anio AND MONTH(FECHA_VENTA) = $mes AND DAY(FECHA_VENTA) = $dia) 
            ";
            $solicita_resultado = $this->select_all($query);
            return $solicita_resultado;
        }
    }
?>