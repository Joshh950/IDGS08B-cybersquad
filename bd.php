<?php
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");
if (mysqli_connect_errno()) {
	$mensaje_error = "Error al conectar a la base de datos: " . mysqli_connect_error();
	// Puedes mostrar el mensaje de error o redirigir a una página de error
	header("Location: pagPrincipal.php");
	exit();
  }
?>