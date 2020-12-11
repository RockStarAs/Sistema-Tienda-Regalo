<?php
    require_once('Config/config.php');
    require_once('Helpers/helpers.php');
    $url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';
    $arr_url = explode("/",$url);
    
    $controlador = $arr_url[0];
    $metodo = $arr_url[0];
    $parametros = "";
    if(!empty($arr_url[1])){
        if($arr_url[1]!=""){
            $metodo = $arr_url[1];
        }
    }
    if(!empty($arr_url[2])){
        if($arr_url[2] != ""){
            for ($i=2; $i < count($arr_url) ; $i++) { 
                $parametros .= $arr_url[$i].','; 
            }
            $parametros = trim($parametros,',');
        }
    }
    require_once("Librerias/Core/autoload.php");
    require_once("Librerias/Core/load.php");

?>