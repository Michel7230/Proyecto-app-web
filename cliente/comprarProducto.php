<?php
include("../conexion2.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cve_prenda'])){
  $cve_prenda = $_GET['cve_prenda'];
  $producto = "SELECT c.cve_categoria,c.nombre, c.descripcion as descripcion_categoria, pr.cve_prenda, pr.nombre as prenda, pr.descripcion as descripcion, ROUND(pr.precio,2) AS precio, pr.imagen as imagen
  FROM categoria as c
  INNER JOIN categorias_prendas as cp on c.cve_categoria = cp.cve_categoria
  INNER JOIN prenda as pr on cp.cve_prenda = pr.cve_prenda
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Compra</title>
    <link rel="stylesheet" href="../ESTILOS/estilo.css?234">
  <link rel="stylesheet" href="../ICONOS/css/fontello.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600display=swap" rel="stylesheet">
  <script src="https://www.paypal.com/sdk/js?client-id=AQUI VA EL CLIENT-ID DE PAYPAL&currency=MXN" data-sdk-integration-source="integrationbuilder_sc"></script>
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
            <a href="secciones/pedidos.php" class="icon-productos">PEDIDOS</a>
            <a href="#contactanos" class="icon-ubicacion">CONTACTANOS</a>
            <a href="secciones/tienda.php" class="icon-producto">TIENDA</a>
            <a href="secciones/CarroDeCompra.php" class="carrito">&#128722;</a>
            <a href="cerrar_sesionCliente.php" class="icon-usuario">INICIAR SECION</a>
        </nav>
        </div>
    </header>

  <section class="formulario_producto">

    <div class="contenedor_producto">
      <form action="">
        <img src="../admin/secciones/<?php echo $prenda['imagen'];?>" alt="" style="height: 180px;">
        <label for="nombre">Nombre: <?php echo $prenda['prenda']; ?></label>
        <input type="hidden" name="cve_prenda" value="<?php echo $prenda['cve_prenda']; ?>">
        <input type="hidden" name="precio" value="<?php echo $prenda['precio']; ?>">
        <h4>Descripcion: <?php echo $prenda['descripcion']; ?></h4>
        <button type="submit" name="agregarAlCarrito" id="agregarAlCarrito">Agregar al carrito</button>
      </form>
    </div>
    
    <form method="post" autocomplete="off" class="formularioDeCompra">
      <h2>Formulario de Compra</h2>
      <div class="contenedorMasInputs">
        <label for="">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <label for="">Apellido paterno</label>
        <input type="text" name="apellido_paterno" id="apellido_paterno">
        <label for="">Apellido materno: </label>
        <input type="text" name="apellido_materno" id="apellido_materno">
        <label for="">Correo electronico</label>
        <input type="email" name="correo" id="correo">
        <label for="">Telefono</label>
        <input type="tel" name="telefono" id="telefono">
        <label for="">Direccion</label>
        <input type="text" name="direccion" id="direccion">
      </div>
      <br>
      <div id="paypal-button-container"></div>
    </form>
  </section>

    <script>
        paypal.Buttons({
        style:{
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, actions){
            return actions.order.create({
            purchase_units: [{
                amount: {
                    value: <?php echo $prenda['precio']; ?>
                }
                }]
            });
        },
        onApprove: function(data, actions){
            actions.order.capture().then(function(detalles){
            window.location.href="comprarProducto.php"

            });

        }, 
        onCancel: function(data){
            alert("Pago cancelado");
            console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
    
</body>
</html>