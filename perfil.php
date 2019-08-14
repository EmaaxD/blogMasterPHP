<?php 
require_once 'includes/redireccion.php';
require_once 'includes/header.php';
require_once 'includes/lateral.php'; 
//recogemos el id del user
$data_user = $_SESSION['usuario'];

?>

<div class="principal">
	<h1>Mis datos</h1>

	<form action="modelo/modelo_usuario.php" method="post">

		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" id="nombre" value="<?= $data_user['nombre'] ?>" placeholder="Ingrese nombre" autocomplete="off">

		<label for="apellido">Apellido</label>
		<input type="text" name="apellido" id="apellido" value="<?= $data_user['apellido'] ?>" placeholder="Ingrese apellido" autocomplete="off">

		<label for="correo">Correo</label>
		<input type="email" name="correo" id="correo" value="<?= $data_user['email'] ?>" placeholder="Ingrese correo" autocomplete="off">
		<?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'correo'): ''; ?>

		
		<input type="hidden" name="id_user" value="<?= $data_user['id_user'] ?>">
		<input type="hidden" name="tipo" value="edit">
		<input type="submit" value="Guardar">
		<?= isset($_SESSION['successUpdate']) ? mostrarSucess($_SESSION['successUpdate']['success']): ' '; ?>
		<?= isset($_SESSION['erroresUpdate']) ? mostrandoErrores($_SESSION['erroresUpdate']): ' '; ?>
	</form>
</div>

<?php require_once 'includes/footer.php' ?>