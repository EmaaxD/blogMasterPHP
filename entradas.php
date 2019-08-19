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
			<textarea name="descripcion" id="descripcion" cols="60" rows="5" placeholder="Descripcion del post"></textarea>

			<label for="categoria">Categoria</label>
			<select name="categoria" id="categoria">
				<option disabled selected>Seleccione una categoria</option>
				<?php mostrarCategorias($conexion,'opciones') ?>
			</select><div class=""></div>

			<input type="hidden" name="tipo" value="nuevo">
			<input type="hidden" name="usuario" value="<?= $_SESSION['usuario']['id_user']  ?>">
			<input type="submit" value="Crear">
		</form>

		<?= isset($_SESSION['post'])? mostrandoErrores($_SESSION['post']):' '; ?>
	</div>

<?php else: ?>
<!-- mostramos el formulario con datos para editar	 -->
	<?php if (isset($_GET['id'])): ?>
		<?php $post = consultCondicion($conexion,'entradas','id_entrada',$_GET['id']) ?>
		<div class="principal">
		<h1>Editar el post <?= ucfirst($post['titulo']) ?></h1>
			<form action="modelo/modelo_entrada.php" method="post">
				
				<label for="titulo">Titulo</label>
				<input type="text" name="titulo" id="titulo" value="<?= $post['titulo'] ?>" placeholder="Titulo del post">

				<label for="descripcion">Descripcion</label>
				<textarea name="descripcion" id="descripcion" cols="60" rows="5" placeholder="Descripcion del post"><?= $post['descripcion'] ?></textarea>

				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria">
					<option disabled selected>Seleccione una categoria</option>
					<?php mostrarCategorias($conexion,'opciones',$post['id_cate']) ?>
				</select><div class=""></div>

				<input type="hidden" name="tipo" value="edit">
				<input type="hidden" name="usuario" value="<?= $_SESSION['usuario']['id_user']  ?>">
				<input type="hidden" name="id_post" value="<?= $post['id_entrada'] ?>">
				<input type="submit" value="Crear">
			</form>

			<?= isset($_SESSION['post'])? mostrandoErrores($_SESSION['post']):' '; ?>
		</div>
	<?php endif ?>

<?php endif ?>

<!-- mostrar mis entradas publicadas -->
<?php if (isset($_GET['mis_entradas'])): ?>
	<div class="principal">
		<h1>Todas mis publicaciones</h1>
		<?php mostrarEntradas($conexion,1,$_SESSION['usuario']['id_user']) ?>
	</div>
<?php endif ?>

<!-- mostramos todo el post publicado -->
<?php if (isset($_GET['id_post'])): ?>
	<?php 
		$verify = consultCondicion($conexion,'entradas','id_entrada',$_GET['id_post']);
		if (!isset($verify['id_entrada'])) {
			header("Location: index.php");
		}
	?>
	<div class="principal">
		<?php mostrarPostSeleccinado($conexion,$_GET['id_post']) ?>
	</div>
<?php endif ?>

<?php require_once 'includes/footer.php' ?>