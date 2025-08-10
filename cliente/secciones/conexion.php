<?php
include("../../conexion2.php");

if(isset($_POST["send"])) {
    $tipo = '';
    if (isset($_POST['cve_citas'])) {
        $tipo = 'cve_citas';
    } elseif (isset($_POST['cve_pedidos'])) {
        $tipo = 'cve_pedidos';
    }

    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];
    $fecha = $_POST['seleccionar-fecha'];

    $directorio = 'admin/secciones/DIRECTORIO/pedidos/';
    $nombreArchivo = uniqid() . '_' . $_FILES['imagen']['name'];
    $rutaCompleta = $directorio . '/' . $nombreArchivo;

    $consulta = "INSERT INTO persona(nombre, paterno, materno) VALUES ('$nombre', '$paterno', '$materno')";
    $consulta = mysqli_query($conexion, $consulta);
    $cve_persona = mysqli_insert_id($conexion);

    $consulta2 = "INSERT INTO cliente(cve_persona, telefono, correo, direccion) VALUES ($cve_persona, '$telefono', '$correo', '$direccion')";
    $consulta2 = mysqli_query($conexion, $consulta2);
    $cve_cliente = mysqli_insert_id($conexion);

    $insertar_p = true; 
    $insertar_c = true; 

    if (move_uploaded_file($_FILES['imagen']['tmp_name'],$rutaCompleta)) {
        if ($tipo == 'cve_pedidos') {
            $insertar_pedidos = "INSERT INTO pedidos(cve_cliente, fecha_pedido, mensaje, imagen) VALUES ($cve_cliente, '$fecha', '$mensaje', '$rutaCompleta')";
            $insertar_p = mysqli_query($conexion, $insertar_pedidos);
        } elseif ($tipo == 'cve_citas') {
            $insertar_citas = "INSERT INTO citas(cve_cliente, fecha, mensaje, imagen) VALUES ($cve_cliente, '$fecha', '$mensaje','$rutaCompleta')";
            $insertar_c = mysqli_query($conexion, $insertar_citas);
        }
    }

    if ($insertar_p || $insertar_c) {
        echo "<script>alert('Registro exitoso.');</script>";
    } else {
        echo "<script>alert('Error al registrar.');</script>";
    }
}
?>