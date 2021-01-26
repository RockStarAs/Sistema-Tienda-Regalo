document.addEventListener('DOMContentLoaded',function(){
    tabla_ventas = $('#tabla_ventas').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "ajax":{
            "url" : " "+base_url+"venta/lista_ventas_eliminadas",
            "dataSrc":""  
        },
        "bAutoWidth": false,
        "columns": [
            { "data": "ID_VENTA" },
            { "data": "NOMBRE_CAJERO" },
            { "data": "NOMBRE_CLIENTE" }, 
            { "data": "FECHA_VENTA" },
            { "data": "TIPO_VENTA" },
            { "data": "TOTAL_PAGADO" },
            { "data": "OPCIONES" }
        ],
        "responsive":true,
        "bDestroy":true,
        "iDisplayLength":20,
        "order":[[0,"desc"]],
        drawCallback:function(){
            ver_venta_completa();
        },
        "language":{
            url: " " + base_url + "assets/js/idioma.json",
        },
    });
});
$('#tabla_ventas').DataTable();
function ver_venta_completa(){
    var btn_ver_venta = document.querySelectorAll(".verVenta");
    btn_ver_venta.forEach(function(btn_ver_venta){
        btn_ver_venta.addEventListener('click',function(){
            var id_compra = this.getAttribute("rl");
      //ar request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajax_url = base_url+'venta/ver_venta_detallada/'+id_compra;
        window.open(ajax_url,"Vista");
        });
    });
}