/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/
document.addEventListener("DOMContentLoaded", function () {
  if (
    typeof fechaInit == "undefined" ||
    typeof fechaFin == "undefined" ||
    fechaInit == "null" ||
    fechaFin == "null"
  ) {
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "venta/grafico_ventas";
    request.open("POST", ajax_url, true);
    request.send();
  } else {
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "venta/grafico_ventas";
    var str_data = "fechaInicial=" + fechaInit + "&fechaFinal=" + fechaFin;
    request.open("POST", ajax_url, true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request.send(str_data);
  }

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var obj_json = JSON.parse(request.responseText);
      var bar = new Morris.Bar({
        element: "bar-chart2",
        resize: true,
        data: obj_json,
        xkey: "y",
        ykeys: ["ventas"],
        labels: ["ventas"],
        barColors: ["#efefef"],
        lineWidth: 2,
        hideHover: "auto",
        gridTextColor: "#fff",
        gridStrokeWidth: 0.8,
        pointSize: 4,
        gridLineColor: "#efefef",
        gridTextFamily: "Open Sans",
        preUnits: "S/.",
        gridTextSize: 10,
      });
      bar.setData(obj_json);
    }
  };

  
});
window.addEventListener(
  "load",
  function () {
    localStorage.removeItem("capturarRango2");
    localStorage.clear();
    reporte_productos();
    grafico_productos();
    grafico_compradores();
    grafico_cajeros();
    grafico_vendedores();
  },
  false
);

if (localStorage.getItem("capturarRango2") != null) {
  $("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));
} else {
  $("#daterange-btn2 span").html(
    '<i class="fa fa-calendar"></i> Rango de fecha'
  );
}
/*=============================================
REPORTE PRODUCTOS
=============================================*/
function reporte_productos() {
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var ajax_url = base_url + "producto/reporte_productos";
  request.open("GET", ajax_url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var obj_json = JSON.parse(request.responseText);
      if (obj_json.length<=0) {
        $("<div class='row'><div class='col-md-12'><span>Aun no se cuenta con suficientes datos</span></div></div>" ).insertBefore( ".primero" );
        
      }
      for (let index = 0; index < obj_json.length; index++) {
        $(".chart-legend").append(obj_json[index].lista);
      }
      var mitad_array = Math.trunc(obj_json.length / 2);
      for (let ind = 0; ind < mitad_array; ind++) {
        $(".prod").append(obj_json[ind].listado);
      }
    }
  };
}
function grafico_compradores() {
  var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "cliente/reporte_clientes";
    request.open("GET", ajax_url, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var obj_json = JSON.parse(request.responseText);
        var bar = new Morris.Bar({
          element: "bar-chart4",
          resize: true,
          data: obj_json,
          xkey: "y",
          ykeys: ["compras"],
          labels: ["Compras"],
          barColors: ["#f6a"],
          lineWidth: 2,
          hideHover: "auto",
          gridTextColor: "#000000",
          gridStrokeWidth: 0.8,
          pointSize: 4,
          gridLineColor: "#efefef",
          gridTextFamily: "Open Sans",
          preUnits: "S/.",
          gridTextSize: 10,
        });
        bar.setData(obj_json);
      }
    };
}
function grafico_productos(params) {
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var ajax_url = base_url + "producto/reporte_productos";
  request.open("GET", ajax_url, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var obj_json = JSON.parse(request.responseText);
      var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
      var pieChart = new Chart(pieChartCanvas);
      var data=[];
      for (let index = 0; index < obj_json.length; index++) {
        data.push({
          value    : obj_json[index].cantidad_vendida,
          color    : obj_json[index].colores,
          highlight: obj_json[index].colores,
          label    : obj_json[index].nombre_producto
        });
      }
      var PieData = data;
      var pieOptions = {
        // Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        // String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        // Number - The width of each segment stroke
        segmentStrokeWidth: 1,
        // Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        // Number - Amount of animation steps
        animationSteps: 100,
        // String - Animation easing effect
        animationEasing: "easeOutBounce",
        // Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        // Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        // Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,
        // String - A legend template
        legendTemplate:
          "<ul class='<%=name.toLowerCase()%>-legend'><% for (var i=0; i<segments.length; i++){%><li><span style='background-color:<%=segments[i].fillColor%>'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
        // String - A tooltip template
        tooltipTemplate: "<%=value %> <%=label%>",
      };
      // Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pieChart.Doughnut(PieData, pieOptions);
      // -----------------
      // - END PIE CHART -
      // -----------------
    }
  };
}
/*=============================================
RANGO DE FECHAS
=============================================*/
$("#daterange-btn2").daterangepicker(
  {
    locale: {
      format: "YYYY-MM-DD",
      separator: " - ",
      applyLabel: "Aplicar",
      cancelLabel: "Cancelar",
      fromLabel: "Desde",
      toLabel: "Hasta",
      customRangeLabel: "Personalizar",
      daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
      monthNames: [
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
        "Diciembre",
      ],
      firstDay: 1,
    },
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 días": [moment().subtract(29, "days"), moment()],
      "Este mes": [moment().startOf("month"), moment().endOf("month")],
      "Último mes": [
        moment().subtract(1, "month").startOf("month"),
        moment().subtract(1, "month").endOf("month"),
      ],
    },
    startDate: moment(),
    endDate: moment(),
  },
  function (start, end) {
    $("#daterange-btn2 span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var fechaInicial = start.format("YYYY-MM-DD");

    var fechaFinal = end.format("YYYY-MM-DD");

    var capturarRango = $("#daterange-btn2 span").html();

    localStorage.setItem("capturarRango2", capturarRango);
    window.location =
      base_url + "venta/reporte_ventas/" + fechaInicial + "/" + fechaFinal;
  }
);

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on(
  "click",
  function () {
    localStorage.removeItem("capturarRango2");
    localStorage.clear();
    window.location = base_url + "venta/reporte_ventas";
  }
);

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
      mes = "0" + mes;
    }
    if (dia < 10) {
      dia = "0" + dia;
    }
    var fechaInicial = año + "-" + mes + "-" + dia;
    var fechaFinal = año + "-" + mes + "-" + dia;

    localStorage.setItem("capturarRango2", "Hoy");
    window.location =
      base_url + "venta/reporte_ventas/" + fechaInicial + "/" + fechaFinal;
  }
});

/*=============================================
GRAFICO DE CAJEROS
=============================================*/
function grafico_cajeros() {
  if (
    typeof fechaInit == "undefined" ||
    typeof fechaFin == "undefined" ||
    fechaInit == "null" ||
    fechaFin == "null"
  ) {
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "venta/grafico_cajeros";
    request.open("POST", ajax_url, true);
    request.send();
  } else {
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "venta/grafico_cajeros";
    var str_data = "fechaInicial=" + fechaInit + "&fechaFinal=" + fechaFin;
    request.open("POST", ajax_url, true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request.send(str_data);
  }

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var obj_json = JSON.parse(request.responseText);
      var bar = new Morris.Bar({
        element: "bar-chart1",
        resize: true,
        data: obj_json,
        xkey: "y",
        ykeys: ["ventas"],
        labels: ["ventas"],
        barColors: ['#0af'],
        lineWidth: 2,
        hideHover: "auto",
        gridTextColor: "#000",
        gridStrokeWidth: 0.8,
        pointSize: 4,
        gridLineColor: "#efefef",
        gridTextFamily: "Open Sans",
        preUnits: "S/.",
        gridTextSize: 10,
      });
      bar.setData(obj_json);
    }
  };
}

/*=============================================
GRAFICO DE VENDEDORES
=============================================*/
function grafico_vendedores() {
  if (
    typeof fechaInit == "undefined" ||
    typeof fechaFin == "undefined" ||
    fechaInit == "null" ||
    fechaFin == "null"
  ) {
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "venta/grafico_vendedores";
    request.open("POST", ajax_url, true);
    request.send();
  } else {
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "venta/grafico_vendedores";
    var str_data = "fechaInicial=" + fechaInit + "&fechaFinal=" + fechaFin;
    request.open("POST", ajax_url, true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request.send(str_data);
  }

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var obj_json = JSON.parse(request.responseText);
      var bar = new Morris.Bar({
        element: "bar-chart3",
        resize: true,
        data: obj_json,
        xkey: "y",
        ykeys: ["ventas"],
        labels: ["ventas"],
        barColors: ['#ffa500'],
        lineWidth: 2,
        hideHover: "auto",
        gridTextColor: "#000",
        gridStrokeWidth: 0.8,
        pointSize: 4,
        gridLineColor: "#efefef",
        gridTextFamily: "Open Sans",
        preUnits: "S/.",
        gridTextSize: 10,
      });
      bar.setData(obj_json);
    }
  };
}