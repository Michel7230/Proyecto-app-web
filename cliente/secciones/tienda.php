<?php 
include("../../conexion2.php");

$buscar_productos = "SELECT c.nombre, cp.cve_categoria, cp.cve_prenda, pr.nombre as nombre, pr.descripcion, pr.precio, pr.imagen as imagen_producto
FROM categoria as c
INNER JOIN categorias_prendas as cp on cp.cve_categoria = c.cve_categoria
INNER JOIN prenda as pr on cp.cve_prenda = pr.cve_prenda";
$buscar_productos = mysqli_query($conexion,$buscar_productos);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="../../ESTILOS/estilo.css?2">
    <link rel="stylesheet" href="../../ICONOS/css/fontello.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <header>
        <div class="barra">
            <img src="../../IMAGENES/logo.png" alt="">
            <input type="checkbox" id="menu-barra">
            <label for="menu-barra" class="icon-menu"></label>

            <nav class="menu">
                <a href="../index.php" class="icon-inicio">INICIO</a>
                <a href="pedidos.php" class="icon-productos">PEDIDOS</a>
                <a href="#contactanos" class="icon-ubicacion">CONTACTANOS</a>
                <a href="tienda.php" class="icon-producto">TIENDA</a>
                <a href="CarroDeCompra.php" class="carrito">&#128722;</a>
                <a href="../cerrar_sesionCliente.php" class="icon-usuario">CERRSAR SESION</a>
            </nav>
        </div>
    </header>

    <div class="catalogo">
        <section class="articulos_t">
            <?php while($prod = mysqli_fetch_array($buscar_productos)){?>
                <article class="ropa">
                    <a href="../compra.php?cve_prenda=<?php echo $prod['cve_prenda'];?>"><img src="../../admin/secciones/<?php echo $prod['imagen_producto']; ?>" alt="" style="height: 150px;"></a>
                    <h3><?php echo $prod['nombre']; ?></h3>
                </article>
            <?php }?>
        </section>
    </div>
    
</body>
</html>