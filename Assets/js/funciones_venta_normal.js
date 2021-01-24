var tabla_ventas;
window.addEventListener(
  "load",
  function () {
    setTimeout(() => {
      fnc_listar_clientes();
      fnc_listar_usuarios();
      fecha_actual();
      //listando proveedores en el  select
    }, 500);
  },
  false
);
function fecha_actual() {
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth() + 1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if (dia < 10) dia = "0" + dia; //agrega cero si el dia es menor de 10
  if (mes < 10) mes = "0" + mes; //agrega cero si el mes es menor de 10
  document.getElementById("fecha_venta").value = ano + "-" + mes + "-" + dia;
}
function fnc_listar_clientes() {
  var ajax_url = base_url + "cliente/devolver_clientes";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajax_url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#cliente_dni").innerHTML = request.responseText;
      document.querySelector("#cliente_dni").value = 1;
      $("#cliente_dni").selectpicker("render");
    }
  };
}
function fnc_listar_usuarios() {
  var ajax_url = base_url + "usuario/devolver_usuarios";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajax_url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#id_vendedor").innerHTML = request.responseText;
      document.querySelector("#id_vendedor").value = 1;
      $("#id_vendedor").selectpicker("render");
    }
  };
}
function fnc_listar_clientes() {
  var ajax_url = base_url + "cliente/devolver_clientes";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajax_url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#cliente_dni").innerHTML = request.responseText;
      document.querySelector("#cliente_dni").value = 1;
      $("#cliente_dni").selectpicker("render");
    }
  };
}
function fnc_listar_usuarios() {
  var ajax_url = base_url + "usuario/devolver_usuarios";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajax_url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#id_vendedor").innerHTML = request.responseText;
      document.querySelector("#id_vendedor").value = 1;
      $("#id_vendedor").selectpicker("render");
    }
  };
}
function mostar_nombre_cliente(){
  var dni_cliente=document.querySelector("#cliente_dni").value;
  var ajax_url = base_url + "cliente/busca_cliente/"+dni_cliente;
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajax_url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var obj_json = JSON.parse(request.responseText);
      if (obj_json.status) {
        document.querySelector("#cliente_nombre").value = obj_json.data.nombre_cliente+' '+obj_json.data.apellidos_cliente;
      } else {
        swal("Error", obj_json.msg, "error");
      }
    }
  };
}
function fnc_cambia_gen(){
  
  //fnc_listar_clientes();
  $("#cliente_dni").val(0);
  $("#cliente_dni").selectpicker("refresh");
  document.querySelector("#cliente_nombre").value = "Público General";
}
function abrir_modal() {
  $("#modal_listar_producto_venta").modal("show");
  carga_modal_datos();
}
function carga_modal_datos() {
  tabla_productos = $("#tabla_producto").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: " " + base_url + "assets/js/idioma.json",
    },
    ajax: {
      url: " " + base_url + "producto/listar_productos_venta",
      dataSrc: "",
    },
    columns: [
      { data: "opciones" },
      { data: "id_producto" },
      { data: "nombre_producto" },
      { data: "stock_producto" },
      { data: "precio_unitario_venta" },
      { data: "imagen_producto" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 3,
    order: [[0, "desc"]],
    drawCallback: function () {},
  });
}
var cont = 0;
var detalles = 0;
function agregar_detalle(id_producto, nombre_producto) {
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var ajax_url = base_url + "producto/busca_producto/";
  //parametros a enviar por post
  var strData =
    "id_producto=" + id_producto + "&nombre_producto=" + nombre_producto;
  request.open("POST", ajax_url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(strData);
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var obj_json = JSON.parse(request.responseText);
      
      if (obj_json.status) {
        //Agregando el objeto a la tabla
        if (evita_repetir(obj_json.data.id_producto)) {
          //Si se repite
          var repetido = $('input[sc="'+obj_json.data.id_producto+'"]');
          var cantidad = repetido.attr('value');
          cantidad++;
          repetido.attr('value',cantidad);
          actualiza_detalle(obj_json.data.id_producto);
         
        } else {
          var cantidad = 1;
          var precio_venta = cantidad*obj_json.data.precio_unitario_venta;
          var fila =
            '<tr class="filas" sl="' +obj_json.data.id_producto +'" id="fila' +cont +'"> ' +
            "<td>" +'<button type="button" class="btn btn-outline-danger btn-sm" onclick="eliminarDetalle(' +cont +')">X</button>' +"</td>" +
            "<td>" +'<input type="hidden" name="idarticulo[]" value="' +obj_json.data.id_producto +'">' +obj_json.data.nombre_producto +"</td>" +
            "<td>" +'<input type="number" class="form-control" onchange="actualiza_cantidad('+obj_json.data.id_producto+')" name="cantidad[]" sc="'+obj_json.data.id_producto+'" id="cantidad[]" max="'+obj_json.data.stock_producto+'" value="' +cantidad +'">' +"</td>" +
            "<td>" +'<input type="number" class="form-control" onchange="actualiza_detalle(' +cont +')" name="precio_venta[]" id="precio_venta[]" sp="' +cont +'" value="' +obj_json.data.precio_unitario_venta +'" step="0.01" readonly>' +"</td>" +
            "<td>" +'<input type="number" class="form-control" onchange="actualiza_descuento(' +cont +')" name="descuento_venta[]" id="descuento_venta[]" sp="' +cont +'" value="' + "0.0" +'" step="0.01">' +"</td>" +
            
            "<td>" +"<span>S/.</span>" +'<span name="subtotal"  id="subtotal' +cont +'" value="' +precio_venta +'" rl="'+obj_json.data.id_producto+'" >'+precio_venta  +
            "</span>" +
            "</td>" +
            
            "<td>" +"<span>S/.</span>" +'<span name="subtotal_sin"  id="subtotal_sin' +cont +'" value="' +precio_venta +'" rl="'+obj_json.data.id_producto+'" >'+precio_venta  +
            "</span>" +
            "</td>" +
            
            
            "</tr>";

          cont++;
          detalles++;
          $("#detalles_venta").append(fila);

          calcula_totales();
        }
      } else {
        swal("Atencion", obj_json.msg, "error");
      }
    }
  };
}
function calcula_totales() {
  var sub_totales = document.getElementsByName("subtotal");
  //var sub_totales_2 = document.getElementsByName("subtotal_sin");
  var total = 0.0;
  var total2 = 0.0;
  var tamaño_sub_totales = sub_totales.length;
  for (var index = 0; index < tamaño_sub_totales; index++) {
    var sub = parseFloat(
      document.getElementsByName("subtotal")[index].textContent
    );
    var sub2 = parseFloat(
      document.getElementsByName("subtotal_sin")[index].textContent
    );
    total += sub;
    total2 += sub2;
  }
  total=Math.round(total * 100) / 100;
  total2=Math.round(total2 * 100) / 100;
  
  $("#total").html("S/." + total);
  $("#total_venta").val(total);

  $("#total_sin").html("S/." + total2);
  $("#total_venta_sin").val(total2);
}
function actualiza_cantidad(id_producto){
  var cantidad_por_actualizar = $('input[sc="'+id_producto+'"]');
  var cantidad = cantidad_por_actualizar.val();
  cantidad_por_actualizar.attr('value',cantidad);
  actualiza_detalle(id_producto);
}
function evita_repetir(id_producto) {
  var tr = document.getElementsByTagName("tr");
  for (var i = 0; i < tr.length; i++) {
    var sl = tr[i].getAttribute("sl");
    if (sl == id_producto) {
      return true; 
    }
  }
  return false;
}
function actualiza_descuento(numero){
  var cant = document.getElementsByName("cantidad[]");
  var prec = document.getElementsByName("precio_venta[]");
  var sub = document.getElementsByName("subtotal");
  var desc = document.getElementsByName("descuento_venta[]");
  var tamañoCant = cant.length;
  for (var i = 0; i < tamañoCant; i++) {
    var inpC = cant[i];
    var inpP = prec[i];
    var inpS = sub[i];
    var inpDesc = desc[i];
    inpS.value = (inpP.value*inpC.value)-inpDesc.value;
    inpS.value=Math.round(inpS.value * 100) / 100;
    document.getElementsByName("subtotal")[i].textContent = inpS.value;
  }
  calcula_totales();
}
function actualiza_detalle(numero) {
  var cant = document.getElementsByName("cantidad[]");
  var prec = document.getElementsByName("precio_venta[]");
  var sub = document.getElementsByName("subtotal");
  var sub_sin = document.getElementsByName("subtotal_sin");
  var desc = document.getElementsByName("descuento_venta[]");
  var tamañoCant = cant.length;
  for (var i = 0; i < tamañoCant; i++) {
    var inpC = cant[i];
    var inpP = prec[i];
    var inpS = sub[i];
    var inpSin = sub_sin[i];
    var inpDesc = desc[i];
    inpSin.value = (inpP.value*inpC.value);
    inpS.value = (inpP.value*inpC.value)-inpDesc.value;
    inpS.value=Math.round(inpS.value * 100) / 100;
    inpSin.value=Math.round(inpSin.value * 100) / 100;
    document.getElementsByName("subtotal")[i].textContent = inpS.value;
    document.getElementsByName("subtotal_sin")[i].textContent = inpSin.value;
  }
  calcula_totales();
}
function eliminarDetalle(indice)
{
    $("#fila" + indice).remove();

    detalles -= 1;

    calcula_totales(); 
}
var form_venta = document.querySelector("#form_venta_normal");
form_venta.onsubmit = function (e) {
  e.preventDefault();
  //Agregar la venta
  //Aqui empiezo a agregar
  //Registro primero la venta
  var cant = document.getElementsByName("cantidad[]");
  if (cant.length <= 0) {
    swal(
      "⚠️Error en venta⚠️",
      "Para registrar una venta debes agregar al menos 1 producto.",
      "error"
    );
  } else {
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "venta/insertar_venta_normal";
    var form_data = new FormData(form_venta);
    request.open("POST", ajax_url, true);
    request.send(form_data);

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        //Solicitud exitosa
        var json = JSON.parse(request.responseText);
        if (json.status) {
          swal(
            {
              title: "Agregado correctamente 😀",
              text: json.msg + "\n¿Deseas imprimir el ticket de venta?",
              type: "success",
              showCancelButton: true,
              confirmButtonText: "Aceptar",
            },
            function (isConfirm) {
              if (isConfirm) {
                window.open(base_url + "pdf/genera_pdf/" +json.id_venta );
                location.reload();
              }else{
                location.reload();
              }
            }
          );
        } else {
          swal("Posible error", json.msg, "error");
        }
      }
    };
  };
};