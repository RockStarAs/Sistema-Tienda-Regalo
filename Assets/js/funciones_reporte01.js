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
        { data: "TIPO_PAGO" },
        { data: "TOTAL_PAGADO" },
        { data: "ACCIONES" },
      ],
      responsive: true,
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
      drawCallback: function () {
        ver_venta_completa();
      },
    });

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