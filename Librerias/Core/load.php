<?php 
    $archivo_controlador = "Controlador/".$controlador.".php";
        if(file_exists($archivo_controlador)){
            require_once($archivo_controlador);
            $controlador = new $controlador();
            if(method_exists($controlador,$metodo)){
                $controlador->{$metodo}($parametros);
            }else{
                require_once("Controlador/error.php");
            }
        }else{
            require_once("Controlador/error.php");
        }   
?>