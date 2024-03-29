<?php
    class producto_modelo extends conexion_bd{
        public function __construct(){
            parent::__construct();
        }
        public function modelo_insertar_producto($id_categoria,$nombre_producto,$precio_unitario_venta,$precio_por_mayor,$stock_producto,$precio_compra,$descripcion_producto,$imgContenido,$codigo_barras){
            $descripcion_producto = ($descripcion_producto=="") ? "Ninguna" : $descripcion_producto ;
            $query="INSERT INTO producto(id_categoria,nombre_producto,precio_unitario_venta,precio_venta_por_mayor,stock_producto,precio_compra_actualizado,descripcion_producto,imagen_producto,codigo_barras) 
            VALUES (?,?,?,?,?,?,?,?,?)";
            $valores=array($id_categoria,$nombre_producto,$precio_unitario_venta,$precio_por_mayor,$stock_producto,$precio_compra,$descripcion_producto,$imgContenido,$codigo_barras);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        
        
        public function modelo_actualizar_producto($id_producto,$id_categoria,$nombre_producto,$precio_unitario_venta,$precio_por_mayor,$stock_producto,$precio_compra,$descripcion_producto,$imgContenido,$codigo_barras){
            $query="UPDATE producto SET id_categoria=?,nombre_producto=?,precio_unitario_venta=?,precio_venta_por_mayor=?,stock_producto=?,precio_compra_actualizado=?,descripcion_producto=?,imagen_producto=?,codigo_barras=? 
            WHERE id_producto=?";
            $valores=array($id_categoria,$nombre_producto,$precio_unitario_venta,$precio_por_mayor,$stock_producto,$precio_compra,$descripcion_producto,$imgContenido,$codigo_barras,$id_producto);
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }

        public function modelo_listar_productos(){
            $query = "SELECT * FROM producto WHERE estado_producto != 0";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_listar_productos_stock_mayor(){
            $query = "SELECT * FROM producto WHERE estado_producto != 0 AND stock_producto > 0";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado; 
        }
        public function modelo_listar_productos_mayor(){
            $query = "SELECT * FROM producto WHERE estado_producto != 0 AND precio_venta_por_mayor != 0 AND stock_producto > 0";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_seleccionar_producto($id_producto){
            $query = "SELECT * FROM producto where id_producto = $id_producto";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }

        public function modelo_nombre_Categorias($id_categoria){
            if(VERSION_BD == "MySQL"){
                $query="SELECT categoria_producto.nombre_categoria FROM producto INNER JOIN categoria_producto
                on producto.id_categoria=categoria_producto.id_categoria WHERE producto.id_categoria=$id_categoria
                LIMIT 1";    
            }else{
                $query="SELECT TOP 1 categoria_producto.nombre_categoria FROM producto INNER JOIN categoria_producto
                on producto.id_categoria=categoria_producto.id_categoria WHERE producto.id_categoria=$id_categoria";    
            }
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_busca_producto_nombre_id($id_producto,$nombre_producto){
            $query = "SELECT * FROM producto INNER JOIN categoria_producto on producto.id_categoria = categoria_producto.id_categoria WHERE producto.id_producto = $id_producto AND producto.nombre_producto = '$nombre_producto'";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_eliminar_producto($id_producto){
            $return ="";
            $query = "UPDATE producto SET estado_producto=0 WHERE id_producto=?";
            $valores = array($id_producto);
            $return = $this->update($query,$valores);
            if ($return) {
                $return='ok';
            }else{
                $return='error';
            }      
            return $return;
        }    

        public function reporte_producto(){
            $query = "SELECT nombre_producto,imagen_producto,detalle_venta.id_producto,SUM(cantidad) as cantidad_vendida FROM detalle_venta
            INNER JOIN producto on detalle_venta.id_producto=producto.id_producto
            INNER JOIN venta on detalle_venta.id_venta=venta.id_venta
            WHERE estado_producto=1 AND YEAR(fecha_venta)=YEAR(NOW())
            GROUP BY detalle_venta.id_producto 
            ORDER BY cantidad_vendida DESC LIMIT 10";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
    }
    
?>
