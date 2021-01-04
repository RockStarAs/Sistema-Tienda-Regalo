var tabla_clientes;
document.addEventListener('DOMContentLoaded',function(){
    tabla_clientes = $('#tabla_clientes').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language":{
            url : " " + base_url + "assets/js/idioma.json"
        },
        "ajax":{
            "url" : " "+base_url+"cliente/listar_clientes",
            "dataSrc":""  
        },
        "columns": [ 
            { "data": "dni_cliente" }, 
            { "data": "nombre_cliente" },
            { "data": "apellidos_cliente" }, 
            { "data": "telefono_contacto" },
            { "data": "opciones" }
        ],
        "responsive":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]],
        drawCallback:function(){
            fnc_editar_cliente();
        }
    });
    var form_clientes = document.querySelector('#frm_agregar_cliente');
    form_clientes.onsubmit = function(e){
        e.preventDefault();
        var dni_cliente = document.querySelector('#txt_dni_cliente').value;
        var nombre_cliente = document.querySelector('#txt_nombre_cliente').value;
        var apellido_cliente = document.querySelector('#txt_apellido_cliente').value;
        var telefono_cliente = document.querySelector('#txt_telefono_contacto').value;
        
        if(dni_cliente.length != 8 ){
            swal("Atención","El campo del DNI o RUC debe tener (8) o (11) dígitos respectivamente.","error");
            return false;
        }
        if(dni_cliente == '' || nombre_cliente == '' || apellido_cliente == '' || telefono_cliente == ''){
            swal("Atención","Campo obligatorios.","error");
            return false;    
        }        
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajax_url = base_url+'cliente/insertar_cliente';
        var form_data = new FormData(form_clientes);
        request.open("POST",ajax_url,true);
        request.send(form_data);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var json = JSON.parse(request.responseText); 
                if(json.status){
                    $('#modal_agregar_cliente').modal('hide');
                    form_clientes.reset();
                    swal("Añadido",json.msg,"success");
                    tabla_clientes.ajax.reload(function(){
                        //Importante para que se carguen todas los editar de los usuarios cuando se agregan
                        setTimeout(()=>{
                            fnc_editar_cliente();
                        },500);
                    });
                }else{
                    swal("¡Error!",json.msg,"error");   
                }
            }
        }
    }
    var form_cliente_modifica = document.querySelector('#frm_actualiza_cliente');
    form_cliente_modifica.onsubmit = function(e){
        e.preventDefault();
        
        var dni_cliente = document.querySelector('#txt_dni_cliente_act').value;
        var nombre_cliente = document.querySelector('#txt_nombre_cliente_act').value;
        var apellido_cliente = document.querySelector('#txt_apellido_cliente_act').value;
        var telefono_cliente = document.querySelector('#txt_telefono_contacto_act').value;
        if(dni_cliente == ''){
            swal("Atención","Los campos (DNI) son obligatorios.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajax_url = base_url+'cliente/modificar_cliente';
        var form_data = new FormData(form_cliente_modifica);
        request.open("POST",ajax_url,true);
        request.send(form_data);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var json = JSON.parse(request.responseText);
                if(json.status){
                    $('#modal_actualiza_cliente').modal('hide');
                    form_cliente_modifica.reset();
                    swal("Actualizado",json.msg,"success");
                    tabla_clientes.ajax.reload(function(){
                        //Importante para que se carguen todas los editar de los usuarios cuando se agregan
                        setTimeout(()=>{
                            fnc_editar_cliente();
                        },500);
                    });
                }else{
                    swal("¡Error!",json.msg,"error");    
                }
            }
        }
    }

}); 

$('#tabla_clientes').DataTable();
function abrir_modal(){
    $('#modal_agregar_cliente').modal('show');
}
window.addEventListener('load',function(){
    setTimeout(() => { 
        fnc_editar_cliente();
    },500);
},false);
function fnc_editar_cliente(){
    var btn_editar_cliente = document.querySelectorAll(".actualizaCliente");
    btn_editar_cliente.forEach(function(btn_editar_cliente){
        btn_editar_cliente.addEventListener('click',function(){
            var dni_buscar = this.getAttribute('rl');
            var solicitud = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajax_url = base_url+'cliente/busca_cliente/'+dni_buscar;
            solicitud.open("GET",ajax_url,true);
            solicitud.send();
            solicitud.onreadystatechange = function(){
                if(solicitud.readyState == 4 && solicitud.status == 200){
                    var obj_data = JSON.parse(solicitud.responseText);
                    if(obj_data.status){
                        document.querySelector("#txt_dni_antiguo_act").value = obj_data.data.dni_cliente;
                        document.querySelector("#txt_dni_cliente_act").value = obj_data.data.dni_cliente;
                        document.querySelector("#txt_nombre_cliente_act").value = obj_data.data.nombre_cliente;
                        document.querySelector("#txt_apellido_cliente_act").value = obj_data.data.apellidos_cliente;
                        document.querySelector("#txt_telefono_contacto_act").value = obj_data.data.telefono_contacto;
                        
                        $('#modal_actualiza_cliente').modal('show');
                    }else{
                        swal("Error",obj_data.msg,"error");
                    }
                }
            }
            
        });
    });
}