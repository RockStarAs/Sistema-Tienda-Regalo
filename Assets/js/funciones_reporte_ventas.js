/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/
document.addEventListener("DOMContentLoaded", function () {
    var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "venta/grafico_ventas";
    request.open("GET", ajax_url, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var obj_json = JSON.parse(request.responseText);
            var line = new Morris.Line({
                element          : 'line-chart-ventas',
                resize           : true,
                data             : obj_json,
                xkey             : 'y',
                ykeys            : ['ventas'],
                labels           : ['ventas'],
                lineColors       : ['#efefef'],
                lineWidth        : 2,
                hideHover        : 'auto',
                gridTextColor    : '#fff',
                gridStrokeWidth  : 0.4,
                pointSize        : 4,
                pointStrokeColors: ['#efefef'],
                gridLineColor    : '#efefef',
                gridTextFamily   : 'Open Sans',
                preUnits         : 'S/.',
                gridTextSize     : 10
              });
             line.setData(obj_json);
        }
    };
});
window.addEventListener(
    "load",
    function () {
        localStorage.removeItem("capturarRango2");
	    localStorage.clear();
    },
    false
);


if(localStorage.getItem("capturarRango2") != null){
	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));
}else{
	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn2').daterangepicker(
  {
    "locale": {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Personalizar",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    
    $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn2 span").html();
   
   	localStorage.setItem("capturarRango2", capturarRango);

    $.ajax({
        url:"ventas/grafico_ventas",
        method: "GET", // or POST
        dataType: "json",
        data: {from: fechaInicial, to: fechaFinal},
        success:function(result) {
            console.log("sent back -> do whatever you want now");
        }
    });
   //	window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango2");
	localStorage.clear();
	window.location = "reporte_ventas";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensright .ranges li").on("click", function () {
  var textoHoy = $(this).attr("data-range-key");
  
  if (textoHoy == "Hoy") {
    var d = new Date();
    var dia = d.getDate();
    var mes = d.getMonth() + 1;
    var año = d.getFullYear();

    if (mes < 10) {
      var fechaInicial = año + "-0" + mes + "-" + dia;
      var fechaFinal = año + "-0" + mes + "-" + dia;
    } else if (dia < 10) {
      var fechaInicial = año + "-" + mes + "-0" + dia;
      var fechaFinal = año + "-" + mes + "-0" + dia;
    } else if (mes < 10 && dia < 10) {
      var fechaInicial = año + "-0" + mes + "-0" + dia;
      var fechaFinal = año + "-0" + mes + "-0" + dia;
    } else {
      var fechaInicial = año + "-" + mes + "-" + dia;
      var fechaFinal = año + "-" + mes + "-" + dia;
    }

    localStorage.setItem("capturarRango2", "Hoy");
    
    $.ajax({
      url: "ventas/ventas_realizadas",
      method: "GET", // or POST
      dataType: "json",
      data: { from: fechaInicial, to: fechaFinal },
      success: function (result) {
        console.log("sent back -> do whatever you want now");
      },
    });
  }
});