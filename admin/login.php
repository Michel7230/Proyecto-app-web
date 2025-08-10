<?php 
  include("../conexion2.php");
?>
<!doctype html>
<html lang="es">

<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../ESTILOS/estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600display=swap" rel="stylesheet">
</head>

<body>

  <div class="card_login">

    <form action="validacion.php" method="post">
      <h1>Bienvenido al sistema</h1>
      <input type="text" name="clave" id="" placeholder="&#128100 Clave de usuario">
      <input type="password" name="password" placeholder="&#128272 Contraseña">
      <input type="submit" value="Conectarse">
      
    </form>

  </div>
  
  

</body>

</html>