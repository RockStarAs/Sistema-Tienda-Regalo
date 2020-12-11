<?php
    class venta_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }
        public function modelo_inserta_venta(
            $id_usuario,
            $id_usuario_atiende,
            $dni_cliente
        ){
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
        public function modelo_listar_venta(){
            $query = "SELECT * FROM venta";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_busca_venta($id_venta){
            $query = "SELECT * FROM  venta WHERE id_venta = $id_venta";
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