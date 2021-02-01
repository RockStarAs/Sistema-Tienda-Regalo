<?php

    function base_url(){
        return URL;
    }
    //Para cuando se quiera agregar imagenes
    //Usar <?= Sirve para no poner <?php echo
    
    function media(){
        return URL."Assets/";
    }
    function depurar($array_valores){
       $format= print_r("<pre>");
       $format.= print_r($array_valores);
       $format.= print_r("</pre>");
       return $format; 
    }
    //Cuando pasamos data sirve para los titulos y esas cosas si es que se van a  usar.
    function header_admin($data=""){
        $view_header = "Vista/Template/header_admin.php";
        require_once($view_header);
    }
    function footer_admin($data=""){
        $view_footer = "Vista/Template/footer_admin.php";
        require_once($view_footer);
    }
    function obtener_modal(string $nombre_modal,$data){
        $vista_modal = "Vista/Template/Modals/{$nombre_modal}.php";
        require_once $vista_modal;
    }
    function obtener_reporte(string $nombre_reporte,$data){
        $vista_reporte = "Vista/Template/Reportes/{$nombre_reporte}.php";
        require_once $vista_reporte;
    }
    function mostrar_acciones($id,$claseEditar="",$claseEliminar="",$clase_compra="",$num = 0){
        switch ($num){
            case 0:{
                return '<div class="text-center">
                    <button class="btn btn-outline-warning btn-sm '.$claseEditar.'" rl="'.$id.'" title="Editar" type="button">✏️</button>
                    <button class="btn btn-outline-danger btn-sm '.$claseEliminar.'" rl="'.$id.'" title="Eliminar" type="button">❌</button>
                </div>';
            }
            case 1:{
                return '<div class="text-center">
                <button class="btn btn-outline-warning btn-sm '.$claseEditar.'" rl="'.$id.'" title="Editar" type="button">✏️</button>
                </div>';
            }
            case 3:{
                return '<div class="text-center">
                <button class="btn btn-outline-warning btn-sm '.$claseEditar.'" rl="'.$id.'" title="Editar" type="button">✏️</button>
                <button class="btn btn-outline-danger btn-sm '.$claseEliminar.'" rl="'.$id.'" title="Eliminar" type="button">❌</button>
                </div>';
                //Delete la clase compra 
                /*
                <button class="btn btn-outline-success btn-sm '.$clase_compra.'" rl="'.$id.'" title="Agregar una compa" type="button">🛒</button>                
                */
            }
            case 4:{
                
                return '<div class="text-center">
                <button class="btn btn-outline-warning btn-sm '.$claseEditar.'" rl="'.encriptar($id).'" title="Ver venta completa" type="button">👁️</button>
                <a class="btn btn-outline-success btn-sm '.$clase_compra.'" rl="'.$id.'" title="Ver el ticket" type="button"
                href="'.base_url().'pdf/genera_pdf/'.encriptar($id).'" target="blank">🎫</a>
                <button class="btn btn-outline-danger btn-sm '.$claseEliminar.'" rl="'.encriptar($id).'" title="Eliminar venta" type="button">❌</button>
                </div>';   
            }
            case 5:{
                return '<div class="text-center">
                <button class="btn btn-outline-warning btn-sm '.$claseEditar.'" rl="'.encriptar($id).'" title="Ver venta completa" type="button">👁️</button>
                <a class="btn btn-outline-success btn-sm '.$clase_compra.'" rl="'.$id.'" title="Ver el ticket" type="button"
                href="'.base_url().'pdf/genera_pdf/'.encriptar($id).'" target="blank">🎫</a>
                </div>';
            }
        }    
    }
    function limpiar_str($strCadena){
        $string = preg_replace('/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i', '', $strCadena);
        $string=trim($string);
        $string=stripslashes($string);
        $string=str_ireplace("<script>","",$string);
        $string=str_ireplace("</script>","",$string);
        $string=str_ireplace("<script src>","",$string);
        $string=str_ireplace("<script type=>","",$string);
        $string=str_ireplace("SELECT * FROM","",$string);
        $string=str_ireplace("DELETE FROM","",$string);
        $string=str_ireplace("INSERT INTO","",$string);
        $string=str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string=str_ireplace("DROP TABLE","",$string);
        $string=str_ireplace("OR '1'='1","",$string);
        $string=str_ireplace('OR "1"="1"',"",$string);
        $string=str_ireplace('OR ´1´=´1´',"",$string);
        $string=str_ireplace("is NULL; --","",$string);
        $string=str_ireplace("is NULL; --","",$string);
        $string=str_ireplace("LIKE '","",$string);
        $string=str_ireplace('LIKE "',"",$string);
        $string=str_ireplace("LIKE ´","",$string);
        $string=str_ireplace("OR 'a'='a","",$string);
        $string=str_ireplace('OR "a"="a"',"",$string);
        $string=str_ireplace("OR ´a´=´a","",$string);
        $string=str_ireplace("OR ´a´=´a","",$string);
        $string=str_ireplace("--","",$string);
        $string=str_ireplace("^","",$string);
        $string=str_ireplace("[","",$string);
        $string=str_ireplace("]","",$string);
        $string=str_ireplace("==","",$string);
        return $string;
    }
    function generador_password($length=5){
        $pass="";
        $longitudPass=$length;
        $cadena="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);
        for($i=1;$i<=$longitudPass;$i++){
            $pos=rand(0,$longitudCadena-1);
            $pass.=substr($cadena,$pos,1);
        }
        return $pass;
    }

    function token(){
        $r1=bin2hex(random_bytes(10));
        $r2=bin2hex(random_bytes(10));
        $r3=bin2hex(random_bytes(10));
        $r4=bin2hex(random_bytes(10));
        $token=$r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }

    function formatea_moneda($cantidad){
        $cantidad=number_format($cantidad,2,SPD,SPM);
        return $cantidad;
    }

    function encriptar($valor){
        $iv=base64_decode("C9fBxl1EWtYTL1/M8jfstw==");
        return openssl_encrypt ($valor, METHOD,CLAVE, false, $iv);
    }

    function desencriptar($valor){
        $valor=str_replace(" ","+",$valor);
        $valor=str_replace(",","/",$valor);
        $iv=base64_decode("C9fBxl1EWtYTL1/M8jfstw==");
        $encrypted_data = base64_decode($valor);
        return openssl_decrypt($valor, METHOD, CLAVE, false, $iv);
    }
?>
