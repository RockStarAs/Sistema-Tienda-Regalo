var tabla_proveedores;
document.addEventListener('DOMContentLoaded',function(){
    tabla_proveedores = $('#tabla_proveedores').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language":{
            "url" : "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url" : " "+base_url+"proveedor/listar_proveedores",
            "dataSrc":""  
        },
        "columns": [
            { "data": "ruc_dni" }, 
            { "data": "nombre_proveedor" },
            { "data": "telefono_contacto" }, 
            { "data": "email_proveedor" },
            { "data": "ciudad_ubicacion" },
            { "data": "direccion_ubicacion" },
            { "data": "opciones" }
        ],
        "responsive":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]
    });
    var form_proveedores = document.querySelector("#frm_agregar_proveedor");
    form_proveedores.onsubmit = function(e){
        e.preventDefault();
        var dni_ruc_proveedor = document.querySelector('#txt_dni_ruc').value;
        var nombre_proveedor = document.querySelector('#txt_nombre_proveedor').value;
        var email_proveedor = document.querySelector('#txt_email_proveedor').value;
        var ciudad_proveedor = document.querySelector('#txt_ciudad_proveedor').value;
        var direccion_proveedor = document.querySelector('#txt_direccion_proveedor').value;
        if(dni_ruc_proveedor.length != 8 ){
            if(dni_ruc_proveedor.length != 11){
                swal("Atención","El campo del DNI o RUC debe tener (8) o (11) dígitos respectivamente.","error");
                return false;
            }
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajax_url = base_url+'proveedor/insertar_proveedor';
        var form_data = new FormData(form_proveedores);
        request.open("POST",ajax_url,true);
        request.send(form_data);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var json = JSON.parse(request.responseText); 
                if(json.status){
                    $('#modal_form_agrega_proveedor').modal('hide');
                    form_proveedores.reset();
                    swal("Añadido",json.msg,"success");
                    tabla_proveedores.ajax.reload(function(){
                        //Importante para que se carguen todas los editar de los usuarios cuando se agregan
                        setTimeout(()=>{
                            fnc_editar_proveedor();
                        },500);
                    });
                }else{
                    swal("¡Error!",json.msg,"error");   
                }
            }
        }
    }
    //Modificar Proveedor
    var form_proveedores_actualizar = document.querySelector("#frm_actualiza_proveedor");
    form_proveedores_actualizar.onsubmit = function(e){
        e.preventDefault();
        var dni_ruc_act = document.querySelector('#txt_dni_ruc_act').value;
        var nombre_proveedor_act = document.querySelector('#txt_nombre_proveedor_act').value;
        if(dni_ruc_act == '' || nombre_proveedor_act == ''){
            swal("Atención","Los campos (DNI o RUC) y Nombre del proveedor son obligatorios.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajax_url = base_url+'proveedor/modificar_proveedor';
        var form_data = new FormData(form_proveedores_actualizar);

        request.open("POST",ajax_url,true);
        request.send(form_data);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var json = JSON.parse(request.responseText);
                if(json.status){
                    $('#modal_form_actualiza_proveedor').modal('hide');
                    form_proveedores_actualizar.reset();
                    swal("Actualizado",json.msg,"success");
                    tabla_proveedores.ajax.reload(function(){
                        //Importante para que se carguen todas los editar de los usuarios cuando se agregan
                        setTimeout(()=>{
                            fnc_editar_proveedor();
                            fnc_eliminar_proveedor();
                        },500);
                    });
                }else{
                    swal("¡Error!",json.msg,"error");    
                }
            }
        }
        
    }

});
$('#tabla_proveedores').DataTable();
function abrir_modal(){
    $('#modal_form_agrega_proveedor').modal('show');
}
window.addEventListener('load',function(){
    setTimeout(() => { 
        fnc_editar_proveedor();
        fnc_eliminar_proveedor();
    },500);
},false);

function fnc_editar_proveedor(){
    var btn_editar_proveedor = document.querySelectorAll(".actualizaProveedor");
    btn_editar_proveedor.forEach(function(btn_editar_proveedor){
        btn_editar_proveedor.addEventListener('click',function(){
            var ruc_dni_buscar = this.getAttribute("rl");
            var solicitud = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajax_url = base_url+'proveedor/busca_proveedor/'+ruc_dni_buscar;
            solicitud.open("GET",ajax_url,true);
            solicitud.send();
            solicitud.onreadystatechange = function(){
                if(solicitud.readyState == 4 && solicitud.status == 200){
                    var obj_data = JSON.parse(solicitud.responseText);
                    if(obj_data.status){
                        document.querySelector("#txt_dni_ruc_cambiar").value = obj_data.data.ruc_dni;
                        document.querySelector("#txt_dni_ruc_act").value = obj_data.data.ruc_dni;
                        document.querySelector("#txt_nombre_proveedor_act").value = obj_data.data.nombre_proveedor;
                        document.querySelector("#txt_telefono_proveedor_act").value = obj_data.data.telefono_contacto;
                        document.querySelector("#txt_email_proveedor_act").value = obj_data.data.email_proveedor;
                        document.querySelector("#txt_ciudad_proveedor_act").value = obj_data.data.ciudad_ubicacion;
                        document.querySelector("#txt_direccion_proveedor_act").value = obj_data.data.direccion_ubicacion;
                        
                        
                        $('#modal_form_actualiza_proveedor').modal('show');
                    }else{
                        swal("Error",obj_data.msg,"error");
                    }
                }
            }
        });
    });
}

function fnc_eliminar_proveedor(){
    var btn_eliminar = document.querySelectorAll(".eliminaProveedor");
    btn_eliminar.forEach(function(btn_eliminar){
        btn_eliminar.addEventListener('click',function(){
            var ruc_dni_proveedor = this.getAttribute("rl");
            swal({
                title:"Eliminar proveedor",
                text:"¿Estás seguro de eliminar al proveedor?.",
                type:"warning",
                showCancelButton:true,
                confirmButtonText:"Sí, eliminar usuario.",
                cancelButtonText:"No, cancelar.",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                    var solicitud = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajax_url = base_url+'proveedor/elimina_proveedor/'; 
                    var str_data = "ruc_dni_proveedor="+ruc_dni_proveedor;
                    solicitud.open("POST",ajax_url,true);
                    solicitud.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    solicitud.send(str_data);
                    solicitud.onreadystatechange = function(){
                        if(solicitud.readyState == 4 && solicitud.status == 200){
                            var obj_data = JSON.parse(solicitud.responseText);
                            if(obj_data.status){
                                swal("Eliminar!",obj_data.msg,"success");
                                tabla_proveedores.ajax.reload(function(){
                                    fnc_editar_proveedor();
                                    fnc_eliminar_proveedor();
                                });
                            }else{
                               swal("Atencion!",obj_data.msg,"error"); 
                            }
                        }
                    }
                }
                
            });
        });
    });
}
