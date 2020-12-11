<?php
    class proveedor_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }
        public function modelo_inserta_proveedor(
            $ruc_dni,
            $nombre_proveedor,
            $telefono_contacto,
            $email_proveedor,
            $ciudad_ubicacion,
            $direccion_ubicacion
        ){
            $query = "INSERT INTO proveedor(
                ruc_dni,
                nombre_proveedor,
                telefono_contacto,
                email_proveedor,
                ciudad_ubicacion,
                direccion_ubicacion
                ) 
                values (?,?,?,?,?,?)";
            $valores = array($ruc_dni,$nombre_proveedor,$telefono_contacto,$email_proveedor,$ciudad_ubicacion,$direccion_ubicacion);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        public function modelo_actualiza_proveedor(
            $ruc_dni,
            $nombre_proveedor,
            $telefono_contacto,
            $email_proveedor,
            $ciudad_ubicacion,
            $direccion_ubicacion
            ){
            $query = "UPDATE proveedor SET
                    nombre_proveedor = ?,
                    telefono_contacto = ?,
                    email_proveedor = ?,
                    ciudad_ubicacion = ?,
                    direccion_ubicacion = ?
                    WHERE ruc_dni = ?
                    ";
            $valores = array($nombre_proveedor,$telefono_contacto,$email_proveedor,$ciudad_ubicacion,$direccion_ubicacion,$ruc_dni);
            
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }
        public function modelo_listar_proveedor(){
            $query = "SELECT * FROM proveedor";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_busca_proveedor($ruc_dni){
            $query = "SELECT * FROM  proveedor WHERE ruc_dni = '$ruc_dni'";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        
        public function modelo_elimina_proveedor($ruc_dni){
            $query = "DELETE FROM proveedor WHERE ruc_dni = '$ruc_dni'";
            $solicita_borrado = $this->delete($query);
            return $solicita_borrado;
        }
    }
?>