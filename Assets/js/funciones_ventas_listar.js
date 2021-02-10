document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector('#tabla_ventas')) {
        if (typeof tipo === 'undefined') {
            tipo=13;
        }
        if (tipo==1) {
            carga_ventas(tipo);
        }else if(tipo==2){
            carga_ventas(tipo);
        }else{
            window.location.href=base_url+"venta/listar_ventas_general";
        }

    }
});
var tabla_ventas = $("#tabla_ventas");
function carga_ventas(tipo) {
    tabla_ventas = $("#tabla_ventas").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: " " + base_url + "assets/js/idioma.json",
      },
      ajax: {
        url: " " + base_url + "venta/listar_ventas_r/"+tipo,
        dataSrc: "",
      },
      bAutoWidth: false,
      columns: [
        { data: "ID_VENTA" },
        { data: "FECHA_VENTA" },
        { data: "NOMBRE_CAJERO" },
        { data: "NOMBRE_CLIENTE" },
        { data: "TOTAL_PAGADO" },
        { data: "OPCIONES" },
      ],
      responsive: true,
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
      drawCallback: function () {
        ver_venta_completa();
        eliminar_ventas();
      },
    });
  }

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
   function eliminar_ventas(){
     var btn_eliminar_venta = document.querySelectorAll(".eliminarVenta");
     btn_eliminar_venta.forEach(function(btn_eliminar_venta){
      btn_eliminar_venta.addEventListener('click',function(){
        var id_venta = this.getAttribute("rl");
        swal({
          title:"Eliminar venta",
          text:"Al eliminar la venta la cantidad vendida se reposicionará al stock, y esta venta pasará a estar en el historial de ventas eliminadas.",
          type:"warning",
          showCancelButton:true,
          confirmButtonText:"Sí, eliminar venta.",
          cancelButtonText:"No, cancelar eliminación.",
          closeOnConfirm:false,
          closeOnCancel:true
      },function(isConfirm){
          if(isConfirm){
              var solicitud = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
              var ajax_url = base_url+'venta/eliminar_venta/'; 
              var str_data = "id_venta="+id_venta;
              solicitud.open("POST",ajax_url,true);
              solicitud.setRequestHeader("Content-type","application/x-www-form-urlencoded");
              solicitud.send(str_data);
              solicitud.onreadystatechange = function(){
                  if(solicitud.readyState == 4 && solicitud.status == 200){
                      var obj_data = JSON.parse(solicitud.responseText);
                      if(obj_data.status){
                          /*swal("Eliminar!",obj_data.msg,"success");
                          location.reload();*/
                          swal({
                            title:"Venta eliminada",
                            text:"La venta ahora podrá ser visualizada en ventas eliminadas.",
                            type:"success",
                            showCancelButton:false,
                            confirmButtonText:"Aceptar.",
                            closeOnConfirm:false, 
                            closeOnCancel:false
                        },function(isConfirm){
                          if(isConfirm){
                            location.reload();
                          }
                        });

                      }else{
                         swal("Atencion!",obj_data.msg,"error"); 
                      }
                  }
              }
          }
          
      });
      });
     });
   }

