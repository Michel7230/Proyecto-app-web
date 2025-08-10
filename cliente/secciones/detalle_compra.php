<?php 
include("../../conexion2.php");

$cve_prenda = $_GET['cve_prenda'];
$producto = "SELECT c.cve_categoria,c.nombre, c.descripcion as descripcion_categoria, cp.cve_prenda, pr.nombre as prenda, pr.descripcion as descripcion, ROUND(pr.precio,2) AS precio, pr.imagen as imagen
FROM categoria as c
INNER JOIN categorias_prendas as cp on cp.cve_categoria = c.cve_categoria
INNER JOIN prenda as pr on cp.cve_prenda = pr.cve_prenda
WHERE pr.cve_prenda = '$cve_prenda'";
$producto = mysqli_query($conexion,$producto);
$prenda = mysqli_fetch_array($producto);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Compra</title>
  <link rel="stylesheet" href="../../ESTILOS/estilo.css?2">
  <link rel="stylesheet" href="../../ICONOS/css/fontello.css">
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
        <a href="../index.php" class="icon-inicio">INICIO</a>
        <a href="pedidos.php" class="icon-productos">PEDIDOS</a>
        <a href="#contactanos" class="icon-ubicacion">CONTACTANOS</a>
        <a href="tienda.php" class="icon-producto">TIENDA</a>
        <a href="CarroDeCompra.php" class="carrito">&#128722;</a>
        <a href="../cerrar_sesionCliente.php" class="icon-usuario">CERRSAR SESION</a>
      </nav>
    </div>
  </header>

  <section class="formulario">
    
    <form method="post" autocomplete="off">
      <h2>Formulario de Compra</h2>

      <img src="../../admin/secciones/<?php echo $prenda['imagen'];?>" alt="" style="height: 150px;">

      <div class="contenedor-inputs">
        <label for="nombre">Nombre: <?php echo $prenda['prenda'];?></label>
        <input type="text" id="nombre" name="nombre">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion">
        <label for="tarjeta">Número de Tarjeta:</label>
        <input type="text" id="tarjeta" name="tarjeta">
        <label for="fecha">Fecha de Vencimiento:</label>
        <input type="text" id="fecha" name="fecha" >
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv">
      </div>
      <br> <br>
      <input type="submit" value="Comprar">
    </form>
  </section>
</body>
</html>