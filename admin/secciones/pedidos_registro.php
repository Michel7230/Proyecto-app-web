<?php 
include("../../conexion2.php");

$buscar_pedido = ("SELECT cve_pedidos,CONCAT(pe.nombre,' ',pe.paterno,' ',pe.materno) as nombre_cliente , DATE_FORMAT(fecha_pedido, '%d-%m-%Y %H:%i %p') as fecha, p.mensaje as mensaje, p.image as imagen FROM persona as pe 
INNER JOIN cliente as c on pe.cve_persona = c.cve_persona
INNER JOIN pedidos as p on c.cve_cliente = p.cve_cliente");
$resultado_buscar_pedido = mysqli_query($conexion,$buscar_pedido);

if (isset($_POST["send_nuevo_pedido"])) {

    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];
    $fecha = $_POST['seleccionar-fecha'];
    $imagen = $_POST['imagen'];

    $directorio = 'DIRECTORIO/pedidos/';
    $nombreArchivo = uniqid().'_'. $_FILES['imagen']['name'];
    $rutaCompleta = $directorio.$nombreArchivo;

    

    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {

        move_uploaded_file($_FILES['imagen']['tmp_name'],$rutaCompleta);
        
        $sql1 = "INSERT INTO persona(nombre,paterno,materno) VALUES('$nombre','$paterno','$materno')";
        $insertar_sql1 = mysqli_query($conexion, $sql1);
        $cve_persona = mysqli_insert_id($conexion);
                
        $sql2 = "INSERT INTO cliente(cve_persona,telefono,correo,direccion) VALUES($cve_persona,'$telefono','$correo','$direccion')";
        $insertar_sql2 = mysqli_query($conexion, $sql2);
        $cve_cliente = mysqli_insert_id($conexion);

        $sql3 = "INSERT INTO pedidos(cve_cliente,fecha_pedido,mensaje,image) VALUES ($cve_cliente,'$fecha','$mensaje', '$rutaCompleta')";
        $insertar_sql3 = mysqli_query($conexion, $sql3);
           
    }
}


if(isset($_REQUEST['cve_pedidos'])){
    $cve_pedidos = $_REQUEST['cve_pedidos'];
    $eliminar_pedido = "DELETE FROM pedidos WHERE cve_pedidos = $cve_pedidos";
    mysqli_query($conexion, $eliminar_pedido);
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="../../ESTILOS/estilo.css?2">
    <link rel="stylesheet" href="../../ICONOS/css/fontello.css">
    <link rel="stylesheet" href="DIRECTORIO/">
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

    <section class="formulario">
        <form method="POST" enctype="multipart/form-data" autocomplete="off">
            <h3> Agraga un nuevo pedido</h3> 

            <div class="contenedor_inputs">
                <input type="datetime-local" name="seleccionar-fecha" id="seleccionar-fecha">
                <div class="grupo_inputs">
                    <input type="text" name="nombre" placeholder="Nombre">
                    <input type="text" name="paterno" placeholder="Apellido Paterno">
                    <input type="text" name="materno" placeholder="Apellido Materno">
                    <input type="text" name="direccion" id="" placeholder="direccion">
                    <input type="tel" name="telefono" placeholder="Telefono">
                    <input type="email" name="correo" placeholder="Correo">
                </div>
                
            </div> <br>

            <textarea name="mensaje" cols="30" rows="10" placeholder="Comentario"></textarea> 
            <input type="file" name="imagen" id=""> <br>
            <input name="send_nuevo_pedido" type="submit" class="btn-submit" value="Enviar">
        </form>
    </section>

    <div class="contenedor_pedidos">
        <h1>Pedidos de Clientes</h1>
        <?php
        while( $fila = mysqli_fetch_array($resultado_buscar_pedido)) {
            $carpetaBase = 'DIRECTORIO/';
            $nuevaRuta = str_replace($carpetaBase, '', $fila['imagen']);
        ?>
            <div class="card_pedido">
                <h2><?php echo $fila['nombre_cliente']?></h2>
                <p>Fecha del Pedido: <br>
                    <?php echo $fila['fecha']?>
                </p>
                <p>Comentario: <br> <?php echo $fila['mensaje']?> .</p>
                <p>Propuesta del cliente: <br> <img src="<?php echo $nuevaRuta; ?>" alt="" style="height: 120px;"> </p>
                <a href="pedidos_registro.php?cve_pedidos=<?php echo $fila['cve_pedidos'] ?>">Eliminar</a>
            </div>
        <?php }?>


    </div>

</body>
</html>