<?php 
include ('../conexion2.php');
session_start();

$_SESSION['clave']=$_POST['clave'];
$_SESSION['password']=$_POST['password'];

$consulta_usuario = "SELECT ad.clave,ad.password, CONCAT(p.nombre,' ',p.paterno,' ',p.materno) as nombre FROM administrador as ad 
INNER JOIN persona AS p ON p.cve_persona=ad.cve_persona
WHERE clave='$_SESSION[clave]' and password='$_SESSION[password]'";
$usuario=mysqli_query($conexion,$consulta_usuario);
$filas=mysqli_num_rows($usuario);

if ($filas>0) {
    $buscar=mysqli_fetch_assoc($usuario);
    $_SESSION['clave'] = $buscar['clave'];
    $_SESSION['nombre']=$buscar['nombre'];
    header("Location:inicio.php");
} else {
    mysqli_close($conexion);
    echo "<script>alert('Usuario no valido');</script>";
    echo "<script>window.location='login.php';</script>";
    session_destroy();
}

mysqli_free_result($usuario);


?>