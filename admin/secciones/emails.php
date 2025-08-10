<?php
include("../../conexion2.php");
use \Mailjet\Resources;

$APIkey = 'b1e812d4c17cc082ffd4ffec932242fc';
$claveSecreta = 'f8023c5dd7508273a8aefdfdc5cedae6';

require 'vendor/autoload.php';
$mj = new \Mailjet\Client($APIkey,$claveSecreta,true,['version' => 'v3.1']);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $remite = $_POST['remite'];
    $nombreRemitente = $_POST['nombreRemitente'];
    $destinatario = $_POST['destinatario'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0){
        $archivo = $_FILES['archivo']['tmp_name'];
        $nombre_archivo = $_FILES['archivo']['name'];
        $contenido_archivo = file_get_contents($archivo);
        $base64 = base64_encode($contenido_archivo);
    } else {
        die('Error al subir el archivo');
    }

    $SENDER_EMAIL=$remite;
    $RECIPIENT_EMAIL=$destinatario;
    

    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "$SENDER_EMAIL",
                    'Name' => "$nombreRemitente"
                ],
                'To' => [
                    [
                        'Email' => "$RECIPIENT_EMAIL",
                        'Name' => "Tu"
                    ]
                ],
                'Subject' => "$asunto",
                'TextPart' => "$mensaje",
                'Attachments' => [
                    [
                        'ContentType' => "application/pdf",
                        'Filename' => "$archivo",
                        'Base64Content' => "$base64"
                    ]
                ]
            ]
        ]
    ];

    $response = $mj->post(Resources::$Email, ['body' => $body]);
    if ($response->success()) {
        echo '<script>alert("Correo electrónico enviado correctamente!")</script>';
    }
}

$buscar_cliente = "SELECT CONCAT(pe.nombre,' ',pe.paterno,' ',pe.materno)as nombre, cve_cliente,cl.clave, cl.correo as correo FROM persona as pe
INNER JOIN cliente as cl on pe.cve_persona = cl.cve_persona";
$resultado_cliente = mysqli_query($conexion,$buscar_cliente);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buzon</title>
    <link rel="stylesheet" href="style.css?2">
    <link rel="stylesheet" href="../../ESTILOS/estilo.css">
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
    <div id="contenedorEmail">
        <div class="email">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="">De: </label>
                <input type="text" name="nombreRemitente" id="nombreRemitente">
                <label>Remitente:</label>
                <input type="email" name="remite" id="remite"> 
                <label for="">Destinatario</label>
                <input type="email" name="destinatario" id="destinatario"> <br>
                <label>Asunto:</label>
                <input type="text" name="asunto" id="asunto"> <br>
                <label>Mensaje:</label> <br>
                <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea> <br>
                <label for="">Adjutar ticket de compra</label>
                <input type="file" name="archivo" id="archivo">
                <input type="submit" id="enviar" value="Enviar">
            </form>
        </div>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre del cliente</th>
                    <th>Correo electronico</th>
                </tr>
            </thead>
            <tbody>
                <?php while($cliente = mysqli_fetch_array($resultado_cliente)){?>
                    <tr>
                        <td><?php echo $cliente['nombre']; ?></td>
                        <td><?php echo $cliente['correo']; ?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</body>
</html>