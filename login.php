<?php 
include("conexion2.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de secion de cliente</title>
    <link rel="stylesheet" href="ESTILOS/estilo.css">
    <link rel="stylesheet" href="ICONOS/css/fontello.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <div class="barra">
            <img src="IMAGENES/logo.png" alt="">
            <input type="checkbox" id="menu-barra">
            <label for="menu-barra" class="icon-menu"></label>

            <nav class="menu">
                <a href="index.php" class="icon-inicio">INICIO</a>
                <a href="conocenos.php" class="icon-conocenos">CONOCENOS</a>
                <a href="pedidos.php" class="icon-productos">PEDIDOS</a>
                <a href="#contactanos" class="icon-ubicacion">CONTACTANOS</a>
                <a href="tienda.php" class="icon-producto">TIENDA</a>
                <a href="carritoDeCompra.php" class="carrito">&#128722;</a>
                <a href="login.php" class="icon-usuario">INICIAR SECION</a>
            </nav>
        </div>
    </header>

    <div class="card_login_cliente">

        <form action="validacion.php" method="post">
            
            <input type="text" name="clave" id="" placeholder="&#128100 Clave de usuario">
            <input type="password" name="password" placeholder="&#128272 Contraseña">
            <input type="submit" value="Iniciar secion">
            <a href="registro.php" class="icon-usuario">Registrarse</a>
        </form>
    </div>
    
</body>
</html>