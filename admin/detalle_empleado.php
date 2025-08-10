<?php 
include("../conexion2.php");

$cve_administrador = $_GET['cve_administrador'];
$consulta = "SELECT CONCAT(p.nombre,' ',p.paterno,' ',p.materno) as nombre, clave, password, cve_administrador 
FROM persona as p
INNER JOIN administrador as ad on p.cve_persona = ad.cve_persona
WHERE cve_administrador = $cve_administrador";
$consulta = mysqli_query($conexion,$consulta);
$empleado = mysqli_fetch_array($consulta);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="../ESTILOS/estilo.css">
  <link rel="stylesheet" href="secciones/estilos2.css">
  <link rel="stylesheet" href="../ICONOS/css/fontello.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <div class="barra">
            <img src="../IMAGENES/logo.png" alt="">
            <input type="checkbox" id="menu-barra">
            <label for="menu-barra" class="icon-menu"></label>

            <nav class="menu">
                <a href="inicio.php" class="icon-inicio">INICIO</a>
                <a href="secciones/pedidos_registro.php" class="icon-productos">PEDIDOS</a>
                <a href="secciones/citas.php" class="icon-ubicacion">CITAS</a>
                <a href="secciones/tienda.php" class="icon-producto">TIENDA</a>
                <a href="ventas.php">VENTAS</a>
                <a href="secciones/emails.php">&#9993; BUZON DE EMAILS</a>
                <a href="cerrar_secion.php">Cerrar sesion</a>
            </nav>
        </div>
    </header>

    <div class="tabla_datos">
        <h3>Datos del empleado</h3>
        <div>
            <section>
                <table>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nombre: </td>
                        <td><?php echo $empleado['nombre']; ?></td>
                    </tr> <br>
                    <tr>
                        <td>Clave: </td>
                        <td><?php echo $empleado['clave']; ?>
                        </td>
                    </tr> <br>
                    <tr>
                        <td>Password: </td>
                        <td> <?php echo $empleado['password']; ?></td>
                    </tr>
                </table>
            </section>
        </div>
    </div>
    
</body>
</html>