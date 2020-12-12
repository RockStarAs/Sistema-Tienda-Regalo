<?php 
    class Vistas{
        function obten_vista($controlador,$vista,$data=""){
            $controlador = get_class($controlador);
            if($controlador == "Home" ){
                $vista = VIEWS.$vista.".php";
            }else{
                $vista = VIEWS.$controlador."/".$vista.".php";
            }
            require_once($vista);
        }
    }
?>