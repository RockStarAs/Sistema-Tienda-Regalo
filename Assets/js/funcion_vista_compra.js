function calcular_totales(){
    var arreglo = document.getElementsByName("subtotal");
    var total = document.getElementById("#total");
    var costo_total = 0.0;
    for (var index = 0; index < arreglo.length; index++) {
        costo_total += parseFloat(arreglo[index].textContent);
    }
    $("#total").html("S/." + costo_total);
}
calcular_totales();