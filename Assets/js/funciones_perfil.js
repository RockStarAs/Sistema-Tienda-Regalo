document.addEventListener('DOMContentLoaded',function(){
    var form_usuario_password = document.querySelector('#frm_cambia_password');
    form_usuario_password.onsubmit = function(e){
        e.preventDefault();
        //No revisar aquí porque se podría ver el hash
        var password_usuario = document.querySelector('#txt_password_antigua').value;
        var password_usuario_nuevo = document.querySelector('#txt_password_nueva').value;
        var password_usuario_nuevo_rep = document.querySelector('#txt_password_nueva_rep').value;

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajax_url = base_url+'usuario/cambiar_password';
        var form_data = new FormData(form_usuario_password);
        request.open("POST",ajax_url,true);
        request.send(form_data);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var json = JSON.parse(request.responseText);
                if(json.status){
                    $('#modal_form_cambiar_contraseña').modal('hide');
                    form_usuario_password.reset();
                    swal("Actualizado",json.msg,"success"); 
                }else{
                    swal("¡Error!",json.msg,"error");    
                } 
            }
        }
    }
});



function abrir_modal(){
    $('#modal_form_cambiar_contraseña').modal('show'); 
}
