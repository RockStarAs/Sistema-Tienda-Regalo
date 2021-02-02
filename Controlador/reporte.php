<?php 
    class Reporte extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }
        public function ver_ventas_dia(){
            $anio = date('Y');
            $mes = date('m');
            $day = date('d');
            $data['DATOS_VENTA'] = $this->modelo->modelo_lista_ventas_dia($anio,$mes,$day);
            if(count($data['DATOS_VENTA']) == 0){
                $data = array("status" => false, "msg" => "Tal parece que aún no se ha hecho una venta el día de hoy ($day-$mes-$anio)","TOTAL_PAGADO" => 0.0);
            }else{
                $data['TOTAL_PAGADO'] = $this->modelo->modelo_busca_ventas_dia($anio,$mes,$day);
                $data['status'] = true;
            }
            $data["titulo_pagina"] = "Ver ventas del día";
            $data["nombre_pagina"] = "Sistema Tienda :: Reportes";
            $data["funciones_js"] = "funciones_reporte01.js";
            //echo json_encode($data,JSON_UNESCAPED_UNICODE);
            $this->vistas->obten_vista($this,"ver_ventas_dia",$data); 
            die();
        } 
        public function lista_ventas_dia(){
            $anio = date('Y');
            $mes = date('m');
            $day = date('d');
            $data = $this->modelo->modelo_lista_ventas_dia($anio,$mes,$day);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            //$this->vistas->obten_vista($this,"ver_ventas_dia",$data); 
            die();
        } 
    }
?>