var tabla_usuarios;
document.addEventListener('DOMContentLoaded',function(){
    tabla_usuarios = $('#tabla_usuarios').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language":{
            "url" : "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url" : " "+base_url+"usuario/listar_usuarios",
            "dataSrc":""  
        },
        "columns": [
            { "data": "dni_trabajador" },
            { "data": "nombre_trabajador" },
            { "data": "apellidos_trabajador" }, 
            { "data": "nombre_usuario" },
            { "data": "rol_usuario" },
            { "data": "estado_usuario" },
            { "data": "fecha_creacion" },
            { "data": "ultima_conexion"}, 
            { "data": "opciones"}
        ],
        "responsive":true,
        "bDestroy":true,
        "iDisplayLength":50,
        "order":[[0,"desc"]],
        drawCallback:function(){
            fnc_editar_usuario();
            fnc_eliminar_usuario();
        }
    });
    //Insertar un usuarios
    var form_usuarios = document.querySelector("#frm_agregar_usuario");
    form_usuarios.onsubmit = function(e){
        e.preventDefault();
        var dni_trabajador = document.querySelector('#txt_dni').value;
        var nombre_trabajador = document.querySelector('#txt_nombre').value;
        var apellidos_trabajador = document.querySelector('#txt_apellido').value;
        var nombre_usuario = document.querySelector('#txt_nombre_usuario').value;
        var password_usuario = document.querySelector('#txt_contraseña').value;
        var rol_usuario = document.querySelector('#select_tipo').value;

        if(dni_trabajador == '' || nombre_trabajador == '' || apellidos_trabajador == '' || nombre_usuario == '' || password_usuario =='' || rol_usuario == ''){
            swal("Atención","Todos los campos son obligatorios.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajax_url = base_url+'usuario/insertar_usuario';
        var form_data = new FormData(form_usuarios);
        request.open("POST",ajax_url,true);
        request.send(form_data);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var json = JSON.parse(request.responseText); 
                if(json.status){
                    $('#modal_form_agrega_usuario').modal('hide');
                    form_usuarios.reset();
                    swal("Añadido",json.msg,"success");
                    tabla_usuarios.ajax.reload(function(){
                        //Importante para que se carguen todas los editar de los usuarios cuando se agregan
                        setTimeout(()=>{
                            fnc_editar_usuario();
                            fnc_eliminar_usuario();
                        },500);
                    });
                }else{
                    swal("¡Error!",json.msg,"error");    
                }
                  
            }
        }
    }
    //Modificar Usuario
    var form_usuarios_act = document.querySelector("#frm_actualiza_usuario");
    form_usuarios_act.onsubmit = function(e){
        e.preventDefault();
        var id_usuario_act = document.querySelector("#id_usuario").value;
        var dni_trabajador_act = document.querySelector('#txt_dni_act').value;
        var nombre_trabajador_act = document.querySelector('#txt_nombre_act').value;
        var apellidos_trabajador_act = document.querySelector('#txt_apellido_act').value;
        var nombre_usuario_act = document.querySelector('#txt_nombre_usuario_act').value;
        var password_usuario_act = document.querySelector('#txt_contraseña_act').value;
        var rol_usuario_act = document.querySelector('#select_tipo_act').value;
        if(dni_trabajador_act == '' || nombre_trabajador_act == '' || apellidos_trabajador_act == '' || nombre_usuario_act == '' || password_usuario_act =='' || rol_usuario_act == ''){
            swal("Atención","Todos los campos son obligatorios.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajax_url = base_url+'usuario/modificar_usuario';
        var form_data = new FormData(form_usuarios_act);
        request.open("POST",ajax_url,true);
        request.send(form_data);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var json = JSON.parse(request.responseText); 
                if(json.status){
                    $('#modal_form_actualiza_usuario').modal('hide');
                    form_usuarios_act.reset();
                    swal("Actualizado",json.msg,"success");
                    tabla_usuarios.ajax.reload(function(){
                        //Importante para que se carguen todas los editar de los usuarios cuando se agregan
                        setTimeout(()=>{
                            fnc_editar_usuario();
                            fnc_eliminar_usuario();
                        },500);
                    });
                }else{
                    swal("¡Error!",json.msg,"error");    
                }
                  
            }
        }
    }
});

$('#tabla_usuarios').DataTable();

function abrir_modal(){
    $('#modal_form_agrega_usuario').modal('show');
}
window.addEventListener('load',function(){
    setTimeout(() => { 
        fnc_editar_usuario();
        fnc_eliminar_usuario();
    }, 500);
},false);

function fnc_editar_usuario(){
    var btn_editar_usuario = document.querySelectorAll(".btnEditarUsuario");
    btn_editar_usuario.forEach(function(btn_editar_usuario){
        btn_editar_usuario.addEventListener('click',function(){
            //Obteniendo el id que se encuentra en el boton 
            var id_a_buscar = this.getAttribute("rl");
            var solicitud = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajax_url = base_url+'usuario/busca_usuario_id/'+id_a_buscar;
            solicitud.open("GET",ajax_url,true);
            solicitud.send();
            solicitud.onreadystatechange = function(){
                if(solicitud.readyState == 4 && solicitud.status == 200){
                    var obj_data = JSON.parse(solicitud.responseText);
                    if(obj_data.status){
                        document.querySelector("#id_usuario").value = obj_data.data.id_usuario;
                        document.querySelector("#txt_dni_act").value = obj_data.data.dni_trabajador;
                        document.querySelector("#txt_nombre_act").value = obj_data.data.nombre_trabajador;
                        document.querySelector("#txt_apellido_act").value = obj_data.data.apellidos_trabajador;
                        document.querySelector("#txt_nombre_usuario_act").value = obj_data.data.nombre_usuario;
                        document.querySelector("#txt_contraseña_act").value = obj_data.data.password_usuario;
                        
                        if(obj_data.data.rol_usuario == 'CAJERO'){
                            var opcion_seleccionada = '<option selected value="CAJERO" class="no_listado" >CAJERO</option>';
                        }else{
                            var opcion_seleccionada = '<option selected value="ATENCION" class="no_listado" >ATENCION</option>';
                        }
                        var html_select = `${opcion_seleccionada}
                            <option value="CAJERO"> CAJERO </option>
                            <option value="ATENCION"> ATENCION </option>
                        `;
                        document.querySelector("#select_tipo_act").innerHTML = html_select;
                        $('#modal_form_actualiza_usuario').modal('show');
                    }else{
                        swal("Error",obj_data.msg,"error");
                    }
                }
            }
            $('#modal_form_actualiza_usuario').modal('show');
        });
    });
}
function fnc_eliminar_usuario(){
    var btn_eliminar = document.querySelectorAll(".btnEliminarUsuario");
    btn_eliminar.forEach(function(btn_eliminar){
        btn_eliminar.addEventListener('click',function(){
            var id_usuario = this.getAttribute("rl");
            swal({
                title:"Eliminar usuario",
                text:"Al eliminar el usuario su estado pasará a inactivo y no podrá acceder a las funciones.",
                type:"warning",
                showCancelButton:true,
                confirmButtonText:"Sí, eliminar usuario.",
                cancelButtonText:"No, cancelar.",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                    var solicitud = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajax_url = base_url+'usuario/elimina_usuario_id/'; 
                    var str_data = "id_usuario="+id_usuario;
                    solicitud.open("POST",ajax_url,true);
                    solicitud.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    solicitud.send(str_data);
                    solicitud.onreadystatechange = function(){
                        if(solicitud.readyState == 4 && solicitud.status == 200){
                            var obj_data = JSON.parse(solicitud.responseText);
                            if(obj_data.status){
                                swal("Eliminar!",obj_data.msg,"success");
                                tabla_usuarios.ajax.reload(function(){
                                    fnc_editar_usuario();
                                    fnc_eliminar_usuario();
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