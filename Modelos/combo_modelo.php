<?php
    class combo_modelo extends sql_server{
        public function __construct(){
            parent::__construct();
        }

        public function modelo_insertar_combo($nombre_combo,$descripcion="",$precio,$stock){
            $query="INSERT INTO combo(nombre_combo,descripcion_combo,precio_combo,stock_combo) 
            VALUES (?,?,?,?)";
            $valores=array($nombre_combo,$descripcion,$precio,$stock);
            $solicita_insert = $this->insert($query,$valores);
            return $solicita_insert;
        }
        
        
        public function modelo_actualizar_combo($id_combo,$nombre_combo,$descripcion,$precio,$stock){
            $query="UPDATE combo SET nombre_combo=?,descripcion_combo=?,precio_combo=?,stock_combo=? 
            WHERE id_combo=?";
            $valores=array($nombre_combo,$descripcion,$precio,$stock,$id_combo);
            $solicita_update = $this->update($query,$valores);
            return $solicita_update;
        }

        public function modelo_listar_combos(){
            $query = "SELECT * FROM combo";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }

        public function modelo_listar_combosActivos(){
            $query = "SELECT * FROM combo WHERE estado_combo!=0";
            $solicita_listado = $this->select_all($query);
            return $solicita_listado;
        }
 
        public function modelo_busca_combo_id($id_combo){
            $query = "SELECT * FROM combo where id_combo = $id_combo";
            $solicita_busqueda = $this->select_one($query);
            return $solicita_busqueda;
        }
        public function modelo_elimina_combo($id_combo){

        }

    }

?>