<?php require_once 'includes/redireccion.php' ?>
<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/lateral.php' ?>

<!-- mostramos el formulario para crear nueva categoria -->
<?php if (isset($_GET['nueva'])): ?>
	<div class="principal">
		<h1>Crea tu propia categoria gatioli</h1>

		<form action="modelo/modelo_categoria.php" method="post">
			<label for="nombre">Nombre de la categoria</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre Categoria">

			<input type="hidden" name="tipo" value="nuevo">
			<input type="submit" value="Guardar">

			<?= isset($_SESSION['errores']['empty']) ? mostrarError($_SESSION['errores'],'empty',1): ''; ?>
			<?= isset($_SESSION['errores']['existeRegis']) ? mostrarError($_SESSION['errores'],'existeRegis',1): ''; ?>
			<?= isset($_SESSION['errores']['errorCadena']) ? mostrarError($_SESSION['errores'],'errorCadena',1): ''; ?>
			<?= isset($_SESSION['errores']['errorInsert']) ? mostrarError($_SESSION['errores'],'errorInsert',1): ''; ?>
			<?= isset($_SESSION['success']) ? mostrarSucess($_SESSION['success']) : ''; ?>
		</form>
		
	</div>
<?php else: ?>
	
<!-- mostramos el formulario con datos para editar	 -->
	<?php if (isset($_GET['id'])): ?>

		<?php 
			$categoria = consultCondicion($conexion,'categorias','id_categoria',$_GET['id']); 
			if (!isset($categoria['id_categoria'])) {
				header("Location: index.php");
			}
		?>
		
		<div class="principal">
			<h1>Entrada de <?= ucfirst($categoria['nombre']) ?></h1>
			<?php mostrarCategoriaEntradas($conexion,$_GET['id']) ?>	
		</div>
	<?php endif ?>

<?php endif ?>

<?php require_once 'includes/footer.php' ?>