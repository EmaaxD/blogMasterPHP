<!-- inicio -->
<?php require_once 'includes/header.php' ?>

	<!-- barra lateral -->
	<?php require_once 'includes/lateral.php' ?>

	<!-- contenido principal -->
	<div class="principal">
		<h1>Todas las entradas</h1>
		<?php mostrarEntradas($conexion,1) ?>	
		<!-- <div id="ver-todas">
			<a href="listarEntradas.php">Ver todas las entradas</a>
		</div> -->

	</div>
		
<!-- footer -->
<?php require_once 'includes/footer.php' ?>
