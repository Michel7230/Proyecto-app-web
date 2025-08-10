<?php 
session_start();
include("../conexion2.php");
$nombre = $_SESSION['nombre'];


$buscar_administrador = "SELECT CONCAT(pe.nombre,' ',pe.paterno,' ',pe.materno)as nombre, edad, cve_administrador,ad.clave, ad.password FROM persona as pe
INNER JOIN administrador as ad on pe.cve_persona = ad.cve_persona";
$resultado_administrador = mysqli_query($conexion,$buscar_administrador);

$buscar_cliente = "SELECT CONCAT(pe.nombre,' ',pe.paterno,' ',pe.materno)as nombre, edad, cve_cliente, c.clave, c.password FROM persona as pe
INNER JOIN cliente as c on pe.cve_persona = c.cve_persona
WHERE clave IS NOT NULL AND password IS NOT NULL";
$resultado_cliente = mysqli_query($conexion,$buscar_cliente);

if (isset($_REQUEST['eliminar'])) {
  $eliminar = $_REQUEST['eliminar'];

  $sql = "DELETE FROM administrador WHERE cve_administrador=$eliminar";
  mysqli_query($conexion,$sql);

  $sql2 = "DELETE FROM persona WHERE cve_persona=$eliminar";
  mysqli_query($conexion,$sql2);
}

if (isset($_REQUEST['eliminar_cliente'])) {
  
  $eliminar_cliente = $_REQUEST['eliminar_cliente'];

  $sql3 = "DELETE FROM cliente WHERE cve_cliente=$eliminar_cliente";
  mysqli_query($conexion,$sql3);

  $sql4 = "DELETE FROM persona WHERE cve_persona=$eliminar_cliente";
  mysqli_query($conexion,$sql4);
}

?>

<!doctype html>
<html lang="es">

<head>
  <title>Administracion de la sastreria</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="../ESTILOS/estilo.css">
  <link rel="stylesheet" href="secciones/estilos2.css">
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
        <a href="inicio.php" class="icon-inicio">INICIO</a>
        <a href="secciones/pedidos_registro.php" class="icon-productos">PEDIDOS</a>
        <a href="secciones/citas.php" class="icon-ubicacion">CITAS</a>
        <a href="secciones/tienda.php" class="icon-producto">TIENDA</a>
        <a href="ventas.php">VENTAS</a>
        <a href="secciones/emails.php">&#9993; BUZON DE EMAILS</a>
        <a href="cerrar_secion.php">Cerrar sesion</a>
      </nav>
    </div>
  </header>

  <div class="tabla_usuarios">
    <section class="mostrar_usuario">
      <h2>Bienvenido administrador</h2>
      <h3><?php echo $nombre; ?></h3>
    </section> <br>
    
    <a href="editar_usuarios.php">Crear nuevo usuario</a>
    <h3>Empleados existentes</h3>

    <div class="tabla_empleados">
      
      <table>
        
        <thead>
          
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col"> Clave de usuario</th>
            <th scope="col">Contraseña</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <?php while($admin = mysqli_fetch_array($resultado_administrador)){?>
          <tr>
            <td><?php echo $admin['nombre']; ?></td>
            <td><?php echo $admin['clave']; ?></td>
            <td><?php echo $admin['password']; ?></td>
            <td><a href="detalle_empleado.php?cve_administrador=<?php echo $admin['cve_administrador']; ?>">Informacion</a></td>
            <td><a href="inicio.php?eliminar=<?php echo $admin['cve_administrador']; ?>">Eliminar empleado</a></td>
          </tr>
        <?php }?>
      </table>
    </div>
    <h3>Clientes existentes</h3>
    <div class="tabla_clientes">
      
      <table>
        
        <thead>
          
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col"> Clave de usuario</th>
            <th scope="col">Contraseña</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>

        <?php while($cli = mysqli_fetch_array($resultado_cliente)){?>
          <tr>
            <td><?php echo $cli['nombre'] ;?></td>
            <td><?php echo $cli['clave'] ;?></td>
            <td><?php echo $cli['password'] ;?></td>
            <td><a href="detalle_cliente.php?cve_cliente=<?php echo $cli['cve_cliente']; ?>">Informacion</a></td>
            <td><a href="inicio.php?eliminar_cliente=<?php echo $cli['cve_cliente']; ?>">Eliminar</a></td>
          </tr>
        <?php }?>
      </table>
    </div>

  </div>


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>