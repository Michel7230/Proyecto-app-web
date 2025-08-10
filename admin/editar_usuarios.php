<?php 
include("../conexion2.php");

if(isset($_POST["crear"])) {
  $tipo = '';
  if (isset($_POST['cve_administrador'])) {
      $tipo = 'cve_administrador';
  } elseif (isset($_POST['cve_cliente'])) {
      $tipo = 'cve_cliente';
  }

  $nombre = $_POST['nombre'];
  $paterno = $_POST['paterno'];
  $materno = $_POST['materno'];
  $edad = $_POST['edad'];
  $clave = $_POST['clave'];
  $password = $_POST['password'];


  if ($tipo == 'cve_administrador') {
    $consulta = "INSERT INTO persona(nombre, paterno, materno,edad) VALUES ('$nombre', '$paterno', '$materno','$edad')";
    $consulta = mysqli_query($conexion, $consulta);
    $cve_persona = mysqli_insert_id($conexion);

    $sql = "INSERT INTO administrador(cve_persona,clave,password) VALUES ($cve_persona,'$clave','$password')";
    $insertar_p = mysqli_query($conexion, $sql);
  } elseif ($tipo == 'cve_cliente') {
    $cve_cliente = $_POST['cve_cliente'];

    $buscar_cliente = "SELECT * FROM cliente WHERE cve_cliente='$cve_cliente'";
    $resultado_cliente = mysqli_query($conexion,$buscar_cliente);
    if (mysqli_num_rows($resultado_cliente)>0) {
      
      $consulta = "INSERT INTO persona(edad) VALUES ('$edad')";
      $consulta = mysqli_query($conexion, $consulta);
      $cve_persona = mysqli_insert_id($conexion);

      $actualizar = "UPDATE cliente SET clave = '$clave', password='$password' WHERE cve_cliente='$cve_persona'";
      $actualizar_datos = mysqli_query($conexion,$actualizar);
    } else {
      $consulta = "INSERT INTO persona(nombre, paterno, materno,edad) VALUES ('$nombre', '$paterno', '$materno','$edad')";
      $consulta = mysqli_query($conexion, $consulta);
      $cve_persona = mysqli_insert_id($conexion);

      $consulta2 = "INSERT INTO cliente(cve_persona, clave, password) VALUES ($cve_persona, '$clave','$password')";
      $consulta2 = mysqli_query($conexion, $consulta2);
    }
    
  }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuarios</title>
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

  <section class="formulario_creacion">
    <a href="inicio.php">
      <h2>&#9194;</h2>
    </a>
    <form action="" method="post">
      <h3>Crea un nuevo usuario</h3>
      <div class="crear_usuarios">
        <input type="checkbox" name="cve_cliente" id="">Nuevo cliente
        <input type="checkbox" name="cve_administrador" id="">Nuevo empleado
        <input type="text" name="nombre" id="" placeholder="Nombre">
        <input type="text" name="paterno" id="" placeholder="Apellido paterno">
        <input type="text" name="materno" id="" placeholder="Apellido materno">
        <input type="text" name="clave" id="" placeholder="Clave de usuario">
        <input type="password" name="password" placeholder="Contraseña">
        <input type="text" name="edad" placeholder="Edad">
        
      </div> 
      <input type="submit" name="crear" class="btn-submit" value="Crear usuario">
    </form>
  </section>
    
</body>
</html>