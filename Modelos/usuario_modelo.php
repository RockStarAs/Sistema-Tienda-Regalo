<?php
    class usuario_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }
        public function modelo_inserta_usuario(
            $dni_trabajador,
            $nombre_trabajador,
            $apellidos_trabajador,
            $nombre_usuario,
            $password_usuario,
            $rol_usuario
        ){
            //Función para agregar un nuevo usuario
            //Estado de usuario no es necesario porque por defecto está en 1 en la base de datos
            //Sacando la fecha creación
            $fecha_creacion = date("Y-m-d H:i:s");
            $ultima_conexion = date("Y-m-d H:i:s");  
            $query = "INSERT INTO usuario(
                dni_trabajador,
                nombre_trabajador,
                apellidos_trabajador,
                nombre_usuario,
                password_usuario,
                rol_usuario,
                fecha_creacion,
                ultima_conexion) 
                values (?,?,?,?,?,?,?,?)";
            $valores = array($dni_trabajador,$nombre_trabajador,$apellidos_trabajador,$nombre_usuario,$password_usuario,$rol_usuario,$fecha_creacion,$ultima_conexion);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        public function modelo_actualiza_usuario($dni_trabajador,$nombre_trabajador,$apellidos_trabajador,$nombre_usuario,$password_usuario,$rol_usuario,$estado_usuario,$id_usuario){
            //No actualizaremos la fecha de creación nunca, la última conexión se hará en una función aparte
            $query = "UPDATE usuario SET
                    dni_trabajador = ?,
                    nombre_trabajador = ?,
                    apellidos_trabajador = ?,
                    nombre_usuario = ?,
                    password_usuario = ?,
                    rol_usuario = ?,
                    estado_usuario = ?
                    WHERE id_usuario = ?
                    ";
            $valores = array($dni_trabajador,$nombre_trabajador,$apellidos_trabajador,$nombre_usuario,$password_usuario,$rol_usuario,$estado_usuario,$id_usuario);
            
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }
        public function modelo_listar_usuarios(){
            $query = "SELECT * FROM usuario";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
        public function modelo_busca_usuario_dni($dni_trabajador){
            $query = "SELECT * FROM  usuario WHERE dni_trabajador = '$dni_trabajador'";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_busca_usuario_id($id_usuario){
            $query = "SELECT * FROM usuario where id_usuario = $id_usuario";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_elimina_usuario($id){

        }
        /*public function get_carrito($parametros){
            return "Datos recibidos del carrito Nro." . $parametros;
        }
        public function set_categoria($nombre_cat,$descripcion_cat,$estado_cat){
            $query = "INSERT INTO categoria_producto(nombre_categoria,descripcion_categoria,estado_categoria) values (?,?,?)";
            $valores = array($nombre_cat,$descripcion_cat,$estado_cat);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        public function get_categoria($id_categoria){
            $query = "SELECT * FROM categoria_producto WHERE id_categoria = $id_categoria";
            $solicita_select = $this->select_one($query);
            return $solicita_select;
        }*/
    }
?>