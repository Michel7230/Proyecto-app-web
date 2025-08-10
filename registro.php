<?php
include("conexion2.php");

if (isset($_POST["registrar"])){
    $nombre = $_POST["nombre"];
    $paterno = $_POST["paterno"];
    $materno = $_POST["materno"];
    $edad = $_POST["edad"];

    $sql = "INSERT INTO persona(nombre,paterno,materno,edad) VALUES()";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="ESTILOS/estilo.css?2">
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
    <div class="formulario_De_Registro">
        <form method="post" autocomplete="off" class="formularioRegistro">
            <h2>Registrate ahorra</h2>
            <div class="ContenedorInputsRegistro">
                <label for="">Nombre</label>
                <input type="text" name="nombre" id="nombre">
                <label for="">Apellido paterno</label>
                <input type="text" name="paterno" id="paterno">
                <label for="">Apellido materno: </label>
                <input type="text" name="materno" id="materno">
                <label for="">Edad: </label>
                <input type="email" name="edad" id="edad">
                <label for="">Correo electronico</label>
                <input type="email" name="correo" id="correo">
                <label for="">Telefono</label>
                <input type="tel" name="telefono" id="telefono">
                <label for="">Direccion</label>
                <input type="text" name="direccion" id="direccion">
                <label for="">Clave: </label>
                <input type="text" name="clave" id="clave">
                <label for="">Password: </label>
                <input type="text" name="password" id="password">
                <input type="submit" value="Iniciar secion" name="registrar">
            </div>
        </form>
    </div>
</body>
</html>