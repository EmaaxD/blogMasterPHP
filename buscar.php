<?php 
	require_once 'includes/redireccion.php';
	require_once 'includes/header.php';
	require_once 'includes/lateral.php';

	if (!isset($_POST['busqueda'])) {
		header("Location: index.php");
	}
?>

<div class="principal">
	<?php 
		if (!empty($_POST['busqueda'])) {
			echo '<h1>Resultado de la busqueda: '.ucfirst($_POST['busqueda']).'</h1>';
			$busqueda = mostrarEntradas($conexion,1,null,$_POST['busqueda']);
		}else{
			echo '<h3 align="center">Escriba algo para obtener resultados</h3>';
		}
	?>
</div>

<?php require_once 'includes/footer.php' ?>