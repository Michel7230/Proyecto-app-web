<?php 

$host = "localhost";
$bd_nombre = "sastreria";
$user = "root";
$password = "";
$puerto = 3308;

$conexion = mysqli_connect($host, $user, $password, $bd_nombre, $puerto);

if (!$conexion) {
    echo ("Error de conexión: " . mysqli_connect_error());
}


?>