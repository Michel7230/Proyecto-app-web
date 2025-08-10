<?php
include("../conexion2.php");

$consulta = "SELECT CONCAT(p.nombre,' ',p.paterno,' ',p.materno) as nombre, telefono, direccion, correo,clave, password, cl.cve_cliente, v.cve_ventas, DATE_FORMAT(v.fecha_venta , '%d-%m-%Y %H:%i %p') as fecha, dv.cantidad as cantidad, dv.total as total,pr.cve_prenda ,pr.nombre as prenda, ROUND(pr.precio,2) as precio, pr.descripcion as descripcion,
pr.imagen as imagen
FROM persona as p
INNER JOIN cliente as cl on p.cve_persona = cl.cve_persona
INNER JOIN ventas as v on cl.cve_cliente = v.cve_cliente
INNER JOIN detalle_ventas as dv on dv.cve_ventas = v.cve_ventas
INNER JOIN prenda as pr on pr.cve_prenda = dv.cve_prenda
ORDER BY v.cve_ventas";
$resultado = mysqli_query($conexion, $consulta);

$ventas_agrupadas = array();

while ($venta = mysqli_fetch_assoc($resultado)) {
    $cve_ventas = $venta['cve_ventas'];

    if (!isset($ventas_agrupadas[$cve_ventas])) {
        $ventas_agrupadas[$cve_ventas] = array(
            'fecha' => $venta['fecha'],
            'nombre' => $venta['nombre'],
            'productos' => array()
        );
    }

    $ventas_agrupadas[$cve_ventas]['productos'][] = array(
        'prenda' => $venta['prenda'],
        'cantidad' => $venta['cantidad'],
        'total' => $venta['total'],
        'precio' => $venta['precio'],
        'descripcion' => $venta['descripcion'],
        'imagen' => $venta['imagen']
    );
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['eliminar'])) {
        if (isset($_POST['cve_ventas'])) {
            $cve_ventas = $_POST['cve_ventas'];

            $consulta_eliminar_detalle = "DELETE FROM detalle_ventas WHERE cve_ventas = ?";
            $stmt_detalle = $conexion->prepare($consulta_eliminar_detalle);
            $stmt_detalle->bind_param('i', $cve_ventas);

            if ($stmt_detalle->execute()) {
                $consulta_eliminar_venta = "DELETE FROM ventas WHERE cve_ventas = ?";
                $stmt_venta = $conexion->prepare($consulta_eliminar_venta);
                $stmt_venta->bind_param('i', $cve_ventas);

                if ($stmt_venta->execute()) {
                    echo "La venta se ha eliminado correctamente.";
                } else {
                    echo "Error al eliminar la venta.";
                }
            } else {
                echo "Error al eliminar los detalles de la venta.";
            }
        } else {
            echo "No se ha recibido el ID de la venta.";
        }
        header('Location: ventas.php');
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../ESTILOS/estilo.css">
  <link rel="stylesheet" href="secciones/estilos2.css?2">
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
    <div class="contenedor_ventas">
        <?php foreach ($ventas_agrupadas as $cve_ventas => $venta) { ?>
            <div class="venta">
                <h2>Fecha: <?php echo $venta['fecha']; ?></h2>
                <p>Nombre del cliente: <?php echo $venta['nombre']; ?></p>
                <?php foreach ($venta['productos'] as $producto) { ?>
                    <div class="producto">
                        <img src="secciones/<?php echo $producto['imagen']; ?>" alt="" style="height: 80px;">
                        <p>Prenda: <?php echo $producto['prenda']; ?></p>
                        <p>Cantidad: <?php echo $producto['cantidad']; ?></p>
                        <p>Precio: <?php echo $producto['precio']; ?></p>
                        <p>Descripción: <?php echo $producto['descripcion']; ?></p>
                    </div>
                <?php } ?>
                <p>Total de la compra: <?php echo $producto['total']; ?></p>
                <div>
                    <form action="" method="POST">
                        <input type="hidden" name="cve_ventas" value="<?php echo $cve_ventas; ?>">
                        <button type="submit" name="eliminar">Eliminar Venta</button>
                    </form>

                    <form action="generarTicket.php" method="POST">
                        <input type="hidden" name="cve_ventas" value="<?php echo $cve_ventas; ?>">
                        <button type="submit" name="eliminar">Generar ticket</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>

</body>
</html>