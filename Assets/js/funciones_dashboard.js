document.addEventListener('DOMContentLoaded',function(){
    tabla_categorias = $('#tabla_ventas').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "dom": 'frtip',
        "language":{
            url : " " + base_url + "assets/js/idioma.json"
        },
        "ajax":{
            "url" : " "+base_url+"venta/ventas_por_vendedor",
            "dataSrc":""  
        },
        "bAutoWidth": false,
        columnDefs: [
            {
              width: "50px",
              targets: 1
            }
        ],
        "columns": [
            { "data": "ID_VENTA" },
            { "data": "FECHA_VENTA" },
            { "data": "TIPO_VENTA" },
            { "data": "TOTAL_PAGADO"}
        ],
        "responsive":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[1,"desc"]],
        drawCallback: function () {
        },
    });
});