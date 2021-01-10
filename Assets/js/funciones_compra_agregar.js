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
function carga_modal_datos(){
tabla_productos = $("#tabla_productos").dataTable({
  aProcessing: true,
    aServerSide: true,
    language: {
      url : " " + base_url + "assets/js/idioma.json"
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
      { data: "imagen_producto"},
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 3,
    order: [[0, "desc"]],
    drawCallback: function () {

    }
});
}

function agregar_detalle(id_producto,nombre_producto){
  var request = window.XMLHttpRequest
              ? new XMLHttpRequest()
              : new ActiveXObject("Microsoft.XMLHTTP");
  var ajax_url = base_url + "producto/busca_producto/";
  //parametros a enviar por post
  var strData = 'id_producto='+ id_producto+'&nombre_producto='+ nombre_producto;
  request.open("POST", ajax_url, true);
  request.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  request.send(strData);
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var obj_json = JSON.parse(request.responseText);
      console.log(obj_json);
      if (obj_json.status) {
        swal("Saludos!", obj_json.data, "success");
        
      } else {
        swal("Atencion", obj_json.msg, "error");
      }
    }
  };
}