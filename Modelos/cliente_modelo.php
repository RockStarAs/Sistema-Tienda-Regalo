<?php
    class cliente_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }
        public function modelo_inserta_cliente(
            $dni_cliente,
            $nombre_cliente,
            $apellidos_cliente,
            $telefono_contacto
        ){
            $query = "INSERT INTO cliente(
                dni_cliente,
                nombre_cliente,
                apellidos_cliente,
                telefono_contacto
                ) 
                values (?,?,?,?)";
            $valores = array($dni_cliente,$nombre_cliente,$apellidos_cliente,$telefono_contacto);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        public function modelo_actualiza_cliente(
            $dni_cliente,
            $nombre_cliente,
            $apellidos_cliente,
            $telefono_contacto
            ){
            $query = "UPDATE cliente SET
                    nombre_cliente = ?,
                    apellidos_cliente = ?,
                    telefono_contacto = ?
                    WHERE dni_cliente = ?
                    ";
            $valores = array($nombre_cliente,$apellidos_cliente,$telefono_contacto,$dni_cliente);
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }
        public function modelo_listar_cliente(){
            $query = "SELECT * FROM cliente";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_busca_cliente($dni_cliente){
            $query = "SELECT * FROM  cliente WHERE dni_cliente = '$dni_cliente'";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        
        public function modelo_elimina_cliente($dni_cliente){
            $query = "DELETE FROM cliente WHERE dni_cliente = '$dni_cliente'";
            $solicita_borrado = $this->delete($query);
            return $solicita_borrado;
        }
    }
?>