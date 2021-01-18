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
      columns: [
            { data: "ruc_dni" },
            { data: "nombre_proveedor" },
            { data: "fecha_registro_compra" },
            { data: "estado_compra" },
            { data: "boleta_factura" },
            { data: "opciones_compra" } 
      ],
      responsive: true,
      bDestroy: true,
      iDisplayLength: 10, 
      order: [[0, "desc"]],
      drawCallback: function () {
        ver_compra_con_detalles()
        cambiar_estado_compra()
      },
    });

    

}); 
function cambiar_estado_compra(){
  var btn_cambiar_estado = document.querySelectorAll(".recibirCompra");
  btn_cambiar_estado.forEach(function(btn_cambiar_estado){
    btn_cambiar_estado.addEventListener('click',function(){
      var id_compraa = this.getAttribute("rl");
      
      var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      var ajax_url = base_url+'compra/actualiza_compra/'+id_compraa;
      request.open("GET",ajax_url,true);
      request.send();
      request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
          var obj_json = JSON.parse(request.responseText); 
          if(obj_json.status){
             location.reload();
          }else{
               swal("Error",obj_json.msg,"error");  
          }
      }
    }
    });
  });
}
function ver_compra_con_detalles(){
  var btn_ver_compra = document.querySelectorAll(".verCompra");
  btn_ver_compra.forEach(function(btn_ver_compra){
    btn_ver_compra.addEventListener('click',function(){
      var id_compra = this.getAttribute("rl");
      
      var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      var ajax_url = base_url+'compra/ver_compra_con_detalles/'+id_compra;

      window.open(ajax_url,"Vista");
    })
  })
}