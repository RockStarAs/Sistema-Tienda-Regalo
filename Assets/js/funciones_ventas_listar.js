document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector('#tabla_ventas')) {
        if (typeof tipo=== 'undefined') {
            tipo=13;
        }
        if (tipo==1) {
            carga_ventas(tipo);
        }else if(tipo==2){
            carga_ventas(tipo);
        }else{
            window.location.href=base_url+"venta/listar_ventas_general";
        }

    }
});
function carga_ventas(tipo) {
    tabla_ventas = $("#tabla_ventas").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: " " + base_url + "assets/js/idioma.json",
      },
      ajax: {
        url: " " + base_url + "venta/listar_ventas_r/"+tipo,
        dataSrc: "",
      },
      bAutoWidth: false,
      columns: [
        { data: "ID_VENTA" },
        { data: "FECHA_VENTA" },
        { data: "NOMBRE_CAJERO" },
        { data: "NOMBRE_CLIENTE" },
        { data: "TOTAL_PAGADO" },
        { data: "opciones" },
      ],
      responsive: true,
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
      drawCallback: function () {},
    });
  }

