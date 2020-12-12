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
        "iDisplayLength":10,
        "order":[[0,"desc"]]
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