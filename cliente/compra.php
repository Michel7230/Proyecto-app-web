<?php 
include("../conexion2.php");
session_start();
$cve_prenda = $_GET['cve_prenda'];
$buscar_productos = "SELECT c.nombre, cp.cve_categoria, cp.cve_prenda, pr.cve_prenda, pr.nombre as prenda, pr.descripcion as descripcion, ROUND(pr.precio,2) AS precio, pr.imagen as imagen
FROM categoria as c
INNER JOIN categorias_prendas as cp on cp.cve_categoria = c.cve_categoria
INNER JOIN prenda as pr on cp.cve_prenda = pr.cve_prenda
WHERE pr.cve_prenda = '$cve_prenda'";
$buscar_productos = mysqli_query($conexion,$buscar_productos);
$prenda = mysqli_fetch_array($buscar_productos);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cve_prenda'])) {
  $cve_prenda = $_GET['cve_prenda'];
  $producto = "SELECT pr.cve_prenda, pr.nombre as prenda, pr.descripcion as descripcion, ROUND(pr.precio,2) AS precio, pr.imagen as imagen
  FROM prenda as pr 
  INNER JOIN detalle_ventas as dv on dv.cve_prenda = pr.cve_prenda
  INNER JOIN ventas as vn on vn.cve_ventas = dv.cve_ventas
  WHERE pr.cve_prenda = '$cve_prenda'";
  $producto = mysqli_query($conexion,$producto);
  $prenda = mysqli_fetch_array($producto);

  if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
  }

  if (isset($_GET['agregarAlCarrito'])) {
    $_SESSION['carrito'][] = $cve_prenda;
  }

}


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Compra</title>
  <link rel="stylesheet" href="../ESTILOS/estilo.css?234">
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

  <section class="formulario_producto">
    <div class="contenedor_producto">
      <form action="" method="get">
      <?php if(isset($prenda)) { ?>
        <img src="../admin/secciones/<?php echo $prenda['imagen']; ?>" alt="" style="height: 180px;">
        <label for="nombre">Nombre: <?php echo $prenda['prenda']; ?></label>
        <input type="hidden" name="cve_prenda" value="<?php echo $prenda['cve_prenda']; ?>">
        <input type="hidden" name="precio" value="<?php echo $prenda['precio']; ?>">
        <h4>Descripcion: <?php echo $prenda['descripcion']; ?></h4>
        <h4>Precio: $ <?php echo $prenda['precio']; ?></h4>
        <button type="submit" name="agregarAlCarrito" id="agregarAlCarrito">Agregar al carrito</button>
        <?php } else { ?>
        <div id="error-message" style="color: red;">No se encontró el producto.</div>
      <?php } ?>
      </form>
    </div>
  </section>
</body>
</html>