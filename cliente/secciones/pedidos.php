<?php 
include("../../conexion2.php");
 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=}, initial-scale=1.0">
  <title>CONFECCIONES ESTELA</title>
  <link rel="stylesheet" href="../../ESTILOS/estilo.css?23">
  <link rel="stylesheet" href="../../ICONOS/css/fontello.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    
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
            <a href="../index.php#contactanos" class="icon-ubicacion">CONTACTANOS</a>
            <a href="tienda.php" class="icon-producto">TIENDA</a>
            <a href="CarroDeCompra.php" class="carrito">&#128722;</a>
            <a href="../cerrar_sesionCliente.php" class="icon-usuario">CERRSAR SESION</a>
          </nav>
      </div>
  </header>

  <section class="formulario">
    <form method="post" enctype="multipart/form-data" autocomplete="off">
      <h3> Has tus pedidos o agenda una cita con nosotros</h3>
      <input type="checkbox" name="cve_citas" id="">Cita
      <input type="checkbox" name="cve_pedidos" id="">Pedido <br>
      <input type="datetime-local" name="seleccionar-fecha" id="seleccionar-fecha">
      <div class="contenedor-inputs">
        <div class="grupo_inputs">
          <input type="text" name="nombre" placeholder="Nombre">
          <input type="text" name="paterno" placeholder="Apellido Paterno">
          <input type="text" name="materno" placeholder="Apellido Materno">
          <input type="text" name="direccion" id="" placeholder="Direccion">
          <input type="tel" name="telefono" placeholder="Telefono">
          <input type="email" name="correo" placeholder="Correo">
        </div> <br>
        <div class="grupo_2">
          <textarea name="mensaje" cols="30" rows="10" placeholder="Comentario"></textarea> <br>
          
        </div>
      </div>
      <input type="file" name="imagen" id=""> 
      <input name="send" type="submit" class="btn-submit" value="Enviar">
    </form>
  </section>

  <?php 
  include("conexion.php");
  ?>
    
    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<div class="elfsight-app-752ebcc9-602e-4bbb-ba77-ebabaa66f186" data-elfsight-app-lazy></div>
</body>
</html>