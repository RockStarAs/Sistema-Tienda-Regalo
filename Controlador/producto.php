<?php
    class Producto extends Controladores{
        function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header('location: '.base_url().'login');
            }
            parent::__construct();
        }

    public function gestionar_productos()
    {
        $data["titulo_pagina"] = "Gestion de Productos";
        $data["nombre_pagina"] = "Productos :: Gestión Productos";
        $data["funciones_js"] = "funciones_producto.js";
        $this->vistas->obten_vista($this, "gestionar_productos", $data);
    }

    public function insertar_producto()
    {
        $nombre_producto = limpiar_str($_POST['txt_nombre']);
        $codigo_barras = limpiar_str($_POST['txtCodigo']);
        $descripcion_producto = limpiar_str($_POST['txt_descripcion']);
        $precio_unitario_venta = floatval(limpiar_str($_POST['txt_precio_venta']));
        $precio_compra = floatval(limpiar_str($_POST['txt_precio_compra']));
        $stock_producto = intval(limpiar_str($_POST['txt_stock']));
        $id_categoria = intval(limpiar_str($_POST['categoria_id']));
        $id_producto = limpiar_str($_POST['id_producto']);
        
        $foto=$_FILES["foto"];
        $nombre_foto=$foto["name"];
        $type=$foto["type"];
        $url_temp=$foto["tmp_name"];
        depurar($foto);
        $imgProducto="img_producto.png";

        if ($nombre_foto!='') {
            $destino="./Assets/images/uploads/";
            $img_nombre="img_".md5(date('d-m-Y H:m:s'));
            $imgProducto=$img_nombre.".jpg";
            $src=$destino.$imgProducto;
        } 

        // if ($id_producto == 0) {
        //     //Insertar
        //     $solicitud_insertar = $this->modelo->modelo_insertar_producto($id_categoria, $nombre_producto, $precio_unitario_venta, $stock_producto, $precio_compra, $descripcion_producto, $imgProducto,$codigo_barras);
        //     $opcion = 1;
        // }
        // if ($solicitud_insertar > 0) {
        //     if ($opcion == 1) {
        //         if($nombre_foto!=""){
        //             move_uploaded_file($url_temp,$src);
        //         }
        //         $array_respuesta = array('status' => true, 'msg' => "Producto guardado correctamente.");
        //     } else {
        //         $array_respuesta = array('status' => true, 'msg' => "Producto actualizado correctamente.");
        //     }
        // } else {
        //     $array_respuesta = array('status' => false, 'msg' => "No es posible almacenar datos.");
        // }
        // echo json_encode($array_respuesta, JSON_UNESCAPED_UNICODE);
        // die();
    }

    public function modificar_producto()
    {
        $nombre_producto = limpiar_str($_POST['txt_nombre_act']);
        $descripcion_producto = limpiar_str($_POST['txt_descripcion_act']);
        $precio_unitario_venta = floatval(limpiar_str($_POST['txt_precio_venta_act']));
        $precio_compra = floatval(limpiar_str($_POST['txt_precio_compra_act']));
        $stock_producto = intval(limpiar_str($_POST['txt_stock_act']));
        $id_categoria = intval(limpiar_str($_POST['categoria_id_act']));
        $id_producto = limpiar_str($_POST['id_producto_act']);
        $foto_actual = limpiar_str($_POST['foto_actual']);
        $foto_remove = limpiar_str($_POST['foto_remove']);

        $foto=$_FILES["foto_act"];
        $nombre_foto=$foto["name"];
        $type=$foto["type"];
        $url_temp=$foto["tmp_name"];
        depurar($foto);
        //Actualizar
        // $solicitud_insertar = $this->modelo->modelo_actualizar_producto($id_producto, $id_categoria, $nombre_producto, $precio_unitario_venta, $stock_producto, $precio_compra, $descripcion_producto);
        // $opcion = 2;

        // if ($solicitud_insertar > 0) {
        //     if ($opcion == 1) {
        //         $array_respuesta = array('status' => true, 'msg' => "Producto guardado correctamente.");
        //     } else {
        //         $array_respuesta = array('status' => true, 'msg' => "Producto actualizado correctamente.");
        //     }
        // } else {
        //     $array_respuesta = array('status' => false, 'msg' => "No es posible almacenar datos.");
        // }
        // echo json_encode($array_respuesta, JSON_UNESCAPED_UNICODE);
        // die();
    }

    public function seleccionar_producto($id_producto)
    {
        $int_id_prod = intval(limpiar_str($id_producto)); //convertir a entero
        if ($int_id_prod > 0) {
            $arrayDatos = $this->modelo->modelo_seleccionar_producto($int_id_prod);
            if (empty($arrayDatos)) {
                $array_respuesta = array('status' => false, 'msg' => "Datos no encontrados.");
            } else {
                $array_respuesta = array('status' => true, 'data' => $arrayDatos);
            }
            echo json_encode($array_respuesta, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    public function listar_productos()
    {
        $data = $this->modelo->modelo_listar_productos();
        for ($i = 0; $i < count($data); $i++) {
            $nombre = $this->modelo->modelo_nombre_Categorias($data[$i]['id_categoria']);
            $data[$i]['id_categoria'] = $nombre['nombre_categoria'];
            if ($data[$i]['estado_producto'] == 1) {
                $data[$i]['estado_producto'] = " <span class='badge badge-success'> Activo </span> ";
            } else {
                $data[$i]['estado_producto'] = " <span class='badge badge-danger'>  Inactivo </span> ";
            }
            $data[$i]['precio_unitario_venta'] = SMONEY . formatea_moneda($data[$i]['precio_unitario_venta']);
            $data[$i]['precio_compra_actualizado'] = SMONEY . formatea_moneda($data[$i]['precio_compra_actualizado']);
            $data[$i]['opciones'] = mostrar_acciones($data[$i]["id_producto"], "btnEditar_Producto", "btnEliminar_Producto");
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function listar_productos_v2()
    {
        $data = $this->modelo->modelo_listar_productos();
        for ($i = 0; $i < count($data); $i++) {
            $nombre = $this->modelo->modelo_nombre_Categorias($data[$i]['id_categoria']);
            $data[$i]['id_categoria'] = $nombre['nombre_categoria'];
            if ($data[$i]['estado_producto'] == 1) {
                $data[$i]['estado_producto'] = " <span class='badge badge-success'> Activo </span> ";
            } else {
                $data[$i]['estado_producto'] = " <span class='badge badge-danger'>  Inactivo </span> ";
            }
            $data[$i]['precio_unitario_venta'] = SMONEY . formatea_moneda($data[$i]['precio_unitario_venta']);
            $data[$i]['precio_compra_actualizado'] = SMONEY . formatea_moneda($data[$i]['precio_compra_actualizado']);

            //Opcion de agregar a la lista
            $data[$i]['opciones'] = '<button class="btn btn-info" onclick="agregar_detalle('.$data[$i]['id_producto'].',\''.$data[$i]['nombre_producto'].'\')">➕</button>';
            
            
            $data[$i]['imagen_producto'] = "<img id='img' width='50' height='50' src=./../Assets/images/uploads/".$data[$i]['imagen_producto'].
            ">";
            
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function busca_producto_id()
    {
        $data = $this->modelo->modelo_busca_producto_id(2);
        $this->vistas->obten_vista($this, "ver_producto", $data);
    }

    public function busca_producto(){
        if($_POST){
            $respuesta = $this->modelo->modelo_busca_producto_nombre_id($_POST['id_producto'],$_POST['nombre_producto']);
            //Falta validar si la respuesta es vacia, si no llega nada xd
            $data= array('data' => $respuesta , 'status' => true);
        }else{
            $data = array('status' => false , 'msg' => "Error con los parametros."); 
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar_producto(){
        if ($_POST) {
            $int_id_prod=intval($_POST['id_producto']);
            $solicitud_eliminar=$this->modelo->modelo_eliminar_producto($int_id_prod);
            if ($solicitud_eliminar=='ok') {
                $array_respuesta=array('status' => true, 'msg' => "Se ha eliminado el producto");
            }else{
                $array_respuesta=array('status' => false, 'msg' => "Error al eliminar el producto");
            }
            echo json_encode($array_respuesta,JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
