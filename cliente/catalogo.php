<?php 
include("../conexion2.php");
session_start();

$cve_categoria = $_GET['cve_categoria'];
$buscar_productos = "SELECT c.cve_categoria,c.nombre, c.descripcion as descripcion_categoria, cp.cve_prenda, pr.nombre, pr.descripcion as descripcion, ROUND(pr.precio,2) AS precio, pr.imagen as imagen
FROM categoria as c
INNER JOIN categorias_prendas as cp on cp.cve_categoria = c.cve_categoria
INNER JOIN prenda as pr on cp.cve_prenda = pr.cve_prenda
WHERE c.cve_categoria = '$cve_categoria'";
$buscar_productos = mysqli_query($conexion,$buscar_productos);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../ESTILOS/estilo.css?">
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
                <a href="index.php" class="icon-inicio">INICIO</a>
                <a href="secciones/pedidos.php" class="icon-productos">PEDIDOS</a>
                <a href="#contactanos" class="icon-ubicacion">CONTACTANOS</a>
                <a href="secciones/tienda.php" class="icon-producto">TIENDA</a>
                <a href="secciones/CarroDeCompra.php" class="carrito">&#128722;</a>
                <a href="cerrar_sesionCliente.php" class="icon-usuario">CERRSAR SESION</a>
            </nav>
        </div>
    </header>

    <div class="catalogo3">
        <section class="r_mujer">
            <?php while($producto = mysqli_fetch_array($buscar_productos)) {;?>
                <article class="r_m">
                    <a href=""><img src="../admin/secciones/<?php echo $producto['imagen'] ;?>" alt=""></a> <br>
                    <h3><?php echo $producto['nombre'] ;?></h3>
                    <a class="referencia" href="compra.php?cve_prenda=<?php echo $producto['cve_prenda'];?>"><h4>Ver producto</h4></a>
                </article>
            <?php }?>
        </section>
    </div>
    
</body>
</html>