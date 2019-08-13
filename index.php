<!-- inicio -->
<?php require_once 'includes/header.php' ?>

	<!-- barra lateral -->
	<?php require_once 'includes/lateral.php' ?>

	<!-- contenido principal -->
	<div class="principal">
		<h1>Ultimas entradas</h1>
		<?php mostrarEntradas($conexion) ?>	
		<div id="ver-todas">
			<a href="">Ver todas las entradas</a>
		</div>

	</div>3884558619
		
<!-- footer -->
<?php require_once 'includes/footer.php' ?>
