<?php
include("../../conexion2.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total = $_POST['total'];
    $productos = json_decode($_POST['productos'], true);
    $cve_cliente = $_SESSION['cve_cliente'];

    $sql = "INSERT INTO ventas(cve_cliente,fecha_venta) VALUES('$cve_cliente',NOW())";
    $resultado = mysqli_query($conexion, $sql);
    $cve_ventas = mysqli_insert_id($conexion);

    foreach ($productos as $producto) {
        $cve_prenda = $producto['cve_prenda'];
        $cantidad = $producto['cantidad'];
        $agregar_relacion = "INSERT INTO detalle_ventas(cve_ventas,cve_prenda,cantidad,total) VALUES('$cve_ventas','$cve_prenda','$cantidad','$total')";
        $r_agregar_relacion = mysqli_query($conexion, $agregar_relacion);
    }

    $_SESSION['carrito'] = [];
}

?>