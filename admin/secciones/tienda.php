<?php 
session_start();
include ("../../conexion2.php");

$buscar_producto = "SELECT ca.nombre as categoria, ca.descripcion as descripcion, pr.cve_prenda ,pr.nombre as prenda, ROUND(pr.precio,2) as precio, pr.descripcion as descripcion,
pr.imagen as imagen FROM categoria as ca 
INNER JOIN categorias_prendas as c_p on c_p.cve_categoria = ca.cve_categoria
INNER JOIN prenda as pr on pr.cve_prenda = c_p.cve_prenda";
$resultado_buscar_producto = mysqli_query($conexion,$buscar_producto);

$buscar_categoria = "SELECT cve_categoria,nombre FROM categoria";
$r_buscar_categoria = mysqli_query($conexion,$buscar_categoria);


if (isset($_POST["agregar"])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    $directorioCa = 'DIRECTORIO/categorias/';
    $nombreArchivo = uniqid().'_'.$_FILES['imagen']['name'];
    $rutacompleta = $directorioCa.$nombreArchivo;

    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
        move_uploaded_file($_FILES['imagen']['tmp_name'],$rutacompleta);

        $agregar = "INSERT INTO categoria(nombre, descripcion, imagen) VALUES('$nombre','$descripcion','$rutacompleta')";
        $r_agregar = mysqli_query($conexion,$agregar);
        $cve_categoria = mysqli_insert_id($conexion);
    }

    header('Location: tienda.php');
}

if (isset($_POST["agregar_producto"])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $cve_categoria = $_POST['cve_categoria'];

    $directorio = 'DIRECTORIO/productos/';
    $nombreArchivo = uniqid().'_'. $_FILES['imagen']['name'];
    $rutaCompleta = $directorio.$nombreArchivo;

    if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
        move_uploaded_file($_FILES['imagen']['tmp_name'],$rutaCompleta);
        $agregar3 = "INSERT INTO prenda(nombre, descripcion, precio, imagen) VALUES('$nombre','$descripcion','$precio','$rutaCompleta')";
        $r_agregar3 = mysqli_query($conexion, $agregar3);
        $cve_prenda = mysqli_insert_id($conexion);

        $agregar_relacion = "INSERT INTO categorias_prendas(cve_categoria,cve_prenda) VALUES('$cve_categoria','$cve_prenda')";
        $r_agregar_relacion = mysqli_query($conexion, $agregar_relacion);
    }
    header('Location: tienda.php');
}

if (isset($_REQUEST['eliminar'])) {
    $eliminar = $_REQUEST['eliminar'];

    $eliminar2 = "DELETE FROM categorias_prendas WHERE cve_prenda = $eliminar";
    mysqli_query($conexion,$eliminar2);

    $eliminar_producto = "DELETE FROM prenda WHERE cve_prenda = $eliminar";
    mysqli_query($conexion, $eliminar_producto);

    header('Location: tienda.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de productos</title>
    <link rel="stylesheet" href="../../ESTILOS/estilo.css">
    <link rel="stylesheet" href="estilos2.css">
    <link rel="stylesheet" href="../../ICONOS/css/fontello.css">
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

    <div class="crear_categoria">
        <div class="agregar_categoria">
            <h3>Agrega una categoria</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="a_categoria">
                    <input type="text" name="nombre" placeholder="Categoria">
                    <input type="file" name="imagen" >
                    <textarea name="descripcion" id="" cols="30" rows="10" placeholder="Descripcion"></textarea>
                    <input type="submit" name="agregar" value="Agregar categoria">
                </div>
                
            </form>
        </div>
    </div>
    <div class="crear_prendas">
        <div class="agregar_prenda">
            <h3>Agregar nuevo producto</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="contenedor-inputs">
                    <input type="text" name="nombre" placeholder="Nombre del producto">
                    <select name="cve_categoria">
                        <?php while($listado = mysqli_fetch_array($r_buscar_categoria)) {?>
                            <option value="<?php echo $listado['cve_categoria']; ?>"><?php echo $listado['nombre']; ?></option>
                        <?php }?>
                    </select>
                    <input type="number" name="precio" placeholder="Precio">
                    <input type="file" name="imagen" >
                    <textarea name="descripcion" cols="30" rows="10" placeholder="Descripcion"></textarea>
                    <input type="submit" name="agregar_producto" value="Agregar producto">
                </div>
                
            </form>
        </div>
    </div>


    <div>

        <table class="tabla_prendas">
            <thead>
                <tr>
                    <th scope="col">Categoria</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <?php while($lista = mysqli_fetch_array($resultado_buscar_producto)) {?>
                <tr class="">
                    <td><?php echo $lista['categoria']; ?></td>
                    <td><?php echo $lista['prenda']; ?></td>
                    <td><img src="<?php echo $lista['imagen']; ?>" alt="" style="height: 150px;"></td>
                    <td><?php echo $lista['descripcion']; ?></td>
                    <td>$<?php echo $lista['precio']; ?></td>
                    <td><a href="tienda.php?eliminar=<?php echo $lista['cve_prenda'];?>">Eliminar</a></td>
                </tr>
            <?php }?>
        </table>
        
    </div>
</body>
</html>