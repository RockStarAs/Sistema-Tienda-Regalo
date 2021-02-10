<?php
class Venta extends Controladores
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . 'login');
        }
        parent::__construct();
    }
    public function venta_mayor()
    {
        //Pagina de la vista
        $data["titulo_pagina"] = "Sistema Tienda :: Ventas";
        $data["nombre_pagina"] = "Venta por mayor";
        $data["funciones_js"] = "funciones_venta_mayor.js";

        $this->vistas->obten_vista($this, "venta_mayor", $data);
    }
    public function listar_ventas_general()
    {
        $data["titulo_pagina"] = "Sistema Tienda :: Ventas";
        $data["nombre_pagina"] = "Ventas Realizadas";
        $data["funciones_js"] = "funciones_ventas_listar.js";

        $this->vistas->obten_vista($this, "listar_ventas_main", $data);
    }

    public function reporte_ventas($fechaInicial)
    {
        $data["titulo_pagina"] = "Sistema Tienda :: Ventas";
        $data["nombre_pagina"] = "Reporte de Ventas";
        $data["funciones_js"] = "funciones_reporte_ventas.js";
        $data["fecha"]="Rango fecha";
        if (empty($fechaInicial)) {
            $data["fechaInicial"]="null";
            $data["fechaFinal"]="null";
        }else{
            $fechas=explode(",", $fechaInicial);
            if (count($fechas)==2) {
                if (validar_fecha($fechas[0]) && validar_fecha($fechas[1])) {
                    $data["fechaInicial"]=$fechas[0];
                    $data["fechaFinal"]=$fechas[1];
                }else{
                    $data["fechaInicial"]="null";
                    $data["fechaFinal"]="null";
                }
            }else{
                $data["fechaInicial"]="null";
                $data["fechaFinal"]="null";
            }
        }
        if($_SESSION['rol_usuario'] == 'ADMINISTRADOR'){
            $this->vistas->obten_vista($this, "reporte_ventas", $data);   
        }else{
            $this->vistas->obten_vista($this,"errores/sin_autorizacion",$data);    
        }
        
    }
    public function grafico_ventas()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST["fechaInicial"])){
                $fechaInicial = $_POST["fechaInicial"];
                $fechaFinal = $_POST["fechaFinal"];
            }else{
                $fechaInicial = null;
                $fechaFinal = null;
            }
            $solicitud = $this->modelo->rango_fechas($fechaInicial, $fechaFinal);
            $arrayFechas=array();
            $arrayVentas = array();
            $sumaPagosMes = [];
            for ($i = 0; $i < count($solicitud); $i++) {
                $fecha=substr($solicitud[$i]["FECHA_VENTA"],0,7);
                array_push($arrayFechas, $fecha);
                $solicitud[$i]["TOTAL_PAGADO"]=round($solicitud[$i]["TOTAL_PAGADO"], 2);
                $arrayVentas = array($fecha => $solicitud[$i]["TOTAL_PAGADO"]);
                #Sumamos los pagos que ocurrieron el mismo mes
                foreach ($arrayVentas as $key => $value) {
                    if (array_key_exists($key, $sumaPagosMes)) {
                        $sumaPagosMes[$key] += $value;
                    }else{
                        $sumaPagosMes+= [$key => $value];
                    }
                    
                }
            }
            $noRepetirFechas = array_unique($arrayFechas);

            foreach($noRepetirFechas as $key){
                $sumaPagosMes[$key]=round($sumaPagosMes[$key],2);
                $fechaEntera = strtotime($key);
                $mes=valorMes(date("m", $fechaEntera));
                $data[]=array("y"=>$mes,"ventas"=>$sumaPagosMes[$key]);
            }
            if ($solicitud==null) {
                $data[]=array("y"=>0,"ventas"=>0);
            }
        } else {
            $data = array("status" => false, "msg" => "Error creacion.");
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar_ventas_normal($tipo)
    {

        if ($tipo == 1) {
            $data["nombre_pagina"] = "Ventas Realizadas al por mayor";
            $data["tipo"] = $tipo;
        } else {
            $data["nombre_pagina"] = "Ventas Realizadas";
            $data["tipo"] = $tipo;
        }
        $data["titulo_pagina"] = "Sistema Tienda :: Ventas";
        $data["funciones_js"] = "funciones_ventas_listar.js";

        $this->vistas->obten_vista($this, "listar_ventas_normales", $data);
    }
    public function listar_ventas_r($tipo)
    {
        
        $data = $tipo == 2 ? $data = $data = $this->modelo->modelo_listar_venta_producto():$this->modelo->modelo_listar_venta_mayor();

        for ($i = 0; $i < count($data); $i++) {
            $fecha = $data[$i]["FECHA_VENTA"];
            $fecha_venta = date_create("$fecha");
            $data[$i]["FECHA_VENTA"] = date_format($fecha_venta, "d/m/Y H:i A");
            $id_crypt = encriptar($data[$i]["ID_VENTA"]);
            $data[$i]["TOTAL_PAGADO"] = SMONEY . formatea_moneda($data[$i]["TOTAL_PAGADO"]);
            $data[$i]["OPCIONES"] = mostrar_acciones($data[$i]["ID_VENTA"], "verVenta", "eliminarVenta", "verTicket", 4);
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar_ventaaa(){
        $data = $this->modelo->modelo_listar_venta_producto();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function venta_normal()
    {
        //Pagina de la vista para las ventas normales
        $data["titulo_pagina"] = "Sistema Tienda :: Ventas";
        $data["nombre_pagina"] = "Venta de productos";
        $data["funciones_js"] = "funciones_venta_normal.js";

        $this->vistas->obten_vista($this, "venta_normal", $data);
    }
    public function insertar_venta_normal()
    {
        if ($_POST) {
            $dni_cliente = isset($_POST["cliente_dni"]) ? limpiar_str($_POST["cliente_dni"]) : '99999999';
            $id_usuario_caja = $_SESSION['id_usuario'];
            $id_usuario_atiende = isset($_POST["id_vendedor"]) ? limpiar_str($_POST["id_vendedor"]) : $_SESSION['id_usuario'];
            $fecha_venta = limpiar_str($_POST["fecha_venta"]);

            $id_productos = $_POST["idarticulo"];
            $cantidad_productos = $_POST["cantidad"];
            $precio_venta_productos = $_POST["precio_venta"];
            $descuento = $_POST["descuento_venta"];
            //public function modelo_inserta_venta_mayor($id_usuario,$id_usuario_atiende,$dni_cliente,$fecha_venta,$tipo_venta=0)
            /*La function modelo_inserta_venta_mayor modificada para que el tipo de venta por defecto sea 0 la cuál hace referencia a una venta al por mayor, para la venta al por meno el tipo_venta = 1 --> en la base de datos este también se encuentra por defecto */
            $tipo_pago = $_POST['tipo_pago'];
            $campo_extra = "";
            if($tipo_pago != 2 ){
                $campo_extra = $_POST['monto_o_id'];
            }
            $solicitud_agregar_venta = $this->modelo->modelo_inserta_venta_mayor($id_usuario_caja, $id_usuario_atiende, $dni_cliente, $fecha_venta, 1,$tipo_pago,$campo_extra);

            if ($solicitud_agregar_venta > 0) {
                //El id se ha registrado
                if (count($id_productos) <= 0) {
                    $data = array("status" => false, "id" => null, "msg" => "Error en la inserción de los detalles de la compra.");

                } else {
                    //Procediendo a agregar
                    for ($i = 0; $i < count($id_productos); $i++) {
                        $solicitud_agrega_detalle_venta = $this->modelo->modelo_inserta_detalles_venta($solicitud_agregar_venta, $id_productos[$i], $precio_venta_productos[$i], $cantidad_productos[$i], $descuento[$i]);
                    }
                    $id_crypt=encriptar($solicitud_agregar_venta);
                    $data = array("status" => true, "msg" => "Se ha registrado la venta, con un total de " . count($id_productos) . " productos.", "id_venta" => $id_crypt);
                }
            } else {
                $respuesta = array('status' => false, 'msg' => "Id agregado es $solicitud_agregar_venta");
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function insertar_venta()
    {
        if ($_POST) {
            //Agregando la compra en la base de datos
            $dni_cliente = isset($_POST["cliente_dni"]) ? limpiar_str($_POST["cliente_dni"]) : '99999999';
            $id_usuario_caja = $_SESSION['id_usuario'];
            $id_usuario_atiende = isset($_POST["id_vendedor"]) ? limpiar_str($_POST["id_vendedor"]) : $_SESSION['id_usuario'];
            $fecha_venta = limpiar_str($_POST["fecha_venta"]);
            //Datos de venta asignados
            //Array de detalles pero están separados
            $tipo_pago = $_POST['tipo_pago'];
            $campo_extra = "";
            if($tipo_pago != 2 ){
                $campo_extra = $_POST['monto_o_id'];
            }
            $id_productos = $_POST["idarticulo"];
            $cantidad_productos = $_POST["cantidad"];
            $precio_venta_productos = $_POST["precio_venta"];
            $descuento = $_POST["descuento_producto"];
            //bandera
            $flag = false;

            $solicitud_agregar_venta = $this->modelo->modelo_inserta_venta_mayor($id_usuario_caja, $id_usuario_atiende, $dni_cliente, $fecha_venta,0,$tipo_pago,$campo_extra);
            
            if ($solicitud_agregar_venta > 0) {
                //El id se ha registrado
                if (count($id_productos) <= 0) {
                    $data = array("status" => false, "id" => null, "msg" => "Error en la inserción de los detalles de la compra.");

                } else {
                    //Procediendo a agregar
                    for ($i = 0; $i < count($id_productos); $i++) {
                        $solicitud_agrega_detalle_venta = $this->modelo->modelo_inserta_detalles_venta($solicitud_agregar_venta, $id_productos[$i], $precio_venta_productos[$i], $cantidad_productos[$i], $descuento[$i]);
                    }
                    $id_crypt=encriptar($solicitud_agregar_venta);
                    $data = array("status" => true, "msg" => "Se ha registrado la venta, con un total de " . count($id_productos) . " productos.","id" => $id_crypt);
                }
            } else {
                $data = array("status" => false, "id" => null, "msg" => "Fallo inserción de la venta como tal.");
            }
        } else {
            $data = array("status" => false, "msg" => "Error en la inserción de la venta.");
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar_ventas()
    {
        $data = $this->modelo->modelo_listar_venta_mayor();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function busca_venta_con_datos($id_venta)
    {
        $solicitud_id = $this->modelo->buscar_id($id_venta);
        if($solicitud_id == null){
            $data = array("status" => false);
        }else{
            $data = $this->modelo->modelo_datos_venta($id_venta);
            $data["detalles_venta"] = $this->modelo->modelo_detalles_venta($id_venta);
            $data["status"] = true;
        }
        //echo json_encode($data,JSON_UNESCAPED_UNICODE);
        return $data;
        die();
    }
    public function busca_venta_con_datos_v2($id_venta)
    {
        $solicitud_id = $this->modelo->buscar_id($id_venta);
        if($solicitud_id == null){
            $data = array("status" => false);
        }else{

            $data = $this->modelo->modelo_datos_venta($id_venta);
            $data['DNI'] = $this->modelo->saca_dni($id_venta);
            $data["detalles_venta"] = $this->modelo->modelo_det_ventas($id_venta);
            
            $data["status"] = true;
        }
        return $data;
        die();
    }
    
    public function ventas_realizadas()
    {
        $data["titulo_pagina"] = "Sistema Tienda :: Ver todas las ventas";
        $data["nombre_pagina"] = "Todas las ventas";
        $data["funciones_js"] = "funciones_historial_ventas.js";
        $this->vistas->obten_vista($this, "ventas_realizadas", $data);
        die();
    }
    public function lista_ventas_eliminadas(){
        $data = $this->modelo->lista_ventas_realizadas_eliminadas();
        for ($i = 0; $i < count($data); $i++) {
            $fecha = $data[$i]["FECHA_VENTA"];
            $fecha_venta = date_create("$fecha");
            $data[$i]["FECHA_VENTA"] = date_format($fecha_venta, "d/m/Y H:i A");
            $data[$i]["TIPO_VENTA"] = $data[$i]["TIPO_VENTA"] == 0 ? "Al por mayor" : "Venta normal";
            $data[$i]["TOTAL_PAGADO"] = round($data[$i]["TOTAL_PAGADO"], 2);
            $total = $data[$i]["TOTAL_PAGADO"];
            $data[$i]["TOTAL_PAGADO"] = "S/. $total";
            $data[$i]["OPCIONES"] = mostrar_acciones($data[$i]["ID_VENTA"], "verVenta", "", "verTicket", 5);
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();   
    }
    public function ventas_eliminadas()
    {
        $data["titulo_pagina"] = "Sistema Tienda :: Ver todas las ventas eliminadas ";
        $data["nombre_pagina"] = "Todas las ventas eliminadas";
        $data["funciones_js"] = "funciones_historial_ventas_eliminadas.js";
        $this->vistas->obten_vista($this, "ventas_eliminadas", $data);
        die();
    }
    public function lista_ventas()
    {
        $data = $this->modelo->lista_ventas_realizadas();
        for ($i = 0; $i < count($data); $i++) {
            $fecha = $data[$i]["FECHA_VENTA"];
            $fecha_venta = date_create("$fecha");
            $data[$i]["FECHA_VENTA"] = date_format($fecha_venta, "d/m/Y H:i A");
            $data[$i]["TIPO_VENTA"] = $data[$i]["TIPO_VENTA"] == 0 ? "Al por mayor" : "Venta normal";
            $data[$i]["TOTAL_PAGADO"] = round($data[$i]["TOTAL_PAGADO"], 2);
            $total = $data[$i]["TOTAL_PAGADO"];
            $data[$i]["TOTAL_PAGADO"] = "S/. $total";
            $data[$i]["OPCIONES"] = mostrar_acciones($data[$i]["ID_VENTA"], "verVenta", "eliminarVenta", "verTicket", 4);
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function realizar_venta(){
        $data["titulo_pagina"] = "Sistema Tienda :: Realizar una venta";
        $data["nombre_pagina"] = "Realice una venta";
        $data["funciones_js"] = "realiza_venta.js";
        $this->vistas->obten_vista($this, "realizar_venta", $data);
        die();
    }
    public function ver_venta_detallada($id_venta){
        $id_venta = desencriptar($id_venta);
        if(ctype_digit($id_venta)){
        $data = $this->busca_venta_con_datos_v2($id_venta);
        $data["titulo_pagina"] = "Sistema Tienda :: Ver venta completa";
        $data["nombre_pagina"] = "Vista de venta"; 
        $data["funciones_js"] = "ver_venta.js";
        //echo json_encode($data,JSON_UNESCAPED_UNICODE);
        $this->vistas->obten_vista($this, "ver_venta_detallada", $data);
        die();
        }else{
            echo "Error con el servidor";
        }
        //$this->vistas->obten_vista($this, "ver_venta_detallada", $data);
        die();
    }
    public function eliminar_venta(){
        if($_POST){
            $id_venta = desencriptar($_POST['id_venta']);
            $solicita = $this->modelo->eliminar_venta($id_venta);
            $data = array("status" => true, "msg"=>"Venta elimada");
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function ventas_por_vendedor(){
        $nombre_usuario=$_SESSION['nombre_usuario'];
        $data = $this->modelo->ventas_realizadas_por_vendedor($nombre_usuario);
        for ($i = 0; $i < count($data); $i++) {
            $fecha = $data[$i]["FECHA_VENTA"];
            $fecha_venta = date_create("$fecha");
            $data[$i]["FECHA_VENTA"] = date_format($fecha_venta, "d/m/Y H:i A");
            $data[$i]["TIPO_VENTA"] = $data[$i]["TIPO_VENTA"] == 0 ? "Al por mayor" : "Venta normal";
            $data[$i]["TOTAL_PAGADO"] = round($data[$i]["TOTAL_PAGADO"], 2);
            $total = $data[$i]["TOTAL_PAGADO"];
            $data[$i]["TOTAL_PAGADO"] = "S/. $total";
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ventas_hoy(){
        $data = $this->modelo->ventas_realizadas_hoy();
        for ($i = 0; $i < count($data); $i++) {
            $hora = $data[$i]["Hora"];
            $hora_venta =date_create("$hora");;
            $data[$i]["Hora"] = date_format($hora_venta, "H:i A");
            $data[$i]["TIPO_VENTA"] = $data[$i]["TIPO_VENTA"] == 0 ? "Al por mayor" : "Venta normal";
            $data[$i]["TOTAL_PAGADO"] = round($data[$i]["TOTAL_PAGADO"], 2);
            $total = $data[$i]["TOTAL_PAGADO"];
            $data[$i]["TOTAL_PAGADO"] = "S/. $total";
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function grafico_cajeros()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST["fechaInicial"])){
                $fechaInicial = $_POST["fechaInicial"];
                $fechaFinal = $_POST["fechaFinal"];
            }else{
                $fechaInicial = null;
                $fechaFinal = null;
            }
            $solicitud = $this->modelo->reporte_cajeros($fechaInicial, $fechaFinal);
            $arrayNombre=array();
            $arrayVentas = array();
            $sumaPagosCajero = [];
            
            for ($i = 0; $i < count($solicitud); $i++) {
                $fecha=substr($solicitud[$i]["FECHA_VENTA"],0,7);
                array_push($arrayNombre, $solicitud[$i]["NOMBRE_CAJERO"]);
                $solicitud[$i]["TOTAL_PAGADO"]=round($solicitud[$i]["TOTAL_PAGADO"], 2);
                $arrayVentas = array($solicitud[$i]["NOMBRE_CAJERO"] => $solicitud[$i]["TOTAL_PAGADO"]);
                #Sumamos los pagos que ocurrieron por el mismo cajero
                foreach ($arrayVentas as $key => $value) {
                    if (array_key_exists($key, $sumaPagosCajero)) {
                        $sumaPagosCajero[$key] += $value;
                    }else{
                        $sumaPagosCajero+= [$key => $value];
                    }
                    
                }
            }
            $noRepetirNombres = array_unique($arrayNombre);
            foreach($noRepetirNombres as $key){
                $sumaPagosCajero[$key]=round($sumaPagosCajero[$key],2);
                // $fechaEntera = strtotime($key);
                // $mes=valorMes(date("m", $fechaEntera));
                $data[]=array("y"=>$key,"ventas"=>$sumaPagosCajero[$key]);
            }
            if ($solicitud==null) {
                $data[]=array("y"=>0,"ventas"=>0);
            }
        } else {
            $data = array("status" => false, "msg" => "Error creacion.");
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function grafico_vendedores()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST["fechaInicial"])){
                $fechaInicial = $_POST["fechaInicial"];
                $fechaFinal = $_POST["fechaFinal"];
            }else{
                $fechaInicial = null;
                $fechaFinal = null;
            }
            $solicitud = $this->modelo->reporte_vendedores($fechaInicial, $fechaFinal);
            $arrayNombre=array();
            $arrayVentas = array();
            $sumaPagosCajero = [];
            
            for ($i = 0; $i < count($solicitud); $i++) {
                $fecha=substr($solicitud[$i]["FECHA_VENTA"],0,7);
                array_push($arrayNombre, $solicitud[$i]["Vendedor"]);
                $solicitud[$i]["TOTAL_PAGADO"]=round($solicitud[$i]["TOTAL_PAGADO"], 2);
                $arrayVentas = array($solicitud[$i]["Vendedor"] => $solicitud[$i]["TOTAL_PAGADO"]);
                #Sumamos los pagos que ocurrieron por el mismo cajero
                foreach ($arrayVentas as $key => $value) {
                    if (array_key_exists($key, $sumaPagosCajero)) {
                        $sumaPagosCajero[$key] += $value;
                    }else{
                        $sumaPagosCajero+= [$key => $value];
                    }
                    
                }
            }
            $noRepetirNombres = array_unique($arrayNombre);
            foreach($noRepetirNombres as $key){
                $sumaPagosCajero[$key]=round($sumaPagosCajero[$key],2);
                // $fechaEntera = strtotime($key);
                // $mes=valorMes(date("m", $fechaEntera));
                $data[]=array("y"=>$key,"ventas"=>$sumaPagosCajero[$key]);
            }
            if ($solicitud==null) {
                $data[]=array("y"=>0,"ventas"=>0);
            }
        } else {
            $data = array("status" => false, "msg" => "Error creacion.");
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


}
