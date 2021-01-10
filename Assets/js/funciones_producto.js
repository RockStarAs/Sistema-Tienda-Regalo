var tabla_productos;
document.addEventListener("DOMContentLoaded", function () {
  tabla_productos = $("#tabla_productos").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url : " " + base_url + "assets/js/idioma.json"
    },
    ajax: {
      url: " " + base_url + "producto/listar_productos",
      dataSrc: "",
    },
    columns: [
      { data: "id_producto" },
      { data: "nombre_producto" },
      { data: "id_categoria" },
      { data: "stock_producto" },
      { data: "precio_unitario_venta" },
      { data: "precio_compra_actualizado" },
      { data: "estado_producto" },
      { data: "opciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
    drawCallback: function () {
      ftnEditar_Producto();
      ftnEliminarProducto();
    },
  });
  //Insertar y modificar un producto
  var form_productos = document.querySelector("#frm_agregar_producto");
  form_productos.onsubmit = function (e) {
    e.preventDefault();
    if (document.querySelector("#id_producto")) {
      var int_Id_prod = document.querySelector("#id_producto").value;
      var foto_actual=document.querySelector("#id_producto").value;
      var foto_remove=document.querySelector("#id_producto").value;
      if(int_Id_prod == '' || foto_actual=='' || foto_remove==''){
        swal("Atención","Todos los campos deben ser obligatorios","error");
        return false;
      }
    }
    var nombre_producto = document.querySelector("#txt_nombre").value;
    var precio_unitario_venta = document.querySelector("#txt_precio_venta")
      .value;
    var precio_compra_actualizado = document.querySelector("#txt_precio_compra")
      .value;
    var stock_producto = document.querySelector("#txt_stock").value;
    var producto_categoria = document.querySelector("#categoria_id").value;
    if (
      nombre_producto == "" ||
      precio_unitario_venta == "" ||
      precio_compra_actualizado == "" ||
      stock_producto == "" ||
      producto_categoria == ""
    ) {
      swal("Atención", "Todos los campos son obligatorios.", "error");
      return false;
    }
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    var ajax_url = base_url + "producto/insertar_producto";

    var form_data = new FormData(form_productos);
    request.open("POST", ajax_url, true);
    request.send(form_data);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var json = JSON.parse(request.responseText);
        if (json.status) {
          $("#modal_form_agrega_producto").modal("hide");
          form_productos.reset();
          swal("Añadido", json.msg, "success");
          tabla_productos.ajax.reload(function () {
            //fntListarCategorias();
          });
        } else {
          swal("¡Error!", json.msg, "error");
        }
      }
    };
  };
  
});

$("#tabla_productos").DataTable();
window.addEventListener(
  "load",
  function () {
    setTimeout(() => {
      fntListarCategorias();
      foto_carga();
    }, 500);
  },
  false
);
function ftnEditar_Producto() {
  var btnEditar_Producto = document.querySelectorAll(".btnEditar_Producto");
  btnEditar_Producto.forEach(function (btnEditar_Producto) {
    btnEditar_Producto.addEventListener("click", function () {
      if (document.querySelector("#id_producto")) {
        $("#id_producto").remove();
        $("#foto_actual").remove();
        $("#foto_remove").remove();
      }
      document.querySelector("#titulo_Modal").innerHTML = "Actualizar Producto ";
      document.querySelector(".modal-header").classList.replace("modalHeaderRegistro","modalHeaderActualizar");
      document.querySelector("#btnAccion_Form").classList.replace("btn-primary", "btn-info");
      document.querySelector("#btn_Text").innerHTML = "Actualizar";
      $(".frm").append("<input type='hidden' id='id_producto' name='id_producto'>");
      $(".frm").append("<input type='hidden' id='foto_actual' name='foto_actual'>");
      $(".frm").append("<input type='hidden' id='foto_remove' name='foto_remove'>");

      var id_producto = this.getAttribute("rl");
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajax_url = base_url + "producto/seleccionar_producto/" + id_producto;
      request.open("GET", ajax_url, true);
      request.send();

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          remove_foto();
          var obj_json = JSON.parse(request.responseText);
          if (obj_json.status) {
            document.querySelector("#id_producto").value = obj_json.data.id_producto;
            document.querySelector("#txt_nombre").value = obj_json.data.nombre_producto;
            document.querySelector("#txt_descripcion").value =
              obj_json.data.descripcion_producto != "Ninguna"
                ? obj_json.data.descripcion_producto
                : "";
            document.querySelector("#txt_stock").value = obj_json.data.stock_producto;
            document.querySelector("#txt_precio_venta").value =
              Math.round(obj_json.data.precio_unitario_venta * 100) / 100;
            document.querySelector("#txt_precio_compra").value =
              Math.round(obj_json.data.precio_compra_actualizado * 100) / 100;
            document.querySelector("#txtCodigo").value = obj_json.data.codigo_barras;
            document.querySelector("#categoria_id").value = obj_json.data.id_categoria;
            $("#categoria_id").selectpicker("render"); 
            if (obj_json.data.imagen_producto != "img_producto.png") {
              $(".prevPhoto").append(
                "<img id='img' src=./../Assets/images/uploads/" +
                  obj_json.data.imagen_producto +
                  ">"
              );
              $("#text").hide();
              $(".delPhoto").removeClass("notBlock"); 
            }
            document.querySelector("#foto_actual").value =
              obj_json.data.imagen_producto;
            document.querySelector("#foto_remove").value =
              obj_json.data.imagen_producto;
            
            $("#modal_form_agrega_producto").modal("show");
          } else {
            swal("Error", obj_json.msg, "error");
          }
        }
      };
    });
  });
}

function fntListarCategorias() {
  var ajax_url = base_url + "categoria/devolver_categorias";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajax_url, true);
  request.send();
 
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#categoria_id").innerHTML = request.responseText;
      document.querySelector("#categoria_id").value = 1;
      $("#categoria_id").selectpicker("render");
    }
  };
}
function foto_carga() {
  $(document).ready(function () {
    //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change", function () {
      var uploadFoto = document.getElementById("foto").value;
      var foto = document.getElementById("foto").files;
      var nav = window.URL || window.webkitURL;
      var contactAlert = document.getElementById("form_alert");
      if (uploadFoto != "") {
        var type = foto[0].type;
        var name = foto[0].name;
        if (
          type != "image/jpeg" &&
          type != "image/jpg" &&
          type != "image/png"
        ) {
          contactAlert.innerHTML =
            '<p class="errorArchivo">El archivo no es válido.</p>';
          $("#img").remove();
          $(".delPhoto").addClass("notBlock");
          $("#foto").val("");
          return false;
        } else {
          contactAlert.innerHTML = "";
          $("#text").hide();
          $("#img").remove();
          $(".delPhoto").removeClass("notBlock");
          var objeto_url = nav.createObjectURL(this.files[0]);
          $(".prevPhoto").append("<img id='img' src=" + objeto_url + ">");
          $(".upimg label").remove();
        }
      } else {
        alert("No selecciono foto");
        $("#img").remove();
      }
    });

    $(".delPhoto").click(function () {
      remove_foto();
      if ($("#foto_actual") && $("#foto_remove")) {
        $("#foto_remove").val("img_producto.png");
      }
    });
  });
}
function remove_foto() {
  $("#text").show();
  document.querySelector("#foto").value = "";
  if (document.querySelector(".errorArchivo")) {
    $(".errorArchivo").remove();
  }
  document.querySelector(".delPhoto").classList.add("notBlock");
  if (document.querySelector("#img")) {
    document.querySelector("#img").remove();
  }
}
function abrir_modal() {
  if (document.querySelector("#id_producto")) {
    $("#id_producto").remove();
    $("#foto_actual").remove();
    $("#foto_remove").remove();
  }
  document.querySelector("#titulo_Modal").innerHTML = "Nuevo Producto ";
  document.querySelector(".modal-header").classList.replace("modalHeaderActualizar", "modalHeaderRegistro");
  document.querySelector("#btnAccion_Form").classList.replace("btn-info", "btn-primary");
  document.querySelector("#btn_Text").innerHTML = "Guardar";
  document.querySelector("#frm_agregar_producto").reset();
  remove_foto();
  $("#modal_form_agrega_producto").modal("show");
}

function ftnEliminarProducto() {
  var btnEliminar_Producto = document.querySelectorAll(".btnEliminar_Producto");
  btnEliminar_Producto.forEach(function (btnEliminar_Producto) {
    btnEliminar_Producto.addEventListener("click", function () {
      var id_producto = this.getAttribute("rl");
      swal(
        {
          title: "Eliminar Producto",
          text: "¿Realmente quiere eliminar el Producto?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Sí,eliminar!",
          cancelButtonText: "No, cancelar!",
          closeOnConfirm: false,
          closeOnCancel: true,
        },
        function (isConfirm) {
          if (isConfirm) {
            var request = window.XMLHttpRequest
              ? new XMLHttpRequest()
              : new ActiveXObject("Microsoft.XMLHTTP");
            var ajax_url = base_url + "producto/eliminar_producto/";
            var strData = "id_producto=" + id_producto;
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
                  swal("Eliminar!", obj_json.msg, "success");
                  tabla_productos.ajax.reload(function () {
                    setTimeout(() => {
                      ftnEditar_Producto();
                      ftnEliminarProducto();
                    }, 500);
                  });
                } else {
                  swal("Atencion", obj_json.msg, "error");
                }
              }
            };
          }
        }
      );
    });
  });
}
