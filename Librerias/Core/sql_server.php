<?php 
    class sql_server extends Conexion{
        private $conexion;
        private $cadena_query;
        private $array_valores;
        
        function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conexion_bd();
        }
        public function insert($query,$arreglo_valores){
            $this->cadena_query = $query;
            $this->array_valores = $arreglo_valores;
            $insert = $this->conexion->prepare($this->cadena_query);
            $insert_valores = $insert->execute($this->array_valores);
            if($insert_valores){
                $despues_insert = $this->conexion->lastInsertId();
            }else{
                $despues_insert = 0;
            }
            //Regresando el último id insertado
            return $despues_insert;
        }
        public function update($query,$arreglo_valores){
            $this->cadena_query = $query;
            $this->array_valores = $arreglo_valores;
            $update = $this->conexion->prepare($this->cadena_query);
            $resultado_update = $update->execute($this->array_valores);
            return  $resultado_update;
        }
        public function select_one($query){
            $this->cadena_query = $query;
            $selecciona_uno = $this->conexion->prepare($this->cadena_query);
            $selecciona_uno->execute();
            $data = $selecciona_uno->fetch(PDO::FETCH_ASSOC);
            //Regresa el elemento 
            return $data;
        }
        public function select_all($query){
            $this->cadena_query = $query;
            $selecciona_todo = $this->conexion->prepare($this->cadena_query);
            $selecciona_todo->execute();
            $resultados = $selecciona_todo->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        }
        public function delete($query){
            $this->cadena_query = $query;
            $resultado = $this->conexion->prepare($this->cadena_query);
            $resultado->execute();
            return $resultado;
        }
        public function agregar_sin_valores($query){
            $this->cadena_query = $query;
            $resultado = $this->conexion->prepare($this->cadena_query);
            $resultado->execute();
            return $resultado;
        }
    }
?>