var tabla_categorias;
document.addEventListener('DOMContentLoaded',function(){
    tabla_categorias = $('#tabla_categorias').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language":{
            "url" : "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url" : " "+base_url+"categoria/listar_categorias",
            "dataSrc":""  
        },
        "columns": [
            { "data": "nombre_categoria" },
            { "data": "descripcion_categoria" },
            { "data": "estado_categoria" },
            { "data": "opciones"}
        ],
        "responsive":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]
    });
    //Insertar un categoria
    var form_categoria = document.querySelector("#frm_agregar_categoria");
    form_categoria.onsubmit = function(e){
        e.preventDefault();
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
    document.querySelector("#id_categoria").value="";
    document.querySelector("#titulo_Modal").innerHTML="Nueva Categoria ";
    document.querySelector(".modal-header").classList.replace("modalHeaderActualizar","modalHeaderRegistro");
    document.querySelector("#btnAccion_Form").classList.replace("btn-info","btn-primary");
    document.querySelector("#btn_Text").innerHTML="Guardar";
    document.querySelector("#frm_agregar_categoria").reset();
    $('#modal_form_agrega_categoria').modal('show');
}

window.addEventListener("load", function() {
    setTimeout(() => { 
        ftnEditar_Categoria();
    }, 500);
}, false);

function ftnEditar_Categoria(){
    var btnEditar_Categoria=document.querySelectorAll(".btnEditar_Categoria");
    btnEditar_Categoria.forEach(function(btnEditar_Categoria){
        btnEditar_Categoria.addEventListener('click',function(){
            document.querySelector("#titulo_Modal").innerHTML="Actualizar Categoria ";
            document.querySelector(".modal-header").classList.replace("modalHeaderRegistro","modalHeaderActualizar");
            document.querySelector("#btnAccion_Form").classList.replace("btn-primary","btn-info");
            document.querySelector("#btn_Text").innerHTML="Actualizar";

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

            $('#modal_form_agrega_categoria').modal('show');
        });
    });
}