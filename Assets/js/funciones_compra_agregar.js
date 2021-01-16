var tabla_productos;
window.addEventListener(
  "load",
  function () {
    setTimeout(() => {
      fnc_listar_proveedor();
      //listando proveedores en el  select
    }, 500);
  },
  false
);
function fnc_listar_proveedor() {
  var ajax_url = base_url + "proveedor/devolver_proveedores";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajax_url, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#proveedor_id").innerHTML = request.responseText;
      document.querySelector("#proveedor_id").value = 1;
      $("#proveedor_id").selectpicker("render");
    }
  };
}
function abrir_modal() {
  $("#modal_agregar_detalle_compra").modal("show");
  carga_modal_datos();
}
function carga_modal_datos() {
  tabla_productos = $("#tabla_productos").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: " " + base_url + "assets/js/idioma.json",
    },
    ajax: {
      url: " " + base_url + "producto/listar_productos_v2",
      dataSrc: "",
    },
    columns: [
      { data: "opciones" },
      { data: "nombre_producto" },
      { data: "id_categoria" },
      { data: "id_producto" },
      { data: "stock_producto" },
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
      console.log(obj_json);
      if (obj_json.status) {
        //Agregando el objeto a la tabla
        if (evita_repetir(obj_json.data.id_producto)) {
          //Si se repite
          var repetido = $('input[sc="'+obj_json.data.id_producto+'"]');
          var cantidad = repetido.attr('value');
          //console.log(cantidad);
          cantidad++;
          repetido.attr('value',cantidad);
        } else {
          var cantidad = 1;
          var precio_compra = 1;
          var fila =
            '<tr class="filas" sl="' +obj_json.data.id_producto +'" id="fila' +cont +'"> ' +
            "<td>" +'<button type="button" class="btn btn-outline-danger btn-sm" onclick="eliminarDetalle(' +cont +')">X</button>' +"</td>" +
            "<td>" +'<input type="hidden" name="idarticulo[]" value="' +obj_json.data.id_producto +'">' +obj_json.data.nombre_producto +"</td>" +
            "<td>" +'<input type="number" onchange="actualiza_cantidad('+obj_json.data.id_producto+')" name="cantidad[]" sc="'+obj_json.data.id_producto+'" id="cantidad[]" value="' +cantidad +'">' +"</td>" +
            "<td>" +"<span>S/.  </span>" +'<input type="number" onchange="actualiza_detalle(' +cont +')" name="precio_compra[]"id="precio_compra[]" sp="' +cont +'" value="' +precio_compra +'" step="0.1">' +"</td>" +
            "<td>" +"<span>S/.</span>" +'<span name="subtotal"  id="subtotal' +cont +'" value="' +precio_compra +'" >' +precio_compra +
            "</span>" +
            "</td>" +
            "</tr>";

          cont++;
          detalles++;
          $("#detalles_compra").append(fila);

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
  //console.log(sub_totales);
  var total = 0.0;
  var tamaño_sub_totales = sub_totales.length;
  for (var index = 0; index < tamaño_sub_totales; index++) {
    var sub = parseFloat(
      document.getElementsByName("subtotal")[index].textContent
    );
    //console.log(sub);
    //console.log(document.getElementsByName("subtotal")[index]);
    total += sub;
  }
  $("#total").html("S/." + total);
  $("#total_compra").val(total);
}
function actualiza_cantidad(id_producto){
  var cantidad_por_actualizar = $('input[sc="'+id_producto+'"]');
  console.log(cantidad_por_actualizar);
  var cantidad = cantidad_por_actualizar.val();
  console.log(cantidad);
  cantidad_por_actualizar.attr('value',cantidad);
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
function actualiza_detalle(numero) {
  var cant = document.getElementsByName("cantidad[]");
  var prec = document.getElementsByName("precio_compra[]");
  var sub = document.getElementsByName("subtotal");
  var tamañoCant = cant.length;
  for (var i = 0; i < tamañoCant; i++) {
    var inpC = cant[i];
    var inpP = prec[i];
    var inpS = sub[i];

    inpS.value = inpP.value;
    document.getElementsByName("subtotal")[i].textContent = inpS.value;
  }

  calcula_totales();

  // var elemento = $('input[sl="'+numero+'"]');
  //  elemento.value = $('input[sl="'+numero+'"]').attr('sl');
  //console.log($('input[sl="'+numero+'"]').text());
  //console.log("Imprimiendo  a[title=numero]");
  //console.log(elemento);
  //calcula_totales();
}
function eliminarDetalle(indice)
{
    $("#fila" + indice).remove();

    detalles -= 1;

    calcula_totales(); 
}
var form_compra = document.querySelector("#formulario_agregar_compra_detalles");

form_compra.onsubmit = function(e){
  e.preventDefault();
  //Validar que esté lleno xdd
  var proveedor_id = document.querySelector("#proveedor_id");
  var fecha_compra = document.querySelector("#fecha_compra");
  var fecha_entrega = document.querySelector("#fecha_entrega");
  var estado_compra = document.querySelector("#estado_compra");
  var serie_boleta_factura = document.querySelector("#serie_boleta_factura");
  var serie_boleta_factura = document.querySelector("#correlativo_boleta_factura");
  if(proveedor_id.value == "" || fecha_compra.value == "" || estado_compra.value == ""){
    //Aqui es porque le falta agregar datos en el formulario principal
    swal("Atención","Falta llenar un campo obligatorio.","error");
    return false;
  }else{
    //Aqui está todo correcto por ahora xd
    var sub_totales = document.getElementsByName("subtotal");
    if(sub_totales.length == 0  || sub_totales.length < 0 ){
      swal("Atención","Las compras deben contener al menos un producto para ser registradas.","error")
      return false;
    }else{
      //Aqui empiezo a agregar
      //Registro primero la compra
      var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
      var ajax_url = base_url + "compra/insertar_compra";
      var form_data = new FormData(form_compra);
      request.open("POST", ajax_url, true);
      request.send(form_data);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          //Solicitud exitosa
        var json = JSON.parse(request.responseText);
        if (json.status) {   
          swal({
            title:"Agregado correctamente 😀",
            text:json.msg,
            type:"success",
            showCancelButton:false,
            confirmButtonText:"Aceptar",
          },function(isConfirm){
            if(isConfirm){
              location.reload();
            }
          });    
        }else{
          swal("Posible error", json.msg, "error");
        }
      }
      }
    }
  }
}

