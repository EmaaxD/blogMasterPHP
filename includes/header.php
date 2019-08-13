<?php 
if (!isset($_SESSION)) {
	session_start();
}
require_once 'includes/conexion.php';
require_once 'includes/funciones.php';
$conexion = conexion();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>blog master php</title>
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	
	<!-- cabezera -->
	<header id="cabecera">
		<!-- logo -->
		<div id="logo">
			<a href="index.php">
				Blog de Videosjuegos
			</a>
		</div>

		<!-- menu -->
		<nav id="menu">
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<?php mostrarCategorias($conexion,'lista') ?>
				<li><a href="index.php">Sobre mi</a></li>
				<li><a href="index.php">Contacto</a></li>
			</ul>
		</nav>

		<div class="clearfix"></div>

	</header>

	<div id="contenedor">