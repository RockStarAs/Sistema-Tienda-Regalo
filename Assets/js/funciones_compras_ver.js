var tabla_compras;
document.addEventListener("DOMContentLoaded", function () {
    tabla_productos = $("#tabla_compras").DataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url : " " + base_url + "assets/js/idioma.json"
      },
      ajax: {
        url: " " + base_url + "compra/listar_compra",
        dataSrc: "",
      },
      bAutoWidth: false,
      columns: [
            { data: "ruc_dni" },
            { data: "nombre_proveedor" },
            { data: "fecha_registro_compra" },
            { data: "estado_compra" },
            { data: "opciones_compra" },
      ],
      responsive: true,
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
      drawCallback: function () {
        
      },
    });
});  