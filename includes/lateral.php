<aside id="sidebar">

	<?php if (isset($_SESSION['usuario'])): ?>
		<div class="block-aside">
			<h3>Bienvenido, <?= $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellido']  ?></h3>

			<!-- botones -->
			<a href="categorias.php?nueva=1" class="btn btn-primary">Crear Categoria</a>
			<a href="entradas.php?nueva=1" class="btn btn-primary">Crear Post</a><br><br>
			<a href="perfil.php" class="btn btn-primary">Mi Perfil</a>
			<a href="includes/cerrar_sesion.php" class="btn btn-red">Cerrar Sesion</a>
		</div>
	<?php endif ?>
	
	<!-- si no  existe sesion usuario mostramo las cajas de login y registro -->
	<?php if (!isset($_SESSION['usuario'])): ?>
		
		<div id="login" class="block-aside">
			<h3>Identificacion</h3>
			<form action="modelo/modelo_usuario.php" method="post">
				<label for="correo">Correo</label>
				<input type="email" name="correo" id="correo" placeholder="Ingrese correo" autocomplete="off">

				<label for="password">Contra</label>
				<input type="password" name="password" id="password" placeholder="Ingrese password">

				<!-- mostrando msj error de campos vacios del login -->
				<?php if (isset($_SESSION['loginEmpty'])): ?>
					<div class="error">
						<p><?= $_SESSION['loginEmpty'] ?></p>
					</div>	
				<?php endif ?>

				<!-- mostrando msj error de no se encontro el correo -->
				<?php if (isset($_SESSION['noLoginUser'])): ?>
					<div class="error">
						<p><?= $_SESSION['noLoginUser'] ?></p>
					</div>	
				<?php endif ?>

				<!-- mostrando msj error de no se coinciden las contras -->
				<?php if (isset($_SESSION['errorLoginPassword'])): ?>
					<div class="error">
						<p><?= $_SESSION['errorLoginPassword'] ?></p>
					</div>	
				<?php endif ?>
				
				<input type="hidden" name="tipo" value="login">
				<input type="submit" value="Entrar">
			</form>
		</div>	

		<div id="register" class="block-aside">
			<h3>Registrate</h3>
			<form action="modelo/modelo_usuario.php" method="post">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre" autocomplete="off">

				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" id="apellido" placeholder="Ingrese apellido" autocomplete="off">

				<label for="correo">Correo</label>
				<input type="email" name="correo" id="correo" placeholder="Ingrese correo" autocomplete="off">
				<?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'correo'): ''; ?>

				<label for="password">Contra</label>
				<input type="password" name="password" id="password" placeholder="Ingrese password">
				<?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'password'): ''; ?>

				
				<!-- mostrando msj success -->
				<?php if (isset($_SESSION['success'])): ?>
					<div class="success">
						<p><?= $_SESSION['success'] ?></p>
					</div>	
				<?php endif ?>

				<!-- mostrando msj error de insert -->
				<?php if (isset($_SESSION['errorInsert'])): ?>
					<div class="error">
						<p><?= $_SESSION['errorInsert'] ?></p>
					</div>	
				<?php endif ?>

				<!-- mostrando msj error de dato existente en la db -->
				<?php if (isset($_SESSION['errorDataExist'])): ?>
					<div class="error">
						<p><?= $_SESSION['errorDataExist'] ?></p>
					</div>	
				<?php endif ?>

				<!-- mostrando msj error campo vacio -->
				<?php if (isset($_SESSION['errores']['empty'])): ?>
					<div class="error">
						<p><?= $_SESSION['errores']['empty'] ?></p>
					</div>	
				<?php endif ?>
				
				<input type="hidden" name="tipo" value="nuevo">
				<input type="submit" value="Registro">

			</form>
			<?php borrarError() ?>	
		</div>

	<?php endif ?>

</aside>