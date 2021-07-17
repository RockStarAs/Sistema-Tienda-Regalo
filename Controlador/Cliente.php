<?php
class Cliente extends Controladores
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            header('location: ' . base_url() . 'login');
        }
        parent::__construct();
    }
    public function gestionar_clientes()
    {
        $data["titulo_pagina"] = "Gestión de Clientes";
        $data["nombre_pagina"] = "Sistema Tienda :: Clientes";
        $data["funciones_js"] = "funciones_clientes.js";
        //$data = $this->modelo->modelo_inserta_usuario("75541205","Juan","Ortelli","caja2","caja2","CAJERO");

        $this->vistas->obten_vista($this, "gestionar_clientes", $data);
    }
    public function insertar_cliente()
    {
        $dni_cliente = limpiar_str($_POST['txt_dni_cliente']);
        $nombre_cliente = limpiar_str($_POST['txt_nombre_cliente']);
        $apellido_cliente = limpiar_str($_POST['txt_apellido_cliente']);
        $telefono_contacto = limpiar_str($_POST['txt_telefono_contacto']);

        $solicitud_insertar = $this->modelo->modelo_inserta_cliente($dni_cliente, $nombre_cliente, $apellido_cliente, $telefono_contacto);

        if ($solicitud_insertar > 0) {
            $array_respuesta = array('status' => true, 'msg' => "Datos guardados correctamente.", 'id' => $dni_cliente);
        } else {
            if ($solicitud_insertar == 'exist') {
                $array_respuesta = array('status' => false, 'msg' => "Atención el DNI o RUC ya está registrado");
            } else {
                $array_respuesta = array('status' => false, 'msg' => "No es posible almacenar datos.");
            }
        }
        echo json_encode($array_respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function modificar_cliente()
    {
        $dni_cliente_viejo = $_POST['txt_dni_antiguo_act'];

        $dni_cliente_nuevo = $_POST['txt_dni_antiguo_act'];
        $nombre_cliente = $_POST['txt_nombre_cliente_act'];
        $apellidos_cliente = $_POST['txt_apellido_cliente_act'];
        $telefono_contacto = $_POST['txt_telefono_contacto_act'];

        /*$dni_cliente_viejo,
        $dni_cliente_nuevo,
        $nombre_cliente,
        $apellidos_cliente,
        $telefono_contacto */
        $solicitud_modificar = $this->modelo->modelo_actualiza_cliente($dni_cliente_viejo, $dni_cliente_nuevo, $nombre_cliente, $apellidos_cliente, $telefono_contacto);

        $array_respuesta = array('status' => true, 'msg' => "Datos actualizados correctamente.");

        echo json_encode($array_respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar_clientes()
    {
        $data = $this->modelo->modelo_listar_cliente();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['opciones'] = mostrar_acciones($data[$i]["dni_cliente"], "actualizaCliente", "","", 1);
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function devolver_clientes()
    {
        $htmlOpciones = "";
        $arrayDatos = $this->modelo->modelo_listar_cliente();
        if (count($arrayDatos) > 0) {
            for ($i = 0; $i < count($arrayDatos); $i++) {
                $htmlOpciones .= '<option value="' . $arrayDatos[$i]['dni_cliente'] . '">' . $arrayDatos[$i]['dni_cliente'] . '</option>';
            }
        }
        echo $htmlOpciones;
        die();
    }

    public function busca_cliente($dni_cliente)
    {
        $data = $this->modelo->modelo_busca_cliente($dni_cliente);
        if (empty($data)) {
            $respuesta = array('status' => false,
                'msg' => 'Datos no encontrados.',
            );
        } else {
            $respuesta = array('status' => true,
                'data' => $data,
            );
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function elimina_cliente()
    {
        $data = $this->modelo->modelo_elimina_cliente("73011516");
        $this->vistas->obten_vista($this, "ver_cliente", $data);
    }

    public function reporte_clientes()
    {
        if ($_GET) {
            $solicitud = $this->modelo->modelo_reporte_clientes();

            if ($solicitud == null) {
                $data[] = array("y" => 0, "compras" => 0);
            } else {
                
                for ($i = 0; $i < count($solicitud); $i++) {
                    $apellidos = explode(' ', $solicitud[$i]["DATOS_CLIENTE"]);
                    $data[] = array("y" => $apellidos[0]." ".$apellidos[1], "compras" => $solicitud[$i]["Compra"]);
                }
            }
        } else {
            $data = array("status" => false, "msg" => "Error creacion.");
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
