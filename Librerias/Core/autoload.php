<?php 
    spl_autoload_register(function($clase){
        if(file_exists(LIBS.'Core/'.$clase.".php")){
            require_once(LIBS.'Core/'.$clase.".php");
        }
    });
?>