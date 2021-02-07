<?php
require_once('FPDF/fpdf.php');
class PDF extends FPDF
{
    private $nombre_cliente;
    private $nombre_cajero;
    private $id_venta;
    private $fecha_venta;
    private $tipo_venta;
// Cabecera de página
function Header_2($fecha_venta,$nombre_cliente,$id_venta,$nombre_cajero,$tipo_venta)
{
    $cadena_tipo_venta = $tipo_venta == 1 ? "NORMAL" : "POR MAYOR";
    $fecha_venta2 = date_create("$fecha_venta");
    $this->SetFont('Helvetica','',12);
    $this->Cell(60,4,utf8_decode("REGALOS PEÑA"),0,1,'C');
    $this->Ln(2);
    $this->SetFont('Helvetica','',10);
    $this->Cell(60,4,'PROFORMA VENTA',0,1,'C');
    $this->Cell(60,4,'FECHA: '.date_format($fecha_venta2,"d/m/Y"),0,1,'C');
    $this->Cell(60,4,'HORA: '.date_format($fecha_venta2,"H:m A"),0,1,'C');
    $this->Ln(2);
    $this->SetFont('Helvetica','',8);
    $this->Cell(60,4,"Cliente: ". utf8_decode($nombre_cliente),0,1,'C');
    $this->Cell(60,4,"ID de Venta: ". utf8_decode($id_venta),0,1,'C');
    $this->Cell(60,4,"Cajero: ". utf8_decode($nombre_cajero),0,1,'C');
    $this->Cell(60,4,"Tipo venta: $cadena_tipo_venta",0,1,'C');
    //$this->Cell(60,4,'alfredo@lacodigoteca.com',0,1,'C');
}
function CargarDatos($array_detalles_venta,$total_pagado,$estado_venta,$tipo_pago,$id_voucher,$pago_con){
    // COLUMNAS
    $this->SetFont('Helvetica', 'B', 7);
    $this->Cell(5, 10, 'Cod.', 0);
    //$this->Cell(12, 10, 'Art.',0,0,'C');
    $this->Cell(12, 10, 'Prec.',0,0,'C');
    $this->Cell(8, 10, 'Cant.',0,0,'R');
    $this->Cell(10, 10, 'Desc.',0,0,'R');
    $this->Cell(12, 10, 'Tot.',0,0,'R');
    $this->Ln(8);
    $this->Cell(60,0,'','T');
    $this->Ln(0);
    $total_a_pagar = 0;
    //CARGA DE DATOS
    for ($i=0; $i < count($array_detalles_venta) ; $i++) { 
        $codigo_producto = $array_detalles_venta[$i]['CODIGO_PRODUCTO'];
        $nombre_producto = $array_detalles_venta[$i]['NOMBRE_PRODUCTO'];
        $precio = $array_detalles_venta[$i]['PRECIO'];
        $cantidad = $array_detalles_venta[$i]['CANTIDAD_VENDIDA'];
        $descuento_aplicado = $array_detalles_venta[$i]['DESCUENTO_APLICADO'];
        $total = ($cantidad * $precio) - $descuento_aplicado;
        
        $total_a_pagar = $total_pagado;
        $this->Cell(21,10,$nombre_producto,0,0,'L');
        $this->Ln(4);
        $this->Cell(5, 10,$codigo_producto, 0);
        //$this->Cell(12, 10, utf8_decode(strtoupper(substr($nombre_producto, 0,7))),0,0,'C');
        $this->Cell(12, 10, "S/.".round($precio,2),0,0,'R');
        $this->Cell(8, 10, $cantidad,0,0,'C');
        $this->Cell(10, 10, "S/.".round($descuento_aplicado,2),0,0,'R');
        $this->Cell(12, 10, "S/.".round($total,2) ,0,0,'R');  
        $this->Ln(4);
    }
    $this->Ln(8);
    $this->Cell(60,0,'','T');
    $this->Carga_total(round($total_a_pagar,2),$estado_venta,$tipo_pago,$id_voucher,$pago_con);
}
// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
}
function Carga_total($total_a_pagar,$estado_venta,$tipo_pago,$id_voucher,$pago_con){


    $this->setX(10);
    $this->Cell(5,10,"TOTAL A PAGAR: " );
    $this->setX(38);
    $this->Cell(5,10,"S/.".$total_a_pagar,0,0,"R");
    $this->Ln(6);
    if($tipo_pago == 0){
        $this->setX(10);
        $this->Cell(5,10,"TIPO DE PAGO: PAGO EN EFECTIVO" );
        $this->Ln(4);
        $this->Cell(5,10,"PAGO CON S/. ".round($pago_con,2),0,0,"L");
        $this->Ln(4);
        $this->Cell(5,10,"CAMBIO O VUELTO: S/. ".round($pago_con - $total_a_pagar,2),0,0,"L");        
    }else{
        if($tipo_pago == 1){
            $this->setX(10);
            $this->Cell(5,10,"TIPO DE PAGO: PAGO CON TARJETA" );
            $this->Ln(4);
            $this->Cell(5,10,"ID DE VOUCHER GENERADO: ". $id_voucher,0,0,"L");
            $this->Ln(4);
        }else{
            $this->setX(10);
            $this->Cell(5,10,"TIPO DE PAGO: PAGADO POR YAPE" );
            $this->Ln(4);
            
        }
    }
    $this->setX(10);
    if($estado_venta == 0){
        $this->Cell(5,15+6,'ESTA VENTA FUE ELIMINADA');
    }else{
        $this->Cell(5,15+6,'GRACIAS POR TU COMPRA ');
    }
}
function genera_pdf($id_venta){
    require_once('venta.php');
    $id_venta = desencriptar($id_venta);
    if(ctype_digit($id_venta)){
        $venta = new Venta();
        $json = $venta->busca_venta_con_datos($id_venta); 
        if($json["status"]){
            $pdf = new PDF('P','mm',array(80,150));
            $pdf->SetTitle(utf8_decode("Ticket de venta : TIENDA DE REGALOS PEÑA -> Nro: $id_venta"));
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Header_2($json['FECHA_VENTA'],$json['NOMBRE_CLIENTE'],$json['ID_VENTA'],$json['NOMBRE_CAJERO'],$json['TIPO_VENTA']);
             //HEADER
            $pdf->CargarDatos($json['detalles_venta'],$json['TOTAL_PAGADO'],$json['ESTADO_VENTA'],$json['TIPO_PAGO'],$json['ID_VOUCHER'],$json['PAGO_CON']);
            $pdf->Output();    
        }else{
            echo "Error con el servidor";
        }
    }else{
        echo "Error con el servidor";
    }
    
    die();
}
}

?>