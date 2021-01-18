var tabla_categorias;
document.addEventListener('DOMContentLoaded',function(){
    tabla_categorias = $('#tabla_categorias').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language":{
            url : " " + base_url + "assets/js/idioma.json"
        },
        "ajax":{
            "url" : " "+base_url+"categoria/listar_categorias",
            "dataSrc":""  
        },
        "bAutoWidth": false,
        "columns": [
            { "data": "nombre_categoria" },
            { "data": "descripcion_categoria" },
            { "data": "estado_categoria" },
            { "data": "opciones"}
        ],
        "responsive":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]],
        drawCallback: function () {
            ftnEditar_Categoria()
            ftnEliminarCategoria()
        },
    });
    //Insertar un categoria o Modifica una categoria
    var form_categoria = document.querySelector("#frm_agregar_categoria");
    form_categoria.onsubmit = function(e){
        e.preventDefault();
        if (document.querySelector('#id_categoria')) {
            var int_Id_cat=document.querySelector('#id_categoria').value;
            if(int_Id_cat == ''){
                swal("Atención","Todos los campos deben ser obligatorios","error");
                return false;
            }
        }
        var nombre_categoria = document.querySelector('#txt_nombre').value;
        if(nombre_categoria == ''){
            swal("Atención","El campo nombre es obligatorio.","error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajax_url = base_url+'categoria/inserta_categoria';
        
        var form_data = new FormData(form_categoria);
        request.open("POST",ajax_url,true);
        request.send(form_data);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var json = JSON.parse(request.responseText); 
                if(json.status){
                    $('#modal_form_agrega_categoria').modal('hide');
                    form_categoria.reset();
                    swal("Añadido",json.msg,"success");
                    tabla_categorias.ajax.reload(function(){
                        
                    });
                }else{
                    swal("¡Error!",json.msg,"error");    
                }
                  
            }
        }
    }
});

$('#tabla_categorias').DataTable();

function abrir_modal(){
    if (document.querySelector("#id_categoria")) {
        $("#id_categoria").remove();
    }
    document.querySelector("#titulo_Modal").innerHTML="Nueva Categoria ";
    document.querySelector(".modal-header").classList.replace("modalHeaderActualizar","modalHeaderRegistro");
    document.querySelector("#btnAccion_Form").classList.replace("btn-info","btn-primary");
    document.querySelector("#btn_Text").innerHTML="Guardar";
    document.querySelector("#frm_agregar_categoria").reset();
    $('#modal_form_agrega_categoria').modal('show');
}

function ftnEditar_Categoria(){
    var btnEditar_Categoria=document.querySelectorAll(".btnEditar_Categoria");
    btnEditar_Categoria.forEach(function(btnEditar_Categoria){
        btnEditar_Categoria.addEventListener('click',function(){
            if (document.querySelector("#id_categoria")) {
                $("#id_categoria").remove();
            }
            document.querySelector("#titulo_Modal").innerHTML="Actualizar Categoria ";
            document.querySelector(".modal-header").classList.replace("modalHeaderRegistro","modalHeaderActualizar");
            document.querySelector("#btnAccion_Form").classList.replace("btn-primary","btn-info");
            document.querySelector("#btn_Text").innerHTML="Actualizar";
            $(".frm").append("<input type='hidden' id='id_categoria' name='id_categoria'>");
            var id_categoria=this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajax_url = base_url+'categoria/seleccionar_categoria/'+id_categoria;
            request.open("GET",ajax_url,true);
            request.send();

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var obj_json = JSON.parse(request.responseText); 
                    if(obj_json.status){
                        document.querySelector("#id_categoria").value=obj_json.data.id_categoria;
                        document.querySelector("#txt_nombre").value=obj_json.data.nombre_categoria;
                        document.querySelector("#txt_descripcion").value=obj_json.data.descripcion_categoria;
                        $('#modal_form_agrega_categoria').modal('show');
                    }else{
                         swal("Error",obj_json.msg,"error");  
                    }
                }
            }
        });
    });
}

function ftnEliminarCategoria(){
    var btnEliminar_Categoria=document.querySelectorAll(".btnEliminar_Categoria");
    btnEliminar_Categoria.forEach(function(btnEliminar_Categoria){
        btnEliminar_Categoria.addEventListener('click',function(){
            var id_categoria=this.getAttribute("rl");
            swal({
               title: "Eliminar Categoria",
               text: "¿Realmente quiere eliminar la categoria?", 
               type: "warning",
               showCancelButton: true,
               confirmButtonText: "Sí,eliminar!",
               cancelButtonText: "No, cancelar!",
               closeOnConfirm: false,
               closeOnCancel: true
            }, function(isConfirm){
                if (isConfirm) {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajax_url = base_url+'categoria/eliminar_categoria/';
                    var strData="id_categoria="+id_categoria;
                    request.open("POST",ajax_url,true);
                    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange=function(){
                        if (request.readyState == 4 && request.status == 200) {
                            var obj_json=JSON.parse(request.responseText);
                            console.log(obj_json);
                            if (obj_json.status) {
                                swal("Eliminar!",obj_json.msg,"success");
                                tabla_categorias.ajax.reload(function(){
                                    setTimeout(() => { 
                                       
                                        ftnEliminarCategoria();
                                    }, 500);
                                });
                            }else{
                                swal("Atencion",obj_json.msg,"error");
                            }
                        }
                    }
                }
                
            });
        });
    });
}