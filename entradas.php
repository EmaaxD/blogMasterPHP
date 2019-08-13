<?php require_once 'includes/redireccion.php' ?>
<?php require_once 'includes/header.php' ?>
<?php require_once 'includes/lateral.php' ?>

<!-- mostramos el formulario para crear nueva categoria -->
<?php if (isset($_GET['nueva'])): ?>
	<div class="principal">
		<h1>Crear Post</h1>
		<form action="modelo/modelo_entrada.php" method="post">
			
			<label for="titulo">Titulo</label>
			<input type="text" name="titulo" id="titulo" placeholder="Titulo del post">

			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del post">

			<label for="categoria">Categoria</label>
			<select name="categoria" id="categoria">
				<option disabled selected>Seleccione una categoria</option>
				<?php mostrarCategorias($conexion,'opciones') ?>
			</select>

			<input type="hidden" name="tipo" value="nuevo">
			<input type="hidden" name="usuario" value="<?= $_SESSION['usuario']['id_user']  ?>">
			<input type="submit" value="Crear">
		</form>
	</div>
<?php else: ?>

<!-- mostramos el formulario con datos para editar	 -->
	<?php if (isset($_GET['id'])): ?>
		<h1><?= $_GET['id'] ?></h1>	
	<?php endif ?>
<?php endif ?>

<?php require_once 'includes/footer.php' ?>