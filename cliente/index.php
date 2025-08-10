<?php 
include("../conexion2.php");
session_start();
$nombre = $_SESSION['nombre'];

$buscar_categorias = "SELECT cve_categoria,nombre,descripcion,IMAGEN as imagen FROM categoria";
$resultado_buscar_categorias = mysqli_query($conexion,$buscar_categorias);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONFECCIONES ESTELA</title>
    <link rel="stylesheet" href="../ESTILOS/estilo.css?2">
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
                <a href="secciones\CarroDeCompra.php" class="carrito">&#128722;</a>
                <a href="cerrar_sesionCliente.php" class="icon-usuario">CERRSAR SESION</a>
            </nav>
        </div>
    </header>
    <section class="saludo">
        <section class="bienvenido">
            <img src="../IMAGENES/persona.png" alt="">
            <h1>Bienvenido <br> <br> <?php echo $nombre;?> <br> a </h1>
            <h3>
                CONFECCIONES ESTELA
            </h3>
        </section>
        

    </section>

    <div class="categorias1">
        <section class="contenedor_categorias">
            <?php while($categoria = mysqli_fetch_array($resultado_buscar_categorias)){?>
                <article class="ca">
                    <a href="catalogo.php?cve_categoria=<?php echo $categoria['cve_categoria']; ?>"><img src="../admin/secciones/<?php echo $categoria['imagen']; ?>" alt=""></a>
                    <h3><?php echo $categoria['nombre']; ?></h3>
                </article>
            <?php }?>
        </section>        
    </div>

    <div id="contactanos">

        <div class="ficha_informacion">
            <h2>
                Confecciona tu prenda con nosotros
            </h2>
            <ul>
                <h3>
                    Contactanos 
                </h3>
                <li>en los Telefonos</li>
                <li>9932169262</li>
                <li>15065056</li>
                <li>06505065</li>
                <h3>
                    Llámanos. Con gusto te atenderemos y resolveremos todas tus dudas.
                </h3>
            </ul>
        </div>

        <div class="ubicacion">

            <div class="info_ubicacion">
                <h2>
                    Encuentranos en
                </h2>
                <h3>
                    Col. Casa blanca, Calle Rio Mezcalapa
                </h3>
                <h3>
                    Villahermosa, Tabasco
                </h3>
                <h3>
                    C.P. 86060
                </h3>
                <h3>
                    De lunes - viernes :  10:00 am a 5:00 pm
                </h3>
            </div>

            <div class="mapa">
                <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d8268.679068206444!2d-92.91680595793453!3d18.001034125768513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x85edd86a011c8a71%3A0xe72032b078e042ca!2sVillahermosa%2C%2086060%20Tab.!3m2!1d18.0027072!2d-92.91277079999999!5e0!3m2!1ses!2smx!4v1688567835687!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>

        <footer>
            <h2>
                Marca registrada
            </h2>
            <a href="" class="icon-whatsapp"></a>
            <nav class="menu">
                <a href="index.php" class="icon-inicio">INICIO</a>
                <a href="conocenos.php" class="icon-conocenos">CONOCENOS</a>
                <a href="pedidos.php" class="icon-productos">PEDIDOS</a>
                <a href="#contactanos">CONTACTANOS</a>
                <a href="tienda.php">TIENDA</a>
            </nav>

        </footer>

    </div>
    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
    <div class="elfsight-app-752ebcc9-602e-4bbb-ba77-ebabaa66f186" data-elfsight-app-lazy></div>
    
</body>
</html>