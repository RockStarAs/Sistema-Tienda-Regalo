var tabla_ventas = $("#tabla_ventas");
    tabla_ventas = $("#tabla_ventas").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: " " + base_url + "assets/js/idioma.json",
      },
      ajax: {
        url: " " + base_url + "reporte/lista_ventas_dia",
        dataSrc: "",
      },
      bAutoWidth: false,
      columns: [
        { data: "ID_VENTA" },
        { data: "FECHA_VENTA" },
        { data: "NOMBRE_CAJERO" },
        { data: "NOMBRE_CLIENTE" },
        { data: "TOTAL_PAGADO" },
      ],
      responsive: true,
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
      drawCallback: function () {
        
      },
    });