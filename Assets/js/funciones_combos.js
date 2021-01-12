var tabla_combos;
document.addEventListener('DOMContentLoaded',function(){
    tabla_combos = $('#tabla_combos').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language":{
            "url" : "idioma.json"
        },
        "ajax":{
            "url" : " "+base_url+"combo/listar_combos",
            "dataSrc":""  
        },
        "columns": [
            { "data": "id_combo" },
            { "data": "nombre_combo" },
            { "data": "precio_combo" },
            { "data": "stock_combo" },
            { "data": "estado_combo" },
            { "data": "opciones"}
        ],
        "responsive":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]
    });
});

$('#tabla_combos').DataTable();

function listarProductos()
{
    tabla = $('#tabla_producto')
        .DataTable(
            {
                "aProcessing":true, //Activamos el procesamiento del datatables
                "aServerSide":true, //Paginacion y filtrado realizados por el servidor
                "dom":"frtip",
                "ajax":{
                    "url" : " "+base_url+"producto/listar_productos_modal",
                    "dataSrc":""  
                },
                "columns": [
                    { "data": "opciones" },
                    { "data": "id_producto" },
                    { "data": "nombre_producto" },
                    { "data": "id_categoria" },
                    { "data": "stock_producto" },
                    { "data": "precio_unitario_venta"},
                    { "data": "imagen_producto"}
                ],
                "responsive":true,
                "bDestroy": true,
                "iDisplayLength": 5, //Paginacion
                "order": [[0,"desc"]] //Ordenar (Columna, orden)
            
            })
}
$('#tabla_producto').DataTable();

function abrir_form(){
    $(".boton").hide();
    $('.frm_combo').show();
    $('.dataTable_combo').hide();
    listarProductos();
    document.querySelector("#frm_agregar_combo").reset();
}

function cerrar_form(){
    $(".boton").show();
    $('.frm_combo').hide();
    $('.dataTable_combo').show();
}

function abrir_modal() {
    document.querySelector("#titulo_Modal").innerHTML = "Lista Productos ";
    document.querySelector(".modal-header").classList.replace("modalHeaderActualizar", "modalHeaderRegistro");
    $("#modal_lista_producto").modal("show");
}