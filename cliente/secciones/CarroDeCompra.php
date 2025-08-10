<?php 
include("../../conexion2.php");
session_start();

$nombre = $_SESSION['nombre'];
$productos_carrito = [];
$total = 0;
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {

    foreach ($_SESSION['carrito'] as $cve_prenda) {
        $query = "SELECT nombre, imagen,precio FROM prenda WHERE cve_prenda = '$cve_prenda'";
        $result = mysqli_query($conexion, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $producto = mysqli_fetch_assoc($result);
            $productos_carrito[] = array(
                'cve_prenda' => $cve_prenda,
                'nombre' => $producto['nombre'],
                'imagen' => $producto['imagen'],
                'precio' => $producto['precio'],
            );

            $total += $producto['precio'];
        }
    }
} else {
    $productos_carrito = false;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['eliminarTodo'])) {
        $_SESSION['carrito'] = [];
        header('Location: CarroDeCompra.php');
    }

    if (isset($_POST['eliminar']) || isset($_REQUEST['eliminar'])) {
        if (($key = array_search($_POST['cve_prenda'], $_SESSION['carrito'])) !== false) {
            unset($_SESSION['carrito'][$key]);
        }
        header('Location: CarroDeCompra.php');
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compra</title>
    <link rel="stylesheet" href="../../ESTILOS/estilo.css?23456">
    <link rel="stylesheet" href="../../ICONOS/css/fontello.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600display=swap" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=AQUI VA EL CLIENT ID DE PAYPAL&currency=MXN" data-sdk-integration-source="integrationbuilder_sc"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        paypal.Buttons({
        style:{
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, actions){
            var total = document.getElementById('total').innerText;
            var productos = [];

            $("input[name='cantidad']").each(function(){
                var cantidad = $(this).val();
                var cve_prenda = $(this).closest("tr").find("input[name='cve_prenda']").val();

                productos.push({
                    cve_prenda: cve_prenda,
                    cantidad: cantidad
                });
            });
            return actions.order.create({
            purchase_units: [{
                amount: {
                    value: total
                }
                }],
                items: productos
            });
        },
        onApprove: function(data, actions){
            var total = document.getElementById('total').innerText;
            var productos = [];

            $("input[name='cantidad']").each(function(){
                var cantidad = $(this).val();
                var cve_prenda = $(this).closest("tr").find("input[name='cve_prenda']").val();

                productos.push({
                    cve_prenda: cve_prenda,
                    cantidad: cantidad
                });
            });
            actions.order.capture().then(function(detalles){
                $.ajax({
                    type: "POST",
                    url: "enviarCompra.php",
                    data: {
                        total: total,
                        productos: JSON.stringify(productos)
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.href="CarroDeCompra.php";
                    }
                })
            });

        }, 
        onCancel: function(data){
            alert("Pago cancelado");
            console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
    
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
    <div class="contenedor_carrito">
        <div class="productos">
            <h3>Hola <?php echo $nombre;?>, ¿estos son los productos que quieres comprar?</h3>
            <form action="" method="post">
                <button type="submit" name="eliminarTodo" class="eliminarTodo">Vaciar carrito</button>
            </form>
            <table class="tabla_carrito">
                <thead>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th></th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                    <?php if (!empty($productos_carrito)) {?>
                <tbody>
                    <?php foreach ($productos_carrito as $producto) { ?>
                        <tr>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td><img src="../../admin/secciones/<?php echo $producto['imagen']; ?>" alt="" style="height: 80px;"></td>
                            <td class="precio" data-precio="<?php echo $producto['precio']; ?>">$<?php echo $producto['precio']; ?></td>
                            <td>
                                <input class="cantidad" type="number" id="cantidad" name="cantidad" value="1" min="0" max="1000">
                            </td>

                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="cve_prenda" value="<?php echo $producto['cve_prenda']; ?>">
                                    <button type="submit" name="eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div class="total-compra">
            <div>
                <h2 name="">Total: $<span id="total"><?php echo $total?></h2>
            </div>
            <form action="" method="post">
                <div id="paypal-button-container" name="comprar"></div>
            </form>
            <?php }else{ ?>
                <h1>El carrito está vacío.</h1>
            <?php }?>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            $("input[name='cantidad']").change(function(){
                var total = 0;

                $("input[name='cantidad']").each(function(){
                    var cantidad = $(this).val();
                    var precio = $(this).closest("tr").find(".precio").data('precio');

                    total += cantidad * precio;
                });

                $("#total").text(total);
            });
        });
    </script>
    
</body>
</html>