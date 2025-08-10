<?php 
include("../../conexion2.php");

$buscar_cliente = "SELECT ci.cve_citas,CONCAT(pe.nombre,' ',pe.paterno,' ',pe.materno) as nombre_cliente , DATE_FORMAT(fecha, '%d-%m-%Y %H:%i %p') as fecha,mensaje,
ci.imagen as imagen FROM persona as pe 
INNER JOIN cliente as c on pe.cve_persona = c.cve_persona
INNER JOIN citas as ci on c.cve_cliente = ci.cve_cliente";
$resultado_buscar_cliente = mysqli_query($conexion,$buscar_cliente);


if(isset($_REQUEST['eliminar'])){
    $eliminar = $_REQUEST['eliminar'];
    $eliminar_cita = "DELETE FROM citas WHERE cve_citas = $eliminar";
    mysqli_query($conexion, $eliminar_cita);
}


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


    <div>

        <table class="tabla_citas">
            <thead>
                <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Fecha de la cita</th>
                    <th scope="col">Mensaje</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Estado de la cita</th>
                    <th></th>
                </tr>
            </thead>

            <?php while($list = mysqli_fetch_array($resultado_buscar_cliente)) {?>
                <tr class="">
                    <td><?php echo $list['nombre_cliente']; ?></td>
                    <td><?php echo $list['fecha']; ?></td>
                    <td><?php echo $list['mensaje']; ?></td>
                    <td><img src="<?php echo $list['imagen']; ?>" alt="" style="height: 150px;"></td>
                    <td></td>
                    <td><a href="citas.php?eliminar=<?php echo $list['cve_citas']; ?>">Eliminar</a></td>
                </tr>
            <?php }?>
            
        </table>
        
    </div>

</body>
</html>