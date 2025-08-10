<?php 
include ("conexion2.php");
session_start();

$_SESSION['clave']=$_POST['clave'];
$_SESSION['password']=$_POST['password'];
$_SESSION['nombre']=$_POST['nombre'];

$consulta_cliente = "SELECT cl.cve_cliente,cl.clave,cl.password,CONCAT(p.nombre,' ',p.paterno,' ',p.materno) as nombre FROM cliente as cl 
INNER JOIN persona AS p ON p.cve_persona=cl.cve_persona
WHERE clave='$_SESSION[clave]' and password='$_SESSION[password]'";
$usuario_cliente = mysqli_query($conexion,$consulta_cliente);

$consulta_usuario = "SELECT ad.clave,ad.password, CONCAT(p.nombre,' ',p.paterno,' ',p.materno) as nombre FROM administrador as ad 
INNER JOIN persona AS p ON p.cve_persona=ad.cve_persona
WHERE clave='$_SESSION[clave]' and password='$_SESSION[password]'";
$usuario_administrador = mysqli_query($conexion,$consulta_usuario);


if (mysqli_num_rows($usuario_cliente)>0) {
    $buscar=mysqli_fetch_assoc($usuario_cliente);
    $_SESSION['cve_cliente']=$buscar['cve_cliente'];
    $_SESSION['clave'] = $buscar['clave'];
    $_SESSION['nombre']=$buscar['nombre'];
    
    header("Location:cliente/index.php");
    exit();
} elseif (mysqli_num_rows($usuario_administrador)>0) {
    $buscar=mysqli_fetch_assoc($usuario_administrador);
    $_SESSION['clave'] = $buscar['clave'];
    $_SESSION['nombre']=$buscar['nombre'];
    header("Location:admin/inicio.php");
    exit();
} else {
    mysqli_close($conexion);
    echo "<script>alert('Usuario no valido');</script>";
    echo "<script>window.location='login.php';</script>";
    session_destroy();
}

mysqli_free_result($usuario);


?>