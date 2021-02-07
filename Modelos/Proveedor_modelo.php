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
            $return ="";
            $query = "SELECT * FROM proveedor WHERE ruc_dni = '$ruc_dni'";
            $solicita_listado = $this->select_all($query);
            if(empty($solicita_listado)){
                if(VERSION_BD == "MySQL"){
                    $query = "INSERT INTO proveedor(ruc_dni,nombre_proveedor,telefono_contacto,email_proveedor,ciudad_ubicacion,direccion_ubicacion,estado_proveedor) values ('$ruc_dni','$nombre_proveedor','$telefono_contacto','$email_proveedor','$ciudad_ubicacion','$direccion_ubicacion',1)";
                    $solicita_insert = $this->agregar_sin_valores($query);
                    
                }else{
                $query = "INSERT INTO proveedor(
                    ruc_dni,
                    nombre_proveedor,
                    telefono_contacto,
                    email_proveedor,
                    ciudad_ubicacion,
                    direccion_ubicacion,
                    estado_proveedor
                    ) 
                    values (?,?,?,?,?,?,?)";
                $valores = array($ruc_dni,$nombre_proveedor,$telefono_contacto,$email_proveedor,$ciudad_ubicacion,$direccion_ubicacion,1);
                $solicita_insert = $this->insert($query,$valores);
                }
                $return = 1;
            }else{
                $return = "exist";
            }
            return $return;
        }
        public function modelo_actualiza_proveedor(
            $ruc_dni_viejo,
            $ruc_dni_nuevo,
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
                    direccion_ubicacion = ?,
                    ruc_dni = ?
                    WHERE ruc_dni = ?
                    ";
            $valores = array($nombre_proveedor,$telefono_contacto,$email_proveedor,$ciudad_ubicacion,$direccion_ubicacion,$ruc_dni_nuevo,$ruc_dni_viejo);
            
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }
        public function modelo_listar_proveedor(){
            $query = "SELECT * FROM proveedor where estado_proveedor != 0";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_busca_proveedor($ruc_dni){
            $query = "SELECT * FROM  proveedor WHERE ruc_dni = '$ruc_dni'";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        
        public function modelo_elimina_proveedor($ruc_dni){
           
            $query = "UPDATE proveedor SET estado_proveedor = 0 where ruc_dni = '$ruc_dni'";
            $solicita_borrado = $this->delete($query);
            return $solicita_borrado;
        }
    }
?>
