// Login Page Flipbox control
$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
  	    return false;
});
document.addEventListener('DOMContentLoaded',function(){
    if(document.querySelector("#formulario_login")){

        let formulario_login = document.querySelector("#formulario_login");
        formulario_login.onsubmit = function(e){
            e.preventDefault();
            
            let usuario = document.querySelector("#usuario_id").value;
            let password = document.querySelector("#usuario_password").value;

            if(usuario == "" || password == ""){
                swal("Por favor","Ingresa usuario y contraseña para poder acceder.","error");
                return false;
            }else{
                var solicitud = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajax_url = base_url+'login/loguea_usuario';
                var form_data = new FormData(formulario_login);
                solicitud.open("POST",ajax_url,true);
                solicitud.send(form_data);
                solicitud.onreadystatechange = function(){
                    if(solicitud.readyState != 4)return;
                    if(solicitud.status == 200){
                        var obj_json = JSON.parse(solicitud.response);
                        if(obj_json.status){
                            window.location = base_url+'dashboard';
                        }else{
                            swal("Atencion",obj_json.msg,"error");
                            document.querySelector("#usuario_password").value = "";
                        }
                    }else{
                        swal("Atención","Error en el proceso","error");
                    }
                    return false;
                
                }
            }   
        }
    }
},false);
