<?php 
session_start();
include("../../conexion2.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../ESTILOS/estilo.css">
    <link rel="stylesheet" href="../../ICONOS/css/fontello.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="barra">
            <img src="../../IMAGENES/logo.png" alt="">
            <input type="checkbox" id="menu-barra">
            <label for="menu-barra" class="icon-menu"></label>

            <nav class="menu">
                <a href="../inicio.php" class="icon-inicio">INICIO</a>
                <a href="pedidos_registro.php" class="icon-productos">PEDIDOS</a>
                <a href="citas.php" class="icon-ubicacion">CITAS</a>
                <a href="tienda.php" class="icon-producto">TIENDA</a>
                <a href="../ventas.php">VENTAS</a>
                <a href="emails.php">&#9993; BUZON DE EMAILS</a>
                <a href="../cerrar_secion.php">Cerrar sesion</a>
            </nav>
        </div>
    </header>
</body>
</html>