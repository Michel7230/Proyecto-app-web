<?php 
include("conexion2.php");

$cve_prenda = $_GET['cve_prenda'];
$producto = "SELECT c.cve_categoria,c.nombre, c.descripcion as descripcion_categoria, pr.cve_prenda, pr.nombre as prenda, pr.descripcion as descripcion, ROUND(pr.precio,2) AS precio, pr.imagen as imagen
FROM categoria as c
INNER JOIN categorias_prendas as cp on cp.cve_categoria = c.cve_categoria
INNER JOIN prenda as pr on cp.cve_prenda = pr.cve_prenda
WHERE pr.cve_prenda = '$cve_prenda'";
$producto = mysqli_query($conexion,$producto);
$prenda = mysqli_fetch_array($producto);

if(isset($_GET['cve_prenda']) && is_numeric($_GET['cve_prenda'])) {
  $id_producto = $_GET['cve_producto'];
  
  if(!isset($_SESSION['clave'])) {
      $_SESSION['clave'] = array();
  }
  
  if(!in_array($id_producto, $_SESSION['clave'])) {
      $_SESSION['clave'][] = $id_producto;
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Producto</title>
  <link rel="stylesheet" href="ESTILOS\estilo.css?234">
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

  <section class="formulario_producto">

    <div class="contenedor_producto">
      <form action="">
        <img src="admin/secciones/<?php echo $prenda['imagen'];?>" alt="" style="height: 180px;">
        <label for="nombre">Nombre: <?php echo $prenda['prenda']; ?></label>
        <h4>Descripcion: <?php echo $prenda['descripcion']; ?></h4>
        <button><a href="carritoDeCompra.php?cve_prenda=<?php echo $prenda['cve_prenda']?>">Agregar al carrito</a></button>
      </form>
    </div>

    <button><a href="comprarProducto.php?cve_prenda=<?php echo $prenda['cve_prenda'];?>">Comprar ahorra</a></button>
    
  </section>

</body>
</html>