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
                $data = array("status" => false, "msg" => "Tal parece que aún no se ha hecho una venta el día de hoy ($day-$mes-$anio)","TOTAL_PAGADO" => 0.0,'TOTAL_PAGADO_EFECTIVO'=> 0.0 ,'TOTAL_PAGADO_TARJETA'=> 0.0,'TOTAL_PAGADO_YAPE' => 0.0);
            }else{ 
                $data['TOTAL_PAGADO'] = $this->modelo->modelo_busca_ventas_dia($anio,$mes,$day);
                $data['status'] = true;
                
                $array = $this->modelo->modelo_lista_ventas_dia($anio,$mes,$day);
                //echo json_encode($array,JSON_UNESCAPED_UNICODE);
                //die();
                $total_efectivo = 0;
                $total_tarjeta = 0;
                $total_yape = 0;
                
                for ($i=0; $i < count($array); $i++) { 
                    switch($array[$i]['TIPO_PAGO']){
                        case 0:
                            $total_efectivo += $array[$i]['TOTAL_PAGADO'];
                        break;
                        case 1:
                            $total_tarjeta += $array[$i]['TOTAL_PAGADO']; 
                        break;
                        case 2:
                            $total_yape += $array[$i]['TOTAL_PAGADO'];
                        break;
                    }    
                }
                $data['TOTAL_PAGADO_EFECTIVO'] = $total_efectivo;
                $data['TOTAL_PAGADO_TARJETA'] = $total_tarjeta;
                $data['TOTAL_PAGADO_YAPE'] = $total_yape;
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
            if(count($data) > 0){
                for ($i=0; $i < count($data); $i++) { 
                    switch($data[$i]["TIPO_PAGO"]){
                        case 0:
                            $data[$i]["TIPO_PAGO"] = "EN EFECTIVO";
                        break;
                        case 1:
                            $data[$i]["TIPO_PAGO"] = "CON TARJETA";
                        break;
                        case 2:
                            $data[$i]["TIPO_PAGO"] = "MEDIANTE YAPE";
                        break;
                    }
                    $data[$i]['ACCIONES']=mostrar_acciones($data[$i]['ID_VENTA'],"verVenta","","",5); 
                }
            }
            //Llenar las opciones
            
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            //$this->vistas->obten_vista($this,"ver_ventas_dia",$data); 
            die();
        } 
    }
?>
