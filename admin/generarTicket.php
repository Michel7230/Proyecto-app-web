<?php
include("../conexion2.php");
require 'fpdf/fpdf.php';

$cve_ventas = isset($_POST['cve_ventas']) ? $conexion->real_escape_string($_POST['cve_ventas']) : 1;

$sql = "SELECT cve_ventas, cve_cliente,DATE_FORMAT(fecha_venta , '%d-%m-%Y %H:%i %p') as fecha
FROM ventas
WHERE cve_ventas = $cve_ventas";
$resultado = mysqli_query($conexion, $sql);
$row_ventas = $resultado->fetch_assoc();
$fecha_venta = $row_ventas['fecha'];
$cve_cliente = $row_ventas['cve_cliente'];

$consulta = "SELECT cl.cve_cliente, CONCAT(p.nombre,' ',p.paterno,' ',p.materno) as nombre, telefono, direccion, correo,clave, password, cl.cve_cliente
FROM persona as p
INNER JOIN cliente as cl on p.cve_persona = cl.cve_persona
WHERE cl.cve_cliente = $cve_cliente";
$cliente = mysqli_query($conexion, $consulta);
$cliente = $cliente->fetch_assoc();
$Cliente = $cliente['nombre'];

$sql2 = "SELECT cantidad, dv.total as total,pr.cve_prenda ,pr.nombre as prenda, ROUND(pr.precio,2) as precio, pr.descripcion as descripcion
FROM ventas as v
INNER JOIN detalle_ventas as dv on dv.cve_ventas = v.cve_ventas
INNER JOIN prenda as pr on pr.cve_prenda = dv.cve_prenda
WHERE v.cve_ventas = $cve_ventas
ORDER BY v.cve_ventas";
$detalle = mysqli_query($conexion, $sql2);

$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 4);

$pdf->Image('../IMAGENES/logo.png', 15, 2, 45);
$pdf->Ln(8);

$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 5, 'Cliente: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(15, 5, $cliente['nombre'], 0, 1, 'L');

$pdf->Cell(70, 2, '------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');

$pdf->Cell(10, 4, 'Cant.', 0, 0,'L');
$pdf->Cell(30, 4, 'Descripcion', 0, 0,'L');
$pdf->Cell(15, 4, 'Precio', 0, 1,'L');

$pdf->Cell(70, 2, '------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');

$total = 0;
$pdf->SetFont('Arial', '', 7);
while($row_producto = $detalle->fetch_assoc()){
    $venta = $row_producto['cantidad'] * $row_producto['precio'];
    $total += $venta;

    $pdf->Cell(10, 4, $row_producto['cantidad'], 0, 0,'L');
    $pdf->Cell(30, 4, $row_producto['prenda'], 0, 0,'L');
    $pdf->Cell(15, 4, $row_producto['precio'], 0, 1,'L');
}

$pdf->Cell(70, 2, '------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 5, 'Total de compra: ', 0, 0, 'L');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 5, $total, 0, 1, 'R');

$pdf->Cell(70, 2, '------------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'L');

$pdf->Ln(2);

$pdf->Cell(35, 5, 'Fecha: ' . $fecha_venta, 0, 1, 'C');

$pdf->Output();
?>